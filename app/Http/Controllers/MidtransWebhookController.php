<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class MidtransWebhookController extends Controller
{
    public function handleMidtransNotification(Request $request)
{
    $notif = new \Midtrans\Notification();

    $payment = Payment::find($notif->order_id);
    if(!$payment){
        return response()->json(['message' => 'payment not found'],404);
    }

    if(in_array($notif->transaction_status, ['capture','settlement'])){
        $payment->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);
        $payment->installment()->update(['status' => 'paid']);
    }
    elseif(in_array($notif->transaction_status, ['deny','cancel','expire'])){
        $payment->update(['status' => 'failed']);
    }

    return response()->json(['message'=>'ok']);
}

}
