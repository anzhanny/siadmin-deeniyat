<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\Installment;
use App\Models\TbClass;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function index()
    {
        return view('student.payment.index');
    }

    /**
     * Display the payment detail page
     */
    public function detailPayment()
    {
        // Ambil user dari Auth, kalau tidak ada ambil dari session
        // $user = Auth::user() ?? User::find(session('user_id'));

        // if (!$user) {
        //     return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        // }

        // $class = TbClass::find($user->class_id);

        // session([
        //     'class_id' => $user->class_id,
        //     'user_id' => $user->id
        // ]);

        // return view('payment.detailpayment', compact('user', 'class'));
        return view('payment.detailpayment');

    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|string', // tunai / non-tunai
            'payment_category' => 'required|string', // lunas / cicilan
        ]);

        // Simpan sementara ke database (status pending jika tunai)
        // Disesuaikan dengan tabel kamu (contoh Payment model)
        $payment = new \App\Models\Payment();
        $payment->user_id = Auth::id() ?? session('user_id');
        $payment->amount = 200000 + 100000 + 150000; // total biaya
        $payment->payment_type = $request->payment_type;
        $payment->payment_category = $request->payment_category;
        $payment->status = $request->payment_type === 'tunai' ? 'pending' : 'paid';
        $payment->save();

        return redirect()->route('student.dashboard')->with('success', 'Pendaftaran berhasil, proses pembayaran disimpan.');
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
        // Store payment choices in session
        session([
            'payment_type' => $request->input('payment_type'),
            'payment_method' => $request->input('payment_method'),
            'total_amount' => 450000, // Default total amount
        ]);

        // Store student data in session (this should come from the registration form)
        // For now, we'll use default values or get from session if available
        if (!session('student_name')) {
            session([
                'student_name' => 'Nama Siswa',
                'student_email' => 'email@example.com',
                'student_phone' => '081234567890',
                'student_address' => 'Alamat Siswa',
                'student_birthplace' => 'Tempat Lahir',
                'student_birthdate' => '01/01/2010',
                'student_gender' => 'Laki-Laki',
                'student_class' => 'Kelas 1',
                'father_name' => 'Nama Ayah',
            ]);
        }

        return view('payment.confirmpayment');
    }

    public function thankyouPage()
    {
        // $payment = Payment::with(['user', 'class', 'installments'])->findOrFail($paymentId);

        // // Ensure user can only see their own payment
        // if ($payment->user_id !== Auth::id()) {
        //     abort(403);
        // }

        // return view('payment.confirmpayment', compact('payment'));
        return view('payment.thanyoupage');
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
}
