<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\Installment;
use App\Models\TbClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Snap;

class ArchivePaymentController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        $payments = Payment::with('installments')->where('user_id', $userId)->latest()->get();

        $registerPayment = $payments->firstWhere('payment_for', 'register');
        $sppPayments = $payments->where('payment_for', 'spp')->values();

        // hitung total pembayaran tahun ini
        $total_pembayaran = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->where('status', 'paid')
            ->whereYear('paid_at', date('Y'))
            ->sum('amount');

        return view('student.payment.spp', compact('payments', 'registerPayment', 'sppPayments', 'total_pembayaran'));
    }


    public function registerPayment()
    {
        $userId = Auth::id();

        $payment = Payment::with('installments')
            ->where('user_id', $userId)
            ->where('payment_for', 'register')
            ->latest()
            ->first();

        $installments = $payment ? $payment->installments : collect();

        return view('student.payment.register', compact('payment', 'installments'));
    }

    public function sppPayment()
    {
        $userId = Auth::id();

        // Ambil semua pembayaran SPP user, key = month-year
        $payments = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->get()
            ->keyBy(function ($item) {
                return $item->month_year;
                // pastikan kolom month_year ada di tabel, misalnya "Juli-2025"
            });

        // Tahun mulai (atur sesuai kebutuhan akademik)
        $startYear = date('Y');

        // Daftar bulan ajaran (Juli s/d Juni)
        $months = [
            'Juli-2025',
            'Agustus-2025',
            'September-2025',
            'Oktober-2025',
            'November-2025',
            'Desember-2025',
            'Januari-2026',
            'Februari-2026',
            'Maret-2026',
            'April-2026',
            'Mei-2026',
            'Juni-2026',
        ];

        return view('student.payment.spp', compact('payments', 'months', 'startYear'));
    }


    /**
     * Proses tombol bayar SPP (buat record jika belum ada + redirect ke Midtrans)
     */


    public function paySpp($month)
    {
        [$bulan, $tahun] = explode('-', $month);
        $userId = Auth::id();

        // Cek apakah pembayaran bulan ini sudah ada
        $existingPayment = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->where('month', $bulan)
            ->where('year', $tahun)
            ->first();

        if ($existingPayment && $existingPayment->status == 'paid') {
            return back()->with('error', "SPP bulan $bulan $tahun sudah dibayar.");
        }

        // Nominal SPP per bulan
        $nominal = 50000;

        // Simpan data payment (status pending dulu)
        $payment = Payment::create([
            'user_id'          => $userId,
            'class_id'         => Auth::user()->class_id ?? null,
            'amount'           => $nominal,
            'payment_type'     => 'non-tunai',   // ✅ pakai midtrans
            'payment_category' => 'lunas',       // ✅ karena SPP nggak bisa cicilan
            'method'           => 'qris',
            'payment_for'      => 'spp',
            'month'            => $bulan,
            'year'             => $tahun,
            'status'           => 'pending',
            'code'             => 'SPP-' . time() . '-' . $userId,
        ]);

        // Midtrans Config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $payment->code,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email'      => Auth::user()->email,
                'phone'      => Auth::user()->phone ?? '08123456789',
            ],
            'enabled_payments' => ['other_qris'],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('payment.snap', compact('snapToken', 'payment'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi Midtrans: ' . $e->getMessage());
        }
    }

    public function sppSuccess($id)
    {
        $payment = Payment::findOrFail($id);

        // Pastikan user hanya bisa update pembayaran miliknya sendiri
        if ($payment->user_id != Auth::id()) {
            abort(403);
        }

        // Update status jadi paid
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('student.payment.spp')
            ->with('success', "Pembayaran SPP bulan {$payment->month} {$payment->year} berhasil!");
    }

    public function installmentPayment()
    {
        $userId = Auth::id();

        // Ambil semua pembayaran pendaftaran yang cicilan
        $payments = Payment::where('user_id', $userId)
            ->where('payment_for', 'register')
            ->where('payment_category', 'cicilan')
            ->with('installments') // pastikan relasi ada di model Payment
            ->get();

        return view('student.payment.installment', compact('payments'));
    }

    public function payInstallment(Request $request, $installmentId)
    {
        $installment = Installment::findOrFail($installmentId);

        if ($installment->status === 'paid') {
            return back()->with('info', "Cicilan ke-{$installment->installments_to} sudah dibayar.");
        }

        if ($request->payment_type === 'tunai') {
            // langsung redirect WA
            return redirect()->away(
                "https://wa.me/6289629183036?text=Halo admin, saya ingin bayar cicilan ID {$installment->id}"
            );
        }

        if ($request->payment_type === 'non-tunai') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id'      => 'CICILAN-' . $installment->id . '-' . time(),
                    'gross_amount'  => $installment->nominal,
                ],
                'customer_details' => [
                    'first_name' => $installment->payment->user->name,
                    'email'      => $installment->payment->user->email,
                    'phone'      => $installment->payment->user->phone ?? '081234567890',
                ],
                'item_details' => [[
                    'id'       => $installment->id,
                    'price'    => $installment->nominal,
                    'quantity' => 1,
                    'name'     => "Cicilan ke-{$installment->installments_to}",
                ]],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);

                // arahkan ke halaman khusus untuk menampilkan Snap
                return view('student.installment.snap', compact('snapToken', 'installment'));
            } catch (\Exception $e) {
                return back()->with('error', 'Midtrans error: ' . $e->getMessage());
            }
        }


        return back()->with('error', 'Tipe pembayaran tidak valid.');
    }



    public function waRedirectInstallment($id)
    {
        $installment = Installment::with('payment')->findOrFail($id);

        // ambil data dari relasi payment
        $payment = $installment->payment;

        $phone = "6285864921179"; // nomor admin / bendahara
        $message = "Halo Admin Deeniyat, saya ingin melakukan pembayaran cicilan pendaftaran secara tunai.\n"
            . "Kode: {$payment->code}\n"
            . "Nama: " . Auth::user()->name . "\n"
            . "Jumlah: Rp " . number_format($installment->nominal, 0, ',', '.');

        $url = "https://wa.me/{$phone}?text=" . urlencode($message);

        return view('payment.waredirect_installment', compact('url'));
    }



    /**
     * Display the payment detail page
     */
    public function detailPayment()
    {
        // Get user from session or create a default class object
        $class = null;

        // Try to get class from session
        if (session('class_id')) {
            $class = TbClass::find(session('class_id'));
        }

        // If no class found, create a default class object with default fees
        $class = TbClass::find(session('class_id')) ?? (object) [
            'registration_fee'   => 200000,
            'infrastructure_fee' => 100000,
            'uniform_fee'        => 150000,
        ];

        return view('payment.detailpayment', compact('class'));
    }

    public function processPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'payment_type'     => $request->payment_type,
            'payment_category' => $request->payment_category,
            'method'           => $request->method,
        ]);

        if ($payment->status === 'paid') {
            return redirect()->route('payment.thankyoupage', $payment->id)
                ->with('success', 'Pembayaran sudah selesai.');
        }

        // Tunai langsung WA
        if ($request->payment_type === 'tunai') {
            return redirect()->route('payment.waredirect', ['id' => $payment->id]);
        }

        // ===== MODE DEMO (tapi tetap munculin Snap QRIS) =====
        if (config('payment.mode') === 'demo') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id'     => 'ORDER-' . uniqid(),
                    'gross_amount' => $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name ?? 'Calon Siswa',
                    'email'      => Auth::user()->email ?? 'email@example.com',
                    'phone'      => Auth::user()->phone ?? '08123456789',
                ],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                return view('payment.demo', compact('snapToken', 'payment'));
            } catch (\Exception $e) {
                return redirect()->route('payment.detailpayment')
                    ->with('error', 'Gagal membuat transaksi demo: ' . $e->getMessage());
            }
        }
    }

    // SIMULASI
    public function simulate($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('payment.thankyoupage', $payment->id)
            ->with('success', 'Simulasi pembayaran berhasil!');
    }

    private function processMidtrans(Request $request)
    {
        $payment = Payment::findOrFail($request->id);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = true; // real
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id'     => 'ORDER-' . uniqid(),
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name ?? 'Calon Siswa',
                'email'      => Auth::user()->email ?? 'email@example.com',
                'phone'      => Auth::user()->phone ?? '08123456789',
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('payment.midtrans', compact('snapToken', 'payment'));
        } catch (\Exception $e) {
            return redirect()->route('payment.detailpayment')
                ->with('error', 'Gagal membuat transaksi Midtrans: ' . $e->getMessage());
        }
    }





    // public function processPayment(Request $request, $id)
    // {
    //     $payment = Payment::findOrFail($id);

    //     $request->validate([
    //         'payment_type'     => 'required|in:tunai,non-tunai',
    //         'payment_category' => 'required|in:lunas,cicilan',
    //         'method'           => 'nullable|in:qris',
    //     ]);

    //     $payment->update([
    //         'payment_type'     => $request->payment_type,
    //         'payment_category' => $request->payment_category,
    //         'method'           => $request->method,
    //     ]);

    //     // Kalau sudah paid, jangan proses ulang
    //     if ($payment->status === 'paid') {
    //         return redirect()->route('payment.thankyoupage', $payment->id)
    //             ->with('success', 'Pembayaran sudah selesai.');
    //     }

    //     // Jika pembayaran tunai → langsung redirect WA
    //     if ($request->payment_type === 'tunai') {
    //         return redirect()->route('payment.waredirect', ['id' => $payment->id]);
    //     }

    //     // REAL MODE: Midtrans
    //     $totalAmount = 450000;

    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     \Midtrans\Config::$isProduction = false; // true kalau live
    //     \Midtrans\Config::$isSanitized = true;
    //     \Midtrans\Config::$is3ds = true;

    //     $params = [
    //         'transaction_details' => [
    //             'order_id'     => 'ORDER-' . uniqid(),
    //             'gross_amount' => $totalAmount,
    //         ],
    //         'customer_details' => [
    //             'first_name' => Auth::user()->name ?? 'Calon Siswa',
    //             'email'      => Auth::user()->email ?? 'email@example.com',
    //             'phone'      => Auth::user()->phone ?? '08123456789',
    //         ],
    //     ];

    //     try {
    //         $snapToken = \Midtrans\Snap::getSnapToken($params);
    //         return view('payment.midtrans', compact('snapToken', 'payment'));
    //     } catch (\Exception $e) {
    //         return redirect()->route('payment.detailpayment')
    //             ->with('error', 'Gagal membuat transaksi Midtrans: ' . $e->getMessage());
    //     }
    // }


    public function waRedirect($id)
    {
        $payment = Payment::findOrFail($id);

        // buat link WA (simulasi kirim konfirmasi)
        $phone = "6285864921179"; // nomor admin / bendahara
        $message = "Halo Admin Deeniyat, saya Ingin melakukan mengonfirmasi pembayaran pendaftaran.\nKode: {$payment->code}\n
        Nama: " . Auth::user()->name . " 
        Jumlah: Rp " . number_format($payment->amount, 0, ',', '.');

        $url = "https://wa.me/{$phone}?text=" . urlencode($message);

        \Illuminate\Support\Facades\Auth::logout();
        return view('payment.waredirect', compact('url'));
    }


    public function midtransFake($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payment.fake-midtrans', compact('payment'));
    }

    public function midtransSimulation($id)
    {
        // ambil data payment berdasarkan id
        $payment = Payment::findOrFail($id);

        return view('payment.midtrans_simulation', compact('payment'));
    }

    public function midtransSuccess($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'paid';
        $payment->paid_at = now();
        $payment->save();

        return redirect()->route('payment.thankyoupage')->with('success', 'Pembayaran berhasil melalui simulasi Midtrans (QRIS).');
    }

    public function midtransCallback(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;

        // kalau ini cicilan
        if (str_contains($orderId, 'CICILAN-')) {
            $id = str_replace('CICILAN-', '', $orderId);
            $installment = Installment::find($id);

            if ($transactionStatus === 'settlement' && $installment) {
                $installment->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);

                // cek semua cicilan sudah lunas → update payment
                $payment = $installment->payment;
                if ($payment->installments()->where('status', 'pending')->count() === 0) {
                    $payment->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                    ]);
                }
            }
        }

        // kalau ini pembayaran biasa (SPP / register lunas)
        if (str_contains($orderId, 'ORDER-') || str_contains($orderId, 'SPP-') || str_contains($orderId, 'REG-')) {
            $payment = Payment::where('code', $orderId)->first();
            if ($payment && $transactionStatus === 'settlement') {
                $payment->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Create installments for the payment
     */
    private function createInstallments($payment, $totalAmount, $installmentCount)
    {
        $installmentAmount = ceil($totalAmount / $installmentCount);
        $remainingBalance = $totalAmount;

        for ($i = 1; $i <= $installmentCount; $i++) {
            $currentAmount = ($i == $installmentCount) ? $remainingBalance : $installmentAmount;

            Installment::create([
                'payment_id' => $payment->id,
                'nominal' => $currentAmount,
                'installments_to' => $i,
                'paid_at' => null,
                'remaining_balance' => $remainingBalance - $currentAmount,
            ]);

            $remainingBalance -= $currentAmount;
        }
    }

    /**
     * Show payment confirmation page
     */
    public function confirmPayment(Request $request)
    {
        $userId = Auth::id();
        $classId = Auth::user()->class_id;

        $payment = Payment::where('user_id', $userId)
            ->where('payment_for', 'register')
            ->first();

        app(PaymentService::class)->createRegisterPayment(
            Auth::user(),
            $request->payment_category,
            $request->payment_type,
            450000
        );


        if (!$payment) {
            // Kalau belum ada → buat baru
            $payment = Payment::create([
                'user_id'          => $userId,
                'class_id'         => $classId,
                'payment_for'      => 'register',
                'payment_category' => $request->payment_category,
                'payment_type'     => $request->payment_type,
                'method'           => $request->payment_type === 'non-tunai' ? 'qris' : null,
                'code'             => 'REG-' . strtoupper(uniqid()),
                'amount'           => 450000,
                'status'           => 'pending',
            ]);

            session([
                'payment_type'     => $payment->payment_type,
                'payment_category' => $payment->payment_category,
                'total_amount'     => $payment->amount,
                'user_id'          => $payment->user_id,
                'student_class'    => $this->getClassName($classId),
                'class_id'         => $classId,

            ]);

            // Kalau cicilan → generate installments sekali saja
            if ($request->payment_category === 'cicilan') {
                $total      = 450000;
                $perInstall = 150000;

                // cek apakah installments sudah pernah dibuat
                if ($payment->installments()->count() === 0) {
                    for ($i = 1; $i <= 3; $i++) {
                        $dueDate = match ($i) {
                            1 => now(),
                            2 => now()->addMonthNoOverflow()->startOfMonth(),
                            3 => now()->addMonthsNoOverflow(2)->startOfMonth(),
                        };

                        Installment::create([
                            'payment_id'      => $payment->id,
                            'installments_to' => $i,
                            'nominal'         => $perInstall,
                            'status'          => $i == 1 ? 'paid' : 'pending',
                            'paid_at'         => $i == 1 ? now() : null,
                            'due_date'        => $dueDate,
                        ]);
                    }

                    $payment->update([
                        'remaining_balance' => $total - $perInstall,
                        'status'            => 'pending',
                        'payment_category'  => 'cicilan',
                    ]);
                }
            }
        }

        return view('payment.confirmpayment', compact('payment'));
    }



    public function showConfirm()
    {
        return view('payment.confirmpayment', [
            'payment_type' => session('payment_type'),
            'payment_category' => session('payment_category'),
            'total_amount' => session('total_amount'),
        ]);
    }


    /**
     * Get class name based on class ID
     */
    private function getClassName($classId)
    {
        $class = TbClass::find($classId);
        return $class ? $class->class_name : 'Kelas Tidak Diketahui';
    }


    public function thankyouPage()
    {
        \Illuminate\Support\Facades\Auth::logout();

        return view('payment.thankyoupage');
    }

    public function finalizePayment(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // cek kalau cicilan
        if ($payment->payment_category === 'cicilan') {
            $total = $payment->amount; // misal 450000
            $installments = 3;
            $installmentAmount = $total / $installments;

            // update payment utama
            $payment->update([
                'remaining_balance' => $total - $installmentAmount,
                'status'            => 'pending',
                'payment_category'  => 'cicilan',
            ]);
        } else {
            // kalau lunas langsung
            $payment->update([
                'remaining_balance' => 0,
                'status'            => 'paid',
                'paid_at'           => now(),
            ]);
        }

        return redirect()->route('student.thankyou')
            ->with('success', 'Pembayaran berhasil diproses.');
    }


    // history payment
    public function paymentHistory()
    {
        $userId = Auth::id();

        $payments = Payment::where('user_id', $userId)
            ->where('payment_for', 'register')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.payment.history', compact('payments'));
    }

    /**
     * Complete payment process
     */
    public function completePayment($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Ensure user can only complete their own payment
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            // Update payment status
            $payment->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            // Update first installment as paid
            if ($payment->installments->count() > 0) {
                $firstInstallment = $payment->installments->where('installments_to', 1)->first();
                if ($firstInstallment) {
                    $firstInstallment->update([
                        'paid_at' => now(),
                    ]);
                }
            }

            DB::commit();

            // Redirect to thank you page
            return redirect()->route('thankyoupage');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyelesaikan pembayaran: ' . $e->getMessage()]);
        }
    }

    public function payWithQris($id)
    {
        $payment = Payment::findOrFail($id);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;

        $params = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id' => $payment->code,
                'gross_amount' => $payment->amount,
            ],
            'item_details' => [
                [
                    'id' => $payment->id,
                    'price' => $payment->amount,
                    'quantity' => 1,
                    'name' => "Pembayaran SPP"
                ]
            ],
            'customer_details' => [
                'first_name' => $payment->user->name,
                'email' => $payment->user->email,
                'phone' => $payment->user->phone ?? '08123456789',
            ]
        ];

        $response = CoreApi::charge($params);

        // Midtrans balikin data QR Code
        $qrString = $response->actions[0]->url ?? null;

        return view('payment.qris', compact('qrString', 'payment'));
    }

    public function payWithSnap($id)
    {
        $payment = Payment::findOrFail($id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // true kalau sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $payment->code,
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->user->name,
                'email'      => $payment->user->email,
                'phone'      => $payment->user->phone ?? '08123456789',
            ],
            'enabled_payments' => ['other_qris'], // ✅ hanya QRIS
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.snap', compact('snapToken', 'payment'));
    }

    public function handleCallback(Request $request)
    {
        // Ambil semua data dari Midtrans
        $notif = $request->all();

        // Log dulu biar gampang debug
        log::info('Midtrans Callback: ', $notif);

        // Cari payment berdasarkan order_id / code
        $payment = Payment::where('code', $notif['order_id'])->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Cek status transaksi
        $transactionStatus = $notif['transaction_status'];

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $payment->status = 'paid';
            $payment->paid_at = now();
            $payment->save();

            // Kalau cicilan, update installment
            if ($payment->payment_category === 'cicilan') {
                $installment = $payment->installments()
                    ->where('status', 'pending')
                    ->first();

                if ($installment) {
                    $installment->status = 'paid';
                    $installment->paid_at = now();
                    $installment->remaining_balance = max(0, $installment->remaining_balance - $installment->nominal);
                    $installment->save();
                }
            }
        } elseif ($transactionStatus == 'pending') {
            $payment->status = 'pending';
            $payment->save();
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $payment->status = 'failed';
            $payment->save();
        }

        return response()->json(['message' => 'Callback processed successfully']);
    }
}
