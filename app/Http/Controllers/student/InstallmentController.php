<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Installment;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class InstallmentController extends Controller
{
    // List semua cicilan
    public function installmentPayment()
    {
        $userId = Auth::id();
        $installments = Installment::whereHas('payment', function($q) use ($userId) {
            $q->where('user_id', $userId)
              ->where('payment_category', 'cicilan');
        })->with('payment')->get();

        return view('student.payment.installment', compact('installments'));
    }

    // Bayar cicilan (tunai / non-tunai)
public function payInstallment($id)
{
    $user = Auth::user();
    $cicilan = Payment::findOrFail($id); // pastikan ini memang table payments

    if ($cicilan->status === 'paid') {
        return response()->json(['error' => 'Cicilan sudah lunas']);
    }

    $orderId = $cicilan->code;

    // update code biar konsisten dengan order_id
    $cicilan->update([
        'code'   => $orderId,
        'status' => 'pending',
    ]);

    \Midtrans\Config::$serverKey    = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized  = true;
    \Midtrans\Config::$is3ds        = true;

    $params = [
        'transaction_details' => [
            'order_id'     => $orderId,
            'gross_amount' => (int) $cicilan->amount, // pastikan integer dan > 0
        ],
        'customer_details' => [
            'first_name' => $user->name ?? 'Guest',
            'email'      => $user->email ?? 'noemail@example.com',
            'phone'      => $user->phone ?? '08123456789',
        ],
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['snapToken' => $snapToken]);
    } catch (\Exception $e) {
        // biar ketahuan error aslinya
        Log::error('Midtrans error: ' . $e->getMessage(), ['params' => $params]);
        return response()->json([
            'error' => $e->getMessage(),
            'params' => $params
        ]);
    }
}


    // Callback Midtrans cicilan
    public function midtransCallback(Request $request)
    {
        $notif = new Notification();
        $orderId = $notif->order_id;
        $status = $notif->transaction_status;

        if (!str_contains($orderId, 'CICILAN-')) {
            return response()->json(['message' => 'Not an installment payment'], 400);
        }

        $id = explode('-', $orderId)[1];
        $installment = Installment::find($id);
        if (!$installment) return response()->json(['message' => 'Installment not found'], 404);

        if (in_array($status, ['capture', 'settlement'])) {
            $installment->update(['status' => 'paid', 'paid_at' => now()]);

            // cek semua cicilan lunas
            $payment = $installment->payment;
            if ($payment->installments()->where('status', 'pending')->count() === 0) {
                $payment->update(['status' => 'paid', 'paid_at' => now()]);
            }
        } elseif ($status === 'pending') {
            $installment->update(['status' => 'pending']);
        } else {
            $installment->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
