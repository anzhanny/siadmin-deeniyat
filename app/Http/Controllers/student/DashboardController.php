<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Status tunggakan cicilan
        $overdueCount = Installment::where('status', 'overdue')
            ->whereHas('payment', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->count();

        // Last payment (SPP)
        $lastSpp = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->latest('created_at')
            ->first();

        // Last installment
        $lastInstallment = Installment::whereHas('payment', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'paid')
            ->latest('paid_at')
            ->first();

        // Gabungkan untuk riwayat terakhir
        $lastPayment = Payment::where('user_id', $userId)
            ->where('status', 'paid')
            ->latest('updated_at')
            ->first();

        if ($lastPayment && $lastInstallment) {
            $lastHistory = $lastPayment->updated_at > $lastInstallment->paid_at
                ? $lastPayment
                : $lastInstallment;
        } else {
            $lastHistory = $lastPayment ?? $lastInstallment;
        }

        return view('student.dashboard', compact(
            'lastPayment',
            'lastSpp',
            'overdueCount',
            'lastHistory'
        ));
    }
}
