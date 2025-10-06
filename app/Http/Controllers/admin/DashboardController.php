<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Installment;
use App\Models\TbClass;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentCount = User::where('role_id', 2)->count();
        $teacherCount = TbClass::distinct('teacher_name')->count('teacher_name');
        $classCount   = TbClass::count();

        // Total pembayaran lunas (langsung, bukan cicilan)
        $uangLunas = Payment::where('status', 'lunas')
            ->where('payment_category', 'lunas') // pastikan ambil yang full payment
            ->sum('amount');

        // Total cicilan yang sudah dibayar
        $uangCicilan = Installment::where('status', 'paid')->sum('nominal');

        // Total uang masuk
        $totalUangMasuk = $uangLunas + $uangCicilan;

        // ---- tambahan statistik ----
        $latestPayments = Payment::with('user')
            ->where('status', 'lunas')
            ->latest('updated_at')
            ->take(5)
            ->get();

        $sppBelumLunas = User::where('role_id', 2)
            ->whereDoesntHave('payments', function ($q) {
                $q->where('payment_for', 'spp')->where('status', 'lunas');
            })
            ->count();

        $registerBelumLunas = User::where('role_id', 2)
            ->whereDoesntHave('payments', function ($q) {
                $q->where('payment_for', 'register')->where('status', 'lunas');
            })
            ->count();

        return view('admin.dashboard', compact(
            'studentCount',
            'teacherCount',
            'classCount',
            'totalUangMasuk',
            'latestPayments',
            'sppBelumLunas',
            'registerBelumLunas'
        ));
    }
}
