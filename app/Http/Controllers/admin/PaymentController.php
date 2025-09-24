<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\TbClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SppInvoiceMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::with(['user', 'class', 'installments'])
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('admin.payment.index', compact('data'));
    }

    // optional: form page (modal also possible) -> kita sediakan showGenerateSppForm to render modal form if needed
    public function showGenerateSppForm()
    {
        // jika butuh data kelas, kirim juga
        $classes = \App\Models\TbClass::all();
        return view('admin.payment.generateSPP', compact('classes'));
    }

    // Generate SPP payments for selected students and send email
    public function generateSPP(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'year' => 'required|digits:4',
            'class_id' => 'nullable|integer',
            'amount' => 'nullable|numeric',
        ]);

        $month = $request->month;
        $year = $request->year;
        $classId = $request->class_id;
        $amount = $request->amount ?? 50000; // default 50k

        // choose students (role_id = 2 as your convention)
        $studentsQuery = User::where('role_id', 2);
        if ($classId) $studentsQuery->where('class_id', $classId);
        $students = $studentsQuery->get();

        $created = 0;
        foreach ($students as $student) {
            // avoid duplicate for same month/year
            $exists = Payment::where('user_id', $student->id)
                ->where('payment_for', 'spp')
                ->where('month', $month)
                ->where('year', $year)
                ->exists();

            if ($exists) continue;

            DB::beginTransaction();
            try {
                $payment = Payment::create([
                    'user_id' => $student->id,
                    'class_id' => $student->class_id,
                    'payment_for' => 'spp',
                    'payment_category' => 'lunas',
                    'payment_type' => 'non-tunai',
                    'method' => 'qris',
                    'code' => 'SPP-' . strtoupper(uniqid()),
                    'amount' => $amount,
                    'month' => $month,
                    'year' => $year,
                    'status' => 'pending',
                ]);

                // send email (Mailable)
                Mail::to($student->email)->send(new SppInvoiceMail($payment));

                DB::commit();
                $created++;
            } catch (Exception $e) {
                DB::rollBack();
                // log and continue
                Log::error("Generate SPP failed for user {$student->id}: " . $e->getMessage());
                continue;
            }
        }

        return back()->with('success', "Generate selesai. Tagihan dibuat dan email dikirim ke {$created} siswa.");
    }

    public function sendSppInvoices($month, $year)
    {
        // Ambil semua siswa yang sudah daftar
        $payments = Payment::where('payment_for', 'SPP')
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        foreach ($payments as $payment) {
            try {
                // Pakai queue supaya dikirim di background
                // Mail::to($payment->user->email)
                //     ->queue(new SppInvoiceMail($payment));

                Mail::to($payment->user->email)
                    ->send(new SppInvoiceMail($payment));

                Log::info("Email tagihan SPP terkirim ke {$payment->user->email}");
            } catch (\Exception $e) {
                Log::error("Gagal kirim email ke {$payment->user->email}: " . $e->getMessage());
            }
        }

        return back()->with('success', 'Email tagihan SPP berhasil dikirim.');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getStudentClass($id)
    {
        $student = User::with('class') // pastikan relasi sudah ada
            ->where('role_id', 2)
            ->findOrFail($id);

        return response()->json([
            'class_id' => $student->class_id,
            'class_name' => $student->class->class_name ?? '-'
        ]);
    }

    public function create()
    {
        $students = User::where('role_id', 2)->get(); // role_id=2 untuk siswa
        $classes = TbClass::all(); // ganti SchoolClass sesuai model kelas kamu
        return view('admin.payment.create', compact('students', 'classes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_for'       => 'required|in:register,spp',
            'payment_type'      => 'required|string|max:255',
            'payment_category'  => 'required|string|max:255',
            'amount'            => 'required|numeric',
            'method'            => 'required|string|max:50',
            'month'             => 'nullable|string|max:50',
            'status'            => 'required|in:pending,paid,failed',
            'paid_at'           => 'nullable|date',
        ]);

        $user = User::findOrFail($request->user_id);
        $validated['class_id'] = $user->class_id;

        if ($request->filled('paid_at')) {
            $validated['paid_at'] = date('Y-m-d H:i:s', strtotime($request->paid_at));
        }

        Payment::create($validated);

        return redirect()->route('admin.payment.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */


    // public function updateStatus(Request $request, $id)
    // {
    //     $payment = Payment::findOrFail($id);

    //     // toggle status
    //     if ($payment->status === 'paid') {
    //         $payment->status = 'failed';
    //         $payment->paid_at = null; // reset kalau dibatalkan
    //     } else {
    //         $payment->status = 'paid';
    //         $payment->paid_at = now(); // set tanggal bayar
    //     }

    //     $payment->save();

    //     return redirect()->back()->with('success', 'Status pembayaran berhasil diubah.');
    // }



    public function updateStatus(Request $request, $id)
{
    $payment = Payment::with('installments')->findOrFail($id);

    if ($payment->payment_category === 'cicilan') {
        // Misalnya admin pilih cicilan mana yang dibayar (kirim installment_id via request)
        $installment = $payment->installments()->find($request->installment_id);

        if ($installment) {
            $installment->status = $installment->status === 'paid' ? 'pending' : 'paid';
            $installment->paid_at = $installment->status === 'paid' ? now() : null;
            $installment->save();
        }
    } else {
        // Kalau pembayaran sekali lunas (register/SPP)
        $payment->status = $payment->status === 'paid' ? 'pending' : 'paid';
        $payment->paid_at = $payment->status === 'paid' ? now() : null;
        $payment->save();
    }

    return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
}



    // show detail payment
    public function show(string $id)
    {
        $payment = Payment::with('user', 'class', 'installments')->findOrFail($id);
        return view('admin.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $students = User::where('role_id', 2)->get();
        $classes = TbClass::all();
        return view('admin.payment.edit', compact('payment', 'students', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'class_id'      => 'required|exists:tb_class,id',
            'payment_type'  => 'required|string|max:255',
            'payment_category' => 'required|string|max:255',
            'amount'        => 'required|numeric',
            'method'        => 'required|string|max:50',
            'month'         => 'nullable|string|max:50',
            'status'        => 'required|in:pending,paid,failed',
            'paid_at'       => 'nullable|date',
        ]);

        if ($request->filled('paid_at')) {
            $validated['paid_at'] = date('Y-m-d H:i:s', strtotime($request->paid_at));
        }

        $payment = Payment::findOrFail($id);
        $payment->update($validated);

        return redirect()->route('admin.payment.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Payment::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.payment.index')
            ->with('success', 'Data pembayaran berhasil dihapus');
    }
}
