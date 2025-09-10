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
use Illuminate\Support\Facades\Log;
use Exception;

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
        // Get user from session or create a default class object
        $class = null;

        // Try to get class from session
        if (session('class_id')) {
            $class = TbClass::find(session('class_id'));
        }

        // If no class found, create a default class object with default fees
        if (!$class) {
            $class = (object) [
                'registration_fee' => 200000,
                'infrastructure_fee' => 100000,
                'uniform_fee' => 150000
            ];
        }

        return view('payment.detailpayment', compact('class'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_type'   => 'required|in:tunai,non-tunai',
            'payment_method' => 'required|in:lunas,cicilan',
            'user_id'        => 'required|integer',
            'class_id'       => 'required|integer|min:0',
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
        // Validate the request
        $request->validate([
            'payment_type' => 'required|in:tunai,non-tunai',
            'payment_method' => 'required|in:lunas,cicilan',
            'user_id' => 'nullable|integer',
            'class_id'       => 'required|integer|exists:tb_class,id', // pakai class_id dari tabel
        ]);

        // Ambil kelas dari tabel tb_class
        $class = TbClass::find($request->class_id);

        // Calculate total amount based on class
        $totalAmount = 450000; // Default amount
        if ($request->input('class_id')) {
            // You can add logic here to calculate based on actual class fees
            $totalAmount = 450000; // For now, using default
        }

        // Store payment choices in session
        session([
            'payment_type'   => $request->input('payment_type'),
            'payment_method' => $request->input('payment_method'),
            'total_amount'   => $totalAmount,
            'user_id'        => $request->input('user_id'),
            'class_id'       => $class->id,
            'student_class'  => $class->class_name, // nama kelas dari tabel
        ]);

        // Get user data from session or database
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if ($user) {
            // Store user data in session for display
            session([
                'student_name' => $user->name,
                'student_email' => $user->email,
                'student_phone' => $user->phone,
                'student_address' => $user->address,
                'student_birthplace' => $user->birthplace,
                'student_birthdate' => $user->birthdate,
                'student_gender' => $user->gender,
                'student_class' => $this->getClassName($user->class_id),
                'father_name' => $user->father_name,
                'father_job' => $user->father_job,
                'mother_name' => $user->mother_name,
                'mother_job' => $user->mother_job,
            ]);
        } else {
            // Fallback to default values if user not found
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
        // $payment = Payment::with(['user', 'class', 'installments'])->findOrFail($paymentId);

        // // Ensure user can only see their own payment
        // if ($payment->user_id !== Auth::id()) {
        //     abort(403);
        // }

        // return view('payment.confirmpayment', compact('payment'));
        return view('payment.thanyoupage');
    }

    /**
     * Finalize payment and save all data to database
     */
    public function finalizePayment(Request $request)
    {
        try {
            DB::beginTransaction();

            // Get user data from session
            $userId = session('user_id');

            if (!$userId) {
                throw new Exception('User session not found. Please register again.');
            }

            $user = User::find($userId);

            if (!$user) {
                throw new Exception('User not found in database');
            }

            // Validate required session data
            $requiredFields = [
                'student_birthplace',
                'student_birthdate',
                'student_gender',
                'student_phone',
                'student_address',
                'class_id',
                'father_name',
                'payment_type',
                'payment_method',
                'total_amount'
            ];

            foreach ($requiredFields as $field) {
                if (!session($field)) {
                    throw new Exception("Missing required data: {$field}");
                }
            }

            // Update user with additional information if not already set
            $user->update([
                'birthplace' => session('student_birthplace'),
                'birthdate' => session('student_birthdate'),
                'gender' => session('student_gender'),
                'phone' => session('student_phone'),
                'address' => session('student_address'),
                'class_id' => session('class_id'),
                'father_name' => session('father_name'),
                'father_job' => session('father_job', ''),
                'mother_name' => session('mother_name', ''),
                'mother_job' => session('mother_job', ''),
                'is_active' => 1,
                'role_id' => 2, // Student role
            ]);

            // Create payment record
            $payment = Payment::create([
                'user_id' => $userId,
                'class_id' => session('class_id'),
                'amount' => session('total_amount', 450000),
                'payment_type' => session('payment_type'),
                'payment_method' => session('payment_method'),
                'payment_category' => session('payment_method'), // Also store as payment_category for compatibility
                'status' => 'completed',
                'paid_at' => now(),
                'code' => 'PAY-' . time() . '-' . $userId, // Generate unique payment code
            ]);

            // If payment method is installment, create installment records
            if (session('payment_method') === 'cicilan') {
                $totalAmount = session('total_amount', 450000);
                $installmentAmount = ceil($totalAmount / 3); // 3 installments

                for ($i = 1; $i <= 3; $i++) {
                    $amount = ($i == 3) ? ($totalAmount - ($installmentAmount * 2)) : $installmentAmount;

                    Installment::create([
                        'payment_id' => $payment->id,
                        'nominal' => $amount,
                        'installments_to' => $i,
                        'paid_at' => ($i == 1) ? now() : null, // First installment is paid
                        'remaining_balance' => $totalAmount - ($amount * $i),
                    ]);
                }
            }

            // Clear session data
            session()->forget([
                'student_name',
                'student_email',
                'student_phone',
                'student_address',
                'student_birthplace',
                'student_birthdate',
                'student_gender',
                'student_class',
                'father_name',
                'father_job',
                'mother_name',
                'mother_job',
                'payment_type',
                'payment_method',
                'total_amount'
            ]);

            DB::commit();

            // Log successful registration
            Log::info('User registration completed successfully', [
                'user_id' => $userId,
                'email' => $user->email,
                'payment_id' => $payment->id,
                'nis' => $user->nis
            ]);

            // Redirect to thank you page
            return redirect()->route('payment.thankyoupage')
                ->with('success', 'Pendaftaran berhasil! NIS Anda: ' . $user->nis);
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyelesaikan pendaftaran: ' . $e->getMessage()]);
        }
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
