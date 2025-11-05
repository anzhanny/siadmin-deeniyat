<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransCallbackController extends Controller
{
    // public function handle(Request $request)
    // {
    //     $notif = new Notification();
    //     $orderId = $notif->order_id;
    //     $status = $notif->transaction_status;

    //     // if (!str_contains($orderId, 'REG-')) {
    //     //     return response()->json(['message' => 'Not a register payment'], 400);
    //     // }
    //     $payment = Payment::where('code', $orderId)->first();
    //     if (!$payment) return response()->json(['message' => 'Payment not found'], 404);

    //     if (in_array($status, ['capture', 'settlement'])) {
    //         $payment->update(['status' => 'paid', 'paid_at' => now()]);
    //     } elseif ($status === 'pending') {
    //         $payment->update(['status' => 'pending']);
    //     } else {
    //         $payment->update(['status' => 'failed']);
    //     }

    //     return response()->json(['message' => 'Callback processed']);
    // }

public function midtransCallback(Request $request)
{
    try {
        $notification = new \Midtrans\Notification();

        $orderId           = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus       = $notification->fraud_status;

        // Cek semua pembayaran dengan kode yang sama
        $payments = Payment::where('code', $orderId)->get();
        if ($payments->isEmpty()) {
            // Jika tidak ditemukan, coba cari by prefix (misal group transaksi)
            $groupCode = explode('-', $orderId)[0]; // misal "SPPALL-20251027..."
            $payments = Payment::where('group_code', $groupCode)->get();
        }

        if ($payments->isEmpty()) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        foreach ($payments as $payment) {
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $payment->update(['status' => 'paid', 'paid_at' => now()]);
                } else {
                    $payment->update(['status' => 'failed']);
                }
            } elseif ($transactionStatus == 'settlement') {
                $payment->update(['status' => 'paid', 'paid_at' => now()]);
            } elseif ($transactionStatus == 'pending') {
                $payment->update(['status' => 'pending']);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $payment->update(['status' => 'failed']);
            }

            if ($payment->installment_id) {
                app(\App\Http\Services\PaymentService::class)
                    ->updateInstallmentStatus($payment->installment_id);
            }
        }

        // ✅ Jika order ini gabungan (tunggakan)
        if (str_contains($orderId, 'SPP-ALL-') || str_contains($orderId, 'SPPALL-')) {
            $prefix = explode('-', $orderId)[0]; // ambil bagian depan
            $related = Payment::where('group_code', $prefix)->get();
            foreach ($related as $p) {
                $p->update(['status' => 'paid', 'paid_at' => now()]);
            }
        }

        return response()->json(['message' => 'Callback processed'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function testMidtrans(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $request->amount ?? 10000,
            ],
            'customer_details' => [
                'first_name' => $request->first_name ?? 'Budi',
                'last_name' => $request->last_name ?? 'Setiawan',
                'email' => $request->email ?? 'budi@example.com',
                'phone' => $request->phone ?? '081234567890',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
