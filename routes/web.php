<?php

use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\MigrateStudentController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\StudentController as AdminStudentController;
use App\Http\Controllers\admin\InstallmentController;
use App\Http\Controllers\admin\PayRegisterController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\SppController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\InstallmentController as StudentInstallmentController;
use App\Http\Controllers\student\PaymentController as StudentPaymentController;
use App\Http\Controllers\student\PaymentStudentController;
use App\Http\Controllers\student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\SppController as StudentSppController;
use App\Http\Controllers\student\SppDataController as StudentSppDataController;
use App\Models\Installment;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// auth login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::get('/home', function () {
    $user = Auth::user();
    if ($user->role_id == 1) { // admin
        return redirect('/admin/dashboard');
    } elseif ($user->role_id == 2) { // student
        return redirect('/student/dashboard');
    } else {
        Auth::logout();
        return redirect('/')->withErrors('Role pengguna tidak dikenali...');
    }
});

Route::get('/landing', function () {
    return view('index'); // resources/views/home.blade.php
})->name('landing');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SesiController::class, 'logout']);
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});


//register
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [SesiController::class, 'register'])->name('register.store');

//profile
Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');

Route::get('/finalpayment', function () {
    return view('finalpayment');
})->name('finalpayment');


// admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/student-data', [AdminStudentController::class, 'index'])->name('admin.student.index');
Route::get('/admin/student-data/create', [AdminStudentController::class, 'create'])->name('admin.student.create');
Route::post('/admin/student-data', [AdminStudentController::class, 'store'])->name('admin.student.store');
Route::get('/admin/student-data/{id}/edit', [AdminStudentController::class, 'edit'])->name('admin.student.edit');
Route::get('/admin/student-data/{id}/show', [AdminStudentController::class, 'show'])->name('admin.student.show');
Route::put('/admin/student-data/{id}', [AdminStudentController::class, 'update'])->name('admin.student.update');
Route::delete('/admin/student-data/{id}', [AdminStudentController::class, 'destroy'])->name('admin.student.destroy');

Route::get('/admin/class-data', [ClassController::class, 'index'])->name('admin.class.index');
Route::get('/admin/class-data/create', [ClassController::class, 'create'])->name('admin.class.create');
Route::post('admin/class-data', [ClassController::class, 'store'])->name('admin.class.store');
Route::get('/admin/class-data/{id}/edit', [ClassController::class, 'edit'])->name('admin.class.edit');
Route::put('/admin/class-data/{id}', [ClassController::class, 'update'])->name('admin.class.update');
Route::delete('/admin/class-data/{id}', [ClassController::class, 'destroy'])->name('admin.class.destroy');

Route::get('/admin/payment-data', [PaymentController::class, 'index'])->name('admin.payment.index');
Route::get('/admin/payment-data/create', [PaymentController::class, 'create'])->name('admin.payment.create');
Route::post('/admin/payment-data', [PaymentController::class, 'store'])->name('admin.payment.store');
Route::get('/admin/payment-data/{id}/edit', [PaymentController::class, 'edit'])->name('admin.payment.edit');
Route::get('/admin/payment-data/{id}/show', [PaymentController::class, 'show'])->name('admin.payment.show');
Route::put('/admin/payment-data/{id}/updateStatus', [PaymentController::class, 'updateStatus'])->name('admin.payment.updateStatus');
Route::put('/admin/installment/{id}/updateStatus', [InstallmentController::class, 'updateStatus'])->name('admin.installment.updateStatus');
Route::put('/admin/payment-data/{id}', [PaymentController::class, 'update'])->name('admin.payment.update');
Route::delete('/admin/payment-data/{id}', [PaymentController::class, 'destroy'])->name('admin.payment.destroy');

// ADMIN - Payment Management

Route::post('admin/payment-data/send/{month}/{year}', [PaymentController::class, 'sendSppInvoices'])->name('admin.payments.send');
Route::get('admin/payment-data/generateSPP/form', [PaymentController::class, 'showGenerateSppForm'])->name('admin.payments.generateSPP.form');
Route::match(['get', 'post'], '/admin/payment-data/generateSPP', [PaymentController::class, 'generateSPP'])->name('admin.payment.generateSPP');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('payment', PaymentController::class);

    // khusus filter pembayaran
    Route::get('payment/spp', [PaymentController::class, 'spp'])->name('payment.spp.index');
});
Route::get('admin/spp-data', [SppController::class, 'index'])->name('admin.spp.index');
Route::get('admin/spp-data/create', [SppController::class, 'create'])->name('admin.spp.create');
Route::post('admin/spp-data', [SppController::class, 'store'])->name('admin.spp.store');
Route::get('admin/spp-data/{id}/edit', [SppController::class, 'edit'])->name('admin.spp.edit');
Route::get('admin/spp-data/{id}/show', [SppController::class, 'show'])->name('admin.spp.show');
Route::put('admin/spp-data/{id}', [SppController::class, 'update'])->name('admin.spp.update');
Route::delete('admin/spp-data/{id}', [SppController::class, 'destroy'])->name('admin.spp.destroy');
Route::get('admin/spp-data/{id}/send-invoice', [SppController::class, 'sendInvoice'])->name('admin.spp.sendInvoice');


Route::get('/get-student-class/{id}', [PaymentController::class, 'getStudentClass']);

Route::get('admin/installment-data', [InstallmentController::class, 'index'])->name('admin.installment.index');
Route::get('admin/installment-data/create', [InstallmentController::class, 'create'])->name('admin.installment.create');
Route::post('admin/installment-data', [InstallmentController::class, 'store'])->name('admin.installment.store');
Route::get('admin/installment-data/{id}/edit', [InstallmentController::class, 'edit'])->name('admin.installment.edit');
Route::get('admin/installment-data/{id}/show', [InstallmentController::class, 'show'])->name('admin.installment.show');
Route::put('admin/installment-data/{id}', [InstallmentController::class, 'update'])->name('admin.installment.update');
Route::put('admin/installment-data/{installment}/updateStatus', [InstallmentController::class, 'updateDueDate'])->name('admin.installment.updateDueDate');
Route::delete('admin/installment-data/{id}', [InstallmentController::class, 'destroy'])->name('admin.installment.destroy');

// Laporan
Route::get('admin/report-data', [ReportController::class, 'index'])->name('admin.report.index');


// student
Route::post('payment/midtrans/notification', [PaymentStudentController::class, 'notificationHandler'])->name('midtrans.notification');
Route::get('/payment/midtrans/{id}/fake', [PaymentStudentController::class, 'midtransFake'])->name('payment.midtransFake');
Route::get('/payment/midtrans/{id}/success', [PaymentStudentController::class, 'midtransSuccess'])->name('payment.midtransSuccess');
Route::get('/payment/midtrans/{id}', [PaymentStudentController::class, 'midtransSimulation'])->name('payment.midtrans.simulation');
Route::get('/payment/midtrans/success/{id}', [PaymentStudentController::class, 'midtransSuccess'])->name('payment.midtrans.success');

Route::post('/midtrans/notification', [PaymentController::class, 'notificationHandler']);
Route::get('/midtrans-test', [MidtransCallbackController::class, 'testMidtrans']);

Route::get('/payment/snap/{id}', [PaymentStudentController::class, 'payWithSnap'])->name('payment.snap');
Route::get('/payment/qris/{id}', [PaymentStudentController::class, 'payQris'])->name('payment.qris');

Route::post('/payment/callback', [PaymentStudentController::class, 'handleCallback'])->name('payment.callback');

Route::post('/student/payment/{id}/simulate', [PaymentStudentController::class, 'simulate'])
    ->name('student.payment.simulate');

Route::get('/student/installment/pay/{id}', [PaymentStudentController::class, 'payInstallment'])->name('student.installment.pay');
Route::get('/student/installment/wa-redirect/{id}',[PaymentStudentController::class, 'waRedirectInstallment'])->name('payment.waredirect_installment');


// wa
Route::get('payment/wa/{id}', [PaymentStudentController::class, 'waRedirect'])->name('payment.waredirect');

// student
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

Route::get('/student/payment', [PaymentStudentController::class, 'index'])->name('student.payment.index');
Route::get('/student/register-payment', [PaymentStudentController::class, 'registerPayment'])->name('student.payment.register');

Route::middleware('auth')->group(function () {

    // Halaman daftar SPP
    Route::get('/student/payment/spp', [PaymentStudentController::class, 'sppPayment'])->name('student.payment.spp');

    // Proses bayar SPP per bulan (POST)
    Route::post('/student/payment/spp/pay/{month}', [PaymentStudentController::class, 'paySpp'])->name('student.payment.spp.pay');

    // Callback sukses pembayaran SPP dari Midtrans
    Route::get('/student/payment/spp/success/{id}', [PaymentStudentController::class, 'sppSuccess'])->name('student.payment.spp.success');

    // kalo ada cicilan
    Route::get('/student/payment/register', [PaymentStudentController::class, 'registerPayment'])->name('student.payment.register');
    Route::post('/student/payment/register/pay/{id}', [PaymentStudentController::class, 'payRegister'])->name('student.payment.register.pay');

    Route::get('/student/payment/installment', [PaymentStudentController::class, 'installmentPayment'])->name('student.payment.installment');
    Route::post('/student/payment/installment/pay/{id}', [PaymentStudentController::class, 'payInstallment'])->name('student.payment.installment.pay');


    // Riwayat Pembayaran
    Route::get('/student/payment/history', [PaymentStudentController::class, 'paymentHistory'])->name('student.payment.history');
});



Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile.index');
Route::post('/student/profile', [StudentProfileController::class, 'store'])->name('student.profile.store');
Route::get('/student/profile/{id}/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
Route::put('/student/profile/{id}', [StudentProfileController::class, 'update'])->name('student.profile.update');

Route::get('/migrate-student', [MigrateStudentController::class, 'migrate']);

// Payment routes
Route::prefix('payment')->name('payment.')->group(function () {
    // Route::post('/process', [PaymentStudentController::class, 'processPayment'])->name('process');
    Route::post('/complete/{payment_id}', [PaymentStudentController::class, 'completePayment'])->name('complete');
});

Route::get('/payment/detail', [PaymentStudentController::class, 'detailPayment'])->name('payment.detailpayment');
Route::post('/payment/confirm', [PaymentStudentController::class, 'confirmPayment'])->name('payment.confirmpayment');
Route::get('/payment/confirm', [PaymentStudentController::class, 'showConfirm'])->name('payment.showConfirm');

Route::post('/payment/process/{id}', [PaymentStudentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/thankyou', [PaymentStudentController::class, 'thankyouPage'])->name('payment.thankyoupage');

Route::post('payment/finalize', [PaymentStudentController::class, 'finalizePayment'])->name('payment.finalize');

// Rute untuk halaman Thank You setelah pembayaran
// Route::get('/payment/thankyoupage', function () {
//     return view('payment.thankyoupage'); // pastikan file ada di resources/views/thankyou.blade.php
// })->name('payment.thankyoupage');

// STUDENT - Payment
Route::prefix('student')->name('student.')->group(function () {});


// TESTING EMAIL TINKER
Route::get('/tes-email', function () {
    Mail::raw('Tes kirim email dari Laravel 12 🚀', function ($message) {
        $message->to('deeniyatalhidayah01@gmail.com')
            ->subject('Coba Email Laravel 12');
    });

    return "Email terkirim!";
});

// Register Payment
Route::prefix('payment')->controller(PaymentStudentController::class)->group(function () {
    Route::get('/', 'index')->name('student.payment.index');
    Route::get('/register', 'registerPayment')->name('student.payment.register');
    Route::post('/register/confirm', 'confirmPayment')->name('student.payment.confirm');
    Route::get('/wa/{id}', 'waRedirect')->name('payment.waredirect');
    Route::post('/midtrans/callback', 'midtransCallback')->name('payment.callback');
});

// Installments
Route::prefix('installment')->controller(PaymentStudentController::class)->group(function () {
    Route::get('/', 'installmentPayment')->name('student.installment.index');
    Route::post('/pay/{id}', 'payInstallment')->name('student.installment.pay');
    Route::get('/wa/{id}', 'waRedirectInstallment')->name('installment.waredirect');
    Route::post('/midtrans/callback', 'midtransCallback')->name('installment.callback');
});

// SPP
Route::get('/student/spp', [PaymentStudentController::class, 'sppPayment'])->name('student.payment.spp');
Route::post('/student/spp/pay/{month}', [PaymentStudentController::class, 'paySpp'])->name('student.spp.pay');
Route::post('/student/spp/midtrans/callback', [PaymentStudentController::class, 'midtransCallback'])->name('spp.callback');