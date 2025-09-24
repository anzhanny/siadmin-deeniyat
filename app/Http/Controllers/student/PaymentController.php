<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\TbClass;
use App\Models\Installment;
use Midtrans\Config;
use Midtrans\Snap;
use Exception;

class PaymentController extends Controller
{
    // Halaman ringkasan pembayaran
    public function index()
    {
        $userId = Auth::id();
        $payments = Payment::where('user_id', $userId)
            ->where('payment_for', 'register')
            ->with('installments')
            ->latest()
            ->get();

        return view('student.payment.register', compact('payments'));
    }

    // Konfirmasi pembayaran register
    public function confirmPayment(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|in:tunai,non-tunai',
            'payment_category' => 'required|in:lunas,cicilan',
        ]);

        $user = Auth::user();

        $payment = Payment::firstOrCreate(
            [
                'user_id' => $user->id,
                'payment_for' => 'register',
            ],
            [
                'class_id' => $user->class_id,
                'amount' => 450000,
                'status' => 'pending',
                'payment_type' => $request->payment_type,
                'payment_category' => $request->payment_category,
                'code' => 'REG-' . strtoupper(uniqid()),
            ]
        );

        // Generate cicilan jika pilih cicilan
        if ($request->payment_category === 'cicilan' && $payment->installments()->count() === 0) {
            $perInstall = 150000;
            for ($i = 1; $i <= 3; $i++) {
                Installment::create([
                    'payment_id' => $payment->id,
                    'installments_to' => $i,
                    'nominal' => $perInstall,
                    'status' => $i === 1 ? 'paid' : 'pending',
                    'due_date' => now()->addMonths($i - 1),
                ]);
            }
        }

        return view('payment.confirmpayment', compact('payment'));
    }

    public function detailPayment()
    {
        // Get user from session or create a default class object
        $class = null;

        // Try to get class from session
        if (session('class_id')) {
            $class = TbClass::find(session('class_id'));
        }

        // If no class found, create a default class object with default fees
        $class = TbClass::find(session('class_id')) ?? (object) [
            'registration_fee'   => 200000,
            'infrastructure_fee' => 100000,
            'uniform_fee'        => 150000,
        ];

        return view('payment.detailpayment', compact('class'));
    }

    public function processPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'payment_type'     => $request->payment_type,
            'payment_category' => $request->payment_category,
            'method'           => $request->method,
        ]);

        if ($payment->status === 'paid') {
            return redirect()->route('payment.thankyoupage', $payment->id)
                ->with('success', 'Pembayaran sudah selesai.');
        }

        // Tunai langsung WA
        if ($request->payment_type === 'tunai') {
            return redirect()->route('payment.waredirect', ['id' => $payment->id]);
        }

        // ===== MODE DEMO (tapi tetap munculin Snap QRIS) =====
        if (config('payment.mode') === 'demo') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id'     => 'ORDER-' . uniqid(),
                    'gross_amount' => $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name ?? 'Calon Siswa',
                    'email'      => Auth::user()->email ?? 'email@example.com',
                    'phone'      => Auth::user()->phone ?? '08123456789',
                ],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                return view('payment.demo', compact('snapToken', 'payment'));
            } catch (\Exception $e) {
                return redirect()->route('payment.detailpayment')
                    ->with('error', 'Gagal membuat transaksi demo: ' . $e->getMessage());
            }
        }
    }

    // Redirect WA untuk register tunai
    public function waRedirect($id)
    {
        $payment = Payment::findOrFail($id);
        $user = Auth::user();

        $phone = "6285864921179";
        $message = "Halo Admin Deeniyat, saya ingin membayar pendaftaran.\nKode: {$payment->code}\nNama: {$user->name}\nJumlah: Rp " . number_format($payment->amount, 0, ',', '.');

        $url = "https://wa.me/{$phone}?text=" . urlencode($message);
        return view('payment.waredirect', compact('url'));
    }

    // Midtrans callback register
    public function midtransCallback(Request $request)
    {
        $notif = new \Midtrans\Notification();
        $orderId = $notif->order_id;
        $status = $notif->transaction_status;

        if (!str_contains($orderId, 'REG-')) {
            return response()->json(['message' => 'Not a register payment'], 400);
        }

        $payment = Payment::where('code', $orderId)->first();
        if (!$payment) return response()->json(['message' => 'Payment not found'], 404);

        if (in_array($status, ['capture', 'settlement'])) {
            $payment->update(['status' => 'paid', 'paid_at' => now()]);
        } elseif ($status === 'pending') {
            $payment->update(['status' => 'pending']);
        } else {
            $payment->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Callback processed']);
    }

    // history payment
    public function paymentHistory()
    {
        $userId = Auth::id();

        $payments = Payment::where('user_id', $userId)
            ->with('installments') // cuma kepake kalau cicilan
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.payment.history', compact('payments'));
    }
}
