<?php

namespace App\Http\Services;

use App\Http\Repositories\TransactionRepositoryInterface as RepositoriesTransactionRepositoryInterface;
use App\Models\Installment;
use App\Models\Payment;
use App\Repositories\TransactionRepositoryInterface;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;


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

     public function createRegisterPayment($student, $paymentCategory, $paymentType, $amount = 450000)
    {
        // 1. Buat payment utama
        $payment = Payment::create([
            'user_id'          => $student->id,
            'class_id'         => $student->class_id,
            'payment_for'      => 'register',
            'payment_category' => $paymentCategory,
            'payment_type'     => $paymentType,
            'amount'           => $amount,
            'status'           => 'pending',
            'code'             => 'REG-' . strtoupper(Str::random(10)),
        ]);

        // 2. Kalau cicilan, generate installments
        if ($paymentCategory === 'cicilan') {
            $perInstall = $amount / 3;

            for ($i = 1; $i <= 3; $i++) {
                $dueDate = match ($i) {
                    1 => now(),
                    2 => now()->addMonthNoOverflow()->startOfMonth(),
                    3 => now()->addMonthsNoOverflow(2)->startOfMonth(),
                };

                Installment::create([
                    'payment_id'      => $payment->id,
                    'installments_to' => $i,
                    'nominal'         => $perInstall,
                    'status'          => 'pending',
                    'paid_at'         => null,
                    'due_date'        => $dueDate,
                ]);
            }

            $payment->update([
                'remaining_balance' => $amount,
            ]);
        }

        return $payment;
    }
}
