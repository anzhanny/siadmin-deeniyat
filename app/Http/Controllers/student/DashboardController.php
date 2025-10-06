<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Hitung tunggakan cicilan
        $overdueCount = Installment::where('status', 'overdue')
            ->where('user_id', $userId)
            ->count();

        // 2. Ambil pembayaran SPP terakhir (yang paid)
        $lastSpp = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->where('status', 'paid')
            ->latest('paid_at')
            ->first();

        // 3. Ambil cicilan terakhir yang paid
        $lastInstallment = Installment::where('user_id', $userId)
            ->where('status', 'paid')
            ->latest('paid_at')
            ->first();

        // 4. Ambil pembayaran langsung terakhir (register lunas / spp)
        $lastPayment = Payment::where('user_id', $userId)
            ->where('status', 'paid')
            ->latest('paid_at')
            ->first();

        // 5. Tentukan riwayat terakhir (compare waktu)
        $lastHistory = null;

        if ($lastPayment && $lastInstallment) {
            $lastHistory = $lastPayment->paid_at > $lastInstallment->paid_at
                ? $lastPayment
                : $lastInstallment;
        } else {
            $lastHistory = $lastPayment ?? $lastInstallment;
        }

        return view('student.dashboard', compact(
            'lastSpp',
            'overdueCount',
            'lastHistory'
        ));
    }
}
