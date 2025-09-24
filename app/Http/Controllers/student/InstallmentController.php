<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Installment;
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
    public function payInstallment(Request $request, $id)
    {
        $installment = Installment::with('payment.user')->findOrFail($id);

        if ($installment->status === 'paid') {
            return back()->with('info', "Cicilan ke-{$installment->installments_to} sudah dibayar.");
        }

        if ($request->payment_type === 'tunai') {
            $phone = "6289629183036";
            $msg = "Halo admin, saya ingin membayar cicilan ID {$installment->id}";
            return redirect()->away("https://wa.me/{$phone}?text=" . urlencode($msg));
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'CICILAN-' . $installment->id . '-' . time(),
                'gross_amount' => $installment->nominal,
            ],
            'customer_details' => [
                'first_name' => $installment->payment->user->name,
                'email' => $installment->payment->user->email,
                'phone' => $installment->payment->user->phone ?? '08123456789',
            ],
            'item_details' => [[
                'id' => $installment->id,
                'price' => $installment->nominal,
                'quantity' => 1,
                'name' => "Cicilan ke-{$installment->installments_to}",
            ]],
        ];

        $snapToken = Snap::getSnapToken($params);
        return view('student.installment.snap', compact('snapToken', 'installment'));
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
