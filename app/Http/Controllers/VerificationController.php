<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationMail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
public function sendVerificationEmail(Request $request)
{
    $userId = $request->input('user_id');

    $user = User::find($userId);
    if (!$user) {
        return back()->with('error', 'User tidak ditemukan di database.');
    }

    $latestPayment = Payment::where('user_id', $user->id)
        ->where('status', 'paid')
        ->latest('id')
        ->first();

    if (!$latestPayment) {
        return back()->with('error', 'Belum ada pembayaran yang berhasil.');
    }

    if ($latestPayment->email_sent) {
        return back()->with('info', 'Email verifikasi sudah pernah dikirim.');
    }

    try {
        $class = $latestPayment->class ?? null;
        $plainPassword = $user->plain_password ?? '(tidak tersedia)';

        Mail::to($user->email)->send(new \App\Mail\StudentVerificationMail($user, $class, $plainPassword));

        $latestPayment->update(['email_sent' => true]);

        return back()->with('success', 'Email verifikasi berhasil dikirim ke ' . $user->email);
    } catch (\Exception $e) {
        Log::error('Gagal kirim email verifikasi: ' . $e->getMessage());
        return back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
    }
}

}
