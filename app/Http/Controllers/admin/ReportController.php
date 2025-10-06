<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF; // pastikan kamu pakai barryvdh/laravel-dompdf

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan dengan filter
     */
    public function paymentReport(Request $request)
    {
        $query = Payment::with(['user.class']);

        // Filter jenis pembayaran
        if ($request->filled('payment_for')) {
            $query->where('payment_for', $request->payment_for);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tanggal (paid_at)
        if ($request->filled('start_date')) {
            $query->whereDate('paid_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('paid_at', '<=', $request->end_date);
        }

        $payments = $query->orderBy('paid_at', 'desc')->paginate(20);

        return view('admin.report.payment', compact('payments'));
    }

    /**
     * Export laporan pembayaran ke Excel / PDF
     */
}
