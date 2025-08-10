<?php

use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\MigrateStudentController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\StudentController as AdminStudentController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\student\DashboardController as StudentDashboardController;
use App\Http\Controllers\student\ProfileController as StudentProfileController;
use App\Http\Controllers\student\SppDataController as StudentSppDataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if ($user->role == 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role == 'student') {
        return redirect('/student/dashboard');
    } else {
        Auth::logout();
        return redirect('/')->withErrors('Role pengguna tidak dikenali.');
    }
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [SesiController::class, 'logout']);
    Route::post('/logout',[SesiController::class, 'logout'])->name('logout');
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

Route::get('/admin/student-data', [AdminStudentController::class, 'index'])->name('admin.student.index');
Route::get('/admin/student-data/create', [AdminStudentController::class, 'create'])->name('admin.student.create');
Route::post('/admin/student-data', [AdminStudentController::class, 'store'])->name('admin.student.store');
Route::get('/admin/student-data/{id}/edit', [AdminStudentController::class, 'edit'])->name('admin.student.edit');
Route::put('/admin/student-data/{id}', [AdminStudentController::class, 'update'])->name('admin.student.update');
Route::delete('/admin/student-data/{id}', [AdminStudentController::class, 'destroy'])->name('admin.student.destroy');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/class-data', [ClassController::class, 'index'])->name('admin.class.index');
Route::get('/admin/class-data/create', [ClassController::class, 'create'])->name('admin.class.create');
Route::post('admin/class-data', [ClassController::class, 'store'])->name('admin.class.store');
Route::get('/admin/class-data/{id}/edit', [ClassController::class, 'edit'])->name('admin.class.edit');
Route::put('/admin/class-data/{id}', [ClassController::class, 'update'])->name('admin.class.update');
Route::delete('/admin/class-data/{id}', [ClassController::class, 'destroy'])->name('admin.class.destroy');


Route::get('admin/payment-data', [PaymentController::class, 'index'])->name('admin.payment.index');
Route::get('admin/payment-data/create', [PaymentController::class, 'create'])->name('admin.payment.create');
Route::post('admin/payment-data', [PaymentController::class, 'store'])->name('admin.payment.store');

// student
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

Route::get('/student/spp-data', [StudentSppDataController::class, 'index'])->name('student.sppdata');
Route::get('/student/sppdata/create', [StudentSppDataController::class, 'create']);
Route::resource('/student/sppdata', StudentSppDataController::class)->names('sppdata');

Route::post('/student/spp-data/create', [StudentSppDataController::class, 'create']);
Route::put('/student/spp-data/updated{id}', [StudentSppDataController::class, 'update']);
Route::delete('/student/spp-data/delete{id}', [StudentSppDataController::class, 'destroy']);


Route::get('/migrate-student', [MigrateStudentController::class, 'migrate']);

Route::get('/detailpayment', function () {
    return view('detailpayment');
})->name('detailpayment');




