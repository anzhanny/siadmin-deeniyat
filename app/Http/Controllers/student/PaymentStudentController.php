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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationMail;



class PaymentStudentController extends Controller
{

    public function index()
    {
        $userId = Auth::id();

        // Ambil semua installment (parent) milik user, beserta child payments
        $installments = Installment::where('user_id', $userId)
            ->with('payments')
            ->orderBy('due_date', 'asc')
            ->get();

        // Untuk kompatibilitas view yang sebelumnya memakai "registerPayment" (pembayaran langsung/lunas)
        $registerPayment = Payment::where('user_id', $userId)
            ->where('payment_for', 'register')
            ->whereNull('installment_id') // jika ada payment tanpa link ke installment
            ->latest()
            ->first();

        // SPP tetap dari Payment (bulanan)
        $sppPayments = Payment::where('user_id', $userId)
            ->where('payment_for', 'spp')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Hitung total pembayaran SPP yang sudah 'paid' pada tahun ini
        $total_pembayaran = $sppPayments
            ->where('status', 'paid')
            ->filter(function ($p) {
                return $p->paid_at && $p->paid_at->format('Y') == date('Y');
            })
            ->sum('amount');

        // NOTE: kita kirim 'payments' sebagai $installments supaya view lama tetap work
        return view('student.payment.spp', [
            'payments' => $installments,
            'registerPayment' => $registerPayment,
            'sppPayments' => $sppPayments,
            'total_pembayaran' => $total_pembayaran,
        ]);
    }



    public function registerPayment()
    {
        $userId = Auth::id();

        // Jika ada payment register yang dibuat sebagai "lunas" (tanpa installment) ambil itu
        $payment = Payment::where('user_id', $userId)
            ->where('payment_for', 'register')
            ->whereNull('installment_id')
            ->latest()
            ->first();

        // Ambil semua installment user (akan tampil sebagai jadwal cicilan)
        $installments = Installment::where('user_id', $userId)
            ->with('payments')
            ->orderBy('installments_to', 'asc')
            ->get();

        return view('student.payment.register', compact('payment', 'installments'));
    }


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
            ->keyBy(function ($item) {
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

        // ❌ jangan create lalu save lagi → cukup create()
        $payment = Payment::create([
            'user_id'          => $user->id,
            'payment_for'      => 'spp',
            'payment_category' => 'lunas',
            'payment_type'     => 'non-tunai',
            'amount'           => $nominal,
            'month'            => $bulan,
            'year'             => $tahun,
            'status'           => 'pending',
            'code'             => $orderId,
        ]);

        // Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
                'phone'      => $user->phone ?? '08123456789',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }



    public function installmentPayment()
    {
        $userId = Auth::id();

        // Ambil parent installments, bukan payments
        $installments = Installment::where('user_id', $userId)
            ->with(['payments' => function ($q) {
                $q->orderBy('installment_to', 'asc');
            }])
            ->get();

        return view('student.payment.installment', compact('installments'));
    }


//     public function payInstallment($id)
// {
//     $installment = Installment::with(['payments', 'user'])->findOrFail($id);

//     // ambil payment cicilan yang masih pending
//     $payment = $installment->payments()->where('status', 'pending')->first();
//     if (!$payment) {
//         return response()->json(['error' => 'Tidak ada cicilan pending'], 404);
//     }

//     // Midtrans config
//     \Midtrans\Config::$serverKey = config('midtrans.server_key');
//     \Midtrans\Config::$isProduction = config('midtrans.is_production');
//     \Midtrans\Config::$isSanitized = true;
//     \Midtrans\Config::$is3ds = true;

//     $params = [
//         'transaction_details' => [
//             'order_id'      => $payment->code, // ambil dari payments
//             'gross_amount'  => $payment->amount,
//         ],
//         'customer_details' => [
//             'first_name' => $installment->user->name,
//             'email'      => $installment->user->email,
//             'phone'      => $installment->user->phone ?? '081234567890',
//         ],
//         'item_details' => [[
//             'id'       => $payment->id,
//             'price'    => $payment->amount,
//             'quantity' => 1,
//             'name'     => "Cicilan ke-{$payment->installment_to}",
//         ]],
//     ];

//     $snapToken = \Midtrans\Snap::getSnapToken($params);

//     return response()->json(['snapToken' => $snapToken]);
// }





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
        $class = null;

        if (session('class_id')) {
            $class = TbClass::find(session('class_id'));
        }

        // fallback biaya default
        $class = $class ?? (object) [
            'registration_fee'   => 200000,
            'infrastructure_fee' => 100000,
            'uniform_fee'        => 150000,
        ];

        return view('payment.detailpayment', compact('class'));
    }

    public function processPayment(Request $request)
    {
        // ✅ gunakan firstOrNew supaya tidak bikin duplikat
        $payment = Payment::firstOrNew([
            'user_id'     => $request->user_id,
            'class_id'    => $request->class_id,
            'payment_for' => $request->payment_for,
        ]);

        // update kolom lain
        $payment->fill([
            'payment_type'     => $request->payment_type,
            'payment_category' => $request->payment_category,
            'amount'           => $request->total_amount,
            'status'           => $payment->exists ? $payment->status : 'pending',
            'code'             => $payment->code ?? 'REG-' . uniqid(),
        ]);
        $payment->save();

        // === logika payment type ===
        if ($payment->status === 'paid') {
            return redirect()->route('payment.thankyoupage')
                ->with('success', 'Pembayaran sudah selesai.');
        }

        if ($payment->payment_type === 'tunai') {
            return redirect()->route('payment.waredirect', $payment->id);
        }

        if ($payment->payment_type === 'non-tunai') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $payment->code, // pakai kode unik dari tabel kamu
                    'gross_amount' => $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => $payment->user->name ?? 'Calon Siswa',
                    'email' => $payment->user->email ?? 'email@example.com',
                    'phone' => $payment->user->phone ?? '08123456789',
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return view('payment.midtrans', compact('snapToken', 'payment'));
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
    public function waRedirect($id)
    {
        $payment = Payment::findOrFail($id);

        // buat link WA
        $phone = "6285864921179"; // nomor admin / bendahara
        $message = "Halo Admin Deeniyat, saya ingin melakukan konfirmasi pembayaran pendaftaran.\n
        Kode: {$payment->code}\n
        Nama: " . Auth::user()->name . "\n
        Jumlah: Rp " . number_format($payment->amount, 0, ',', '.');

        $url = "https://wa.me/{$phone}?text=" . urlencode($message);

        Auth::logout();
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
    $user = Auth::user();

    // cek apakah user sudah punya pembayaran register
    $existingPayment = Payment::where('user_id', $user->id)
        ->where('payment_for', 'register')
        ->first();

    if ($existingPayment) {
        // update pilihan payment kalau sudah ada
        $existingPayment->update([
            'payment_category' => $request->payment_category, // lunas / cicilan
            'payment_type'     => $request->payment_type,     // tunai / non-tunai
        ]);

        $payment = $existingPayment;
    } else {
        // handle pembuatan payment baru sesuai kategori
        if ($request->payment_category === 'lunas') {
            // langsung buat 1 payment 450k
            $payment = Payment::create([
                'user_id'          => $user->id,
                'class_id'         => null,
                'payment_for'      => 'register',
                'payment_category' => 'lunas',
                'payment_type'     => $request->payment_type,
                'method'           => $request->payment_type === 'non-tunai' ? 'midtrans' : 'tunai',
                'code'             => strtoupper(uniqid('REG-')),
                'due_date'         => now()->addDays(3),
                'amount'           => 450000,
                'installment_to'   => null,
                'description'      => 'Pembayaran pendaftaran (lunas)',
                'status'           => 'pending',
            ]);
        } else {
            // buat installment parent
            $installment = Installment::create([
                'user_id'           => $user->id,
                'nominal'           => 450000,
                'remaining_balance' => 450000,
                    'due_date'          => Carbon::now()->addMonth(2), // jatuh tempo pertama
                'status'            => 'pending',
            ]);

            // pecah jadi 3x payment @150k
            $cicilan = 3;
            $nominal = 450000 / $cicilan;
            $payment = null;

            for ($i = 1; $i <= $cicilan; $i++) {
                $p = Payment::create([
                    'installment_id'   => $installment->id,
                    'user_id'          => $user->id,
                    'class_id'         => null,
                    'payment_for'      => 'register',
                    'payment_category' => 'cicilan',
                    'payment_type'     => $request->payment_type,
                    'method'           => $request->payment_type === 'non-tunai' ? 'midtrans' : 'tunai',
                    'due_date'         => now()->addMonths($i - 1),
                    'amount'           => $nominal,
                    'installment_to'   => $i,
                    'description'      => "Pembayaran pendaftaran cicilan ke-$i",
                    'status'           => 'pending',
                    'code'             => strtoupper(uniqid("REG-INST{$i}-")),
                ]);

                if ($i === 1) {
                    $payment = $p; // simpan cicilan pertama untuk ditampilkan di confirm page
                }
            }
        }
    }

    // simpan ke session untuk showConfirm
    session([
        'payment_id'       => $payment->id,
        'payment_type'     => $payment->payment_type,
        'payment_category' => $payment->payment_category,
        'total_amount'     => $payment->amount,
    ]);

    // bikin SnapToken kalau non-tunai
    $snapToken = null;
    if ($payment->payment_type === 'non-tunai') {
        // dummy dulu
        // $snapToken = 'DUMMY-SNAP-TOKEN';

        // kalau sudah integrasi Midtrans:
        $params = [
            'transaction_details' => [
                'order_id'     => $payment->code,
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
                'phone'      => $user->phone,
            ],
        ];

        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }

    return view('payment.confirmpayment', [
        'payment'   => $payment,
        'snapToken' => $snapToken,
    ]);
}


public function showConfirm()
{
    $paymentId = session('payment_id');
    $payment   = Payment::find($paymentId);

    if (!$payment) {
        return redirect()->route('login')->with('error', 'Data pembayaran tidak ditemukan');
    }

    // default null
    $snapToken = null;

    if ($payment->payment_type === 'non-tunai') {
        // dummy snap token
        $snapToken = 'DUMMY-SNAP-TOKEN';

        // integrasi midtrans kalau sudah siap
        $params = [
            'transaction_details' => [
                'order_id'     => $payment->code,
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->user->name,
                'email'      => $payment->user->email,
                'phone'      => $payment->user->phone,
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }

    return view('payment.confirmpayment', [
        'payment'   => $payment,
        'snapToken' => $snapToken,
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
    // Ambil user yang sedang login
    $user = Auth::user();

    // Atau ambil dari payment terakhir
    $latestPayment = Payment::where('user_id', $user->id ?? null)
        ->latest('id')
        ->first();

        \Illuminate\Support\Facades\Auth::logout();
    return view('payment.thankyoupage', compact('user', 'latestPayment'));
}




    public function finalizePayment(Request $request, $paymentId)
{
    $payment = Payment::findOrFail($paymentId);

    // cek kalau cicilan
    if ($payment->payment_category === 'cicilan') {
        $total = $payment->amount; // misal 450000
        $installments = 3; // jumlah cicilan
        $perInstallment = ceil($total / $installments);

        // 🔹 Buat parent installment
        $installment = Installment::create([
            'user_id'   => $payment->user_id,
            'payment_id'=> $payment->id,
            'nominal'   => $total,
            'status'    => 'pending',
        ]);

        // 🔹 Generate child payments
        for ($i = 1; $i <= $installments; $i++) {
            Payment::create([
                'installment_id'  => $installment->id,
                'user_id'         => $payment->user_id,
                'class_id'        => $payment->class_id,
                'payment_for'     => 'register',
                'payment_category'=> 'cicilan',
                'payment_type'    => $payment->payment_type,
                'amount'          => $perInstallment,
                'status'          => 'pending',
                'code'            => 'CICILAN-' . $installment->id . '-' . $i . '-' . time(),
                'month'           => null,
                'year'            => null,
            ]);
        }

        // update parent payment (boleh pending saja)
        $payment->update([
            'status'            => 'pending',
            'remaining_balance' => $total,
        ]);

    } else {
        // kalau lunas langsung
        $payment->update([
            'remaining_balance' => 0,
            'status'            => 'paid',
            'paid_at'           => now(),
        ]);
    }

    return redirect()->route('student.thankyoupage')
        ->with('success', 'Pembayaran berhasil diproses.');
}



    // history payment
    public function paymentHistory()
    {
        $user = Auth::user();

        // Ambil cicilan (parent + child)
        $installments = Installment::with('payments')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil pembayaran langsung (spp, register lunas, dll)
        $directPayments = Payment::where('user_id', $user->id)
            ->whereNull('installment_id') // berarti bukan cicilan
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.payment.history', compact('installments', 'directPayments'));
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


    public function getSnapToken(Payment $payment)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // ubah ke true kalau sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil user yang login
        $user = Auth::user();

        $params = [
            'transaction_details' => [
                'order_id'      => $payment->code,         // kode unik payment
                'gross_amount'  => $payment->amount,       // nominal
            ],
            'customer_details' => [
                'first_name'    => $user?->name ?? 'User',
                'email'         => $user?->email ?? 'user@example.com',
                'phone'         => $user?->phone ?? '08123456789', // fallback default
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'status'    => 'success',
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

// public function confirm($id)
// {
//     $payment = Payment::with('user')->findOrFail($id);

//     // kalau non-tunai generate Snap Token
//     $snapToken = null;
//     if ($payment->payment_type === 'non-tunai') {
//         \Midtrans\Config::$serverKey = config('midtrans.server_key');
//         \Midtrans\Config::$isProduction = false;
//         \Midtrans\Config::$isSanitized = true;
//         \Midtrans\Config::$is3ds = true;

//         $params = [
//             'transaction_details' => [
//                 'order_id'     => $payment->code,
//                 'gross_amount' => $payment->amount,
//             ],
//             'customer_details' => [
//                 'first_name' => $payment->user->name,
//                 'email'      => $payment->user->email,
//                 'phone'      => $payment->user->phone ?? '08123456789',
//             ],
//         ];

//         $snapToken = \Midtrans\Snap::getSnapToken($params);
//     }

//     return view('payment.confirm', compact('payment', 'snapToken'));
// }


    // Proses simpan jika tunai
    // public function processPayment(Request $request)
    // {
    //     // Simpan payment ke database
    //     $payment = Payment::create([
    //         'user_id'          => $request->user_id,
    //         'class_id'         => $request->class_id,
    //         'payment_for'      => $request->payment_for,
    //         'payment_category' => $request->payment_category,
    //         'amount'           => $request->total_amount,
    //         'status'           => 'pending', // default
    //     ]);

    //     return redirect()->away(
    //         "https://wa.me/6285864921179?text=Halo admin, saya ingin bayar tunai untuk Payment ID {$payment->id}"
    //     );
    // }

}
