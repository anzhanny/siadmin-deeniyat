<?php

namespace App\Http\Services;

use App\Http\Repositories\TransactionRepositoryInterface as RepositoriesTransactionRepositoryInterface;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\User;
use App\Repositories\TransactionRepositoryInterface;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PaymentService
{
    protected $transactionRepository;

    public function __construct(RepositoriesTransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function processPayment($data)
    {
        // Simpan transaksi ke database menggunakan repository
        $transaction = $this->transactionRepository->createTransaction([
            'product_id' => $data['code'],
            'customer_id' => $data['user_id'],
            'quantity' => 1,
            'total_price' => $data['amount'],
            'status' => 'pending'
        ]);

        // Membuat Snap Token Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total_price
            ],
            'customer_details' => [
                'first_name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone']
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return [
            'transaction' => $transaction,
            'snap_token' => $snapToken
        ];
    }

    public function createRegisterPayment(User $user, string $category, string $type, float $totalAmount)
    {
        return DB::transaction(function () use ($user, $category, $type, $totalAmount) {
            return Payment::create([
                'user_id' => $user->id,
                'class_id' => $user->class_id,
                'payment_for' => 'register',
                'payment_category' => $category, // lunas
                'payment_type' => $type,
                'method' => $type === 'tunai' ? 'cash' : 'qris', // Atau midtrans
                'code' => 'REG-' . strtoupper(uniqid()),
                'amount' => $totalAmount,
                'status' => 'pending',
                'installment_id' => null, // Lunas gak butuh parent
            ]);
        });
    }

    /**
     * Create register installment untuk cicilan (parent + multiple child payments).
     */
    public function createRegisterInstallment(User $user, string $type, float $totalAmount, int $installmentCount = 3)
    {
        $perInstallment = ceil($totalAmount / $installmentCount);

        return DB::transaction(function () use ($user, $type, $totalAmount, $installmentCount, $perInstallment) {
            // Buat parent Installment
            $installment = Installment::create([
                'user_id'           => $user->id,
                'nominal'           => $totalAmount, // total_amount
                'remaining_balance' => $totalAmount,
                'due_date'          => Carbon::now()->addMonth(),
                'status'            => 'pending',
            ]);

            // Buat cicilan di Payment
            for ($i = 1; $i <= $installmentCount; $i++) {
                $dueDate = Carbon::now()->addMonths($i - 1);

                Payment::create([
                    'installment_id'   => $installment->id,
                    'user_id'          => $user->id,
                    'class_id'         => $user->class_id,
                    'payment_for'      => 'register',
                    'payment_category' => 'cicilan',
                    'payment_type'     => $type,
                    'method'           => $type === 'tunai' ? 'cash' : 'e-payment', // Atau midtrans
                    'code'             => strtoupper(uniqid("REG-INST{$i}-")),
                    'due_date'         => $dueDate,
                    'amount'           => $i === $installmentCount
                        ? ($totalAmount - ($perInstallment * ($installmentCount - 1)))
                        : $perInstallment,
                    'installment_to'   => $i, // posisi cicilan
                    'description'      => 'Cicilan ke-' . $i,
                    'month'            => $dueDate->month,
                    'year'             => $dueDate->year,
                    'status'           => 'pending',
                    'paid_at'          => null,
                ]);
            }

            return $installment;
        });
    }

    public function updatePaymentStatus(Payment $payment, string $status): void
    {
        // Update status payment
        $payment->status = $status;

        if ($status === 'paid' && !$payment->paid_at) {
            $payment->paid_at = now();
        } elseif ($status !== 'paid') {
            $payment->paid_at = null;
        }

        $payment->save();

        // Kalau ada parent installment → update juga
        if ($payment->installment_id) {
            $this->updateInstallmentStatus($payment->installment_id);
        }
    }

    public function updateInstallmentStatus(int $installmentId): void
    {
        $installment = Installment::with('payments')->find($installmentId);

        if (!$installment) return;

        $totalPayments = $installment->payments->count();
        $paidPayments  = $installment->payments->where('status', 'paid')->count();
        $remaining     = $installment->payments->where('status', '!=', 'paid')->sum('amount');

        if ($paidPayments === 0) {
            $installment->status = 'pending';
            $installment->paid_at = null;
        } elseif ($paidPayments < $totalPayments) {
            $installment->status = 'partial';
            $installment->paid_at = null;
        } else {
            $installment->status  = 'paid';
            $installment->paid_at = now();
        }

        $installment->remaining_balance = $remaining;
        $installment->save();
    }
}
