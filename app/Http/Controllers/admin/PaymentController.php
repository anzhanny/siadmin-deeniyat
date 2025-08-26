<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use App\Models\TbClass;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
     // Ambil data payment + data siswa (user) + data kelas (class)
    $data = Payment::with(['user', 'class'])->paginate(10);
    return view('admin.payment.index', compact('data'));
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
        'user_id'       => 'required|exists:users,id',
        'class_id'      => 'required|exists:tb_class,id',
        'payment_type'  => 'required|string|max:255',
        'amount'        => 'required|numeric',
        'method'        => 'required|in:cash,transfer',
        'month'         => 'nullable|string|max:50',
        'status'        => 'required|in:pending,paid,failed',
        'paid_at'       => 'nullable|date', // validasi tanggal
    ]);

    // Format tanggal kalau diisi
    if ($request->filled('paid_at')) {
        $validated['paid_at'] = date('Y-m-d', strtotime($request->paid_at));
    } else {
        $validated['paid_at'] = null;
    }

    Payment::create($validated);

    return redirect()->route('admin.payment.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $payment = Payment::with(['user', 'class'])->findOrFail($id);
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
        'amount'        => 'required|numeric',
        'method'        => 'required|in:cash,transfer',
        'month'         => 'nullable|string|max:50',
        'status'        => 'required|in:pending,paid,failed',
        'paid_at'       => 'nullable|date', // validasi tanggal
    ]);

    // Format tanggal kalau diisi
    if ($request->filled('paid_at')) {
        $validated['paid_at'] = date('Y-m-d', strtotime($request->paid_at));
    } else {
        $validated['paid_at'] = null;
    }

    $payment = Payment::findOrFail($id);
    $payment->update($validated);

    return redirect()->route('admin.payment.index')->with('success', 'Data pembayaran berhasil diperbarui.');
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
