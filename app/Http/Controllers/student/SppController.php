<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function sppPayment()
    {
        $userId = Auth::id();
        $startYear = 2025;
        $months = [];
        $start = Carbon::createFromDate($startYear, 7, 1);

        for ($i = 0; $i < 12; $i++) {
            $months[] = $start->copy()->addMonths($i)->format('F-Y');
        }

        $payments = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->get()
            ->keyBy(function($item) {
                return $item->month . '-' . $item->year; // key sesuai format months[]
            });

        return view('student.payment.spp', compact('months', 'payments'));
    }

   public function paySpp($month)
{
    $user = Auth::user();
    [$bulan, $tahun] = explode('-', $month);

    $nominal = 50000;
    $orderId = "SPP-{$bulan}-{$user->id}-" . time();

    $payment = Payment::create([
        'user_id' => $user->id,
        'payment_for' => 'spp',
        'amount' => $nominal,
        'month' => $bulan,
        'year' => $tahun,
        'status' => 'pending',
        'code' => $orderId,
    ]);

    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $nominal,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '08123456789',
        ],
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    return response()->json(['snapToken' => $snapToken]);
}

    public function midtransCallback(Request $request)
    {
        $notif = new Notification();
        $orderId = $notif->order_id;
        $status  = $notif->transaction_status;

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
}
