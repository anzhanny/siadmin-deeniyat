<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        // ambil semua cicilan beserta relasi user & payment
        $data = Installment::with(['payment.user'])
            ->orderBy('due_date')
            ->paginate(10);

        return view('admin.installment.index', compact('data'));
    }

    public function create()
    {
        $data = Payment::with('user')->get(); // semua payment + user
        return view('admin.installment.create', compact('data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:tb_payments,id',
        ]);

        $payment = Payment::findOrFail($request->payment_id);

        // fix 3x cicilan
        $tenor = 3;
        $perInstallment = $payment->amount / $tenor;
        $startDate = now();

        for ($i = 1; $i <= $tenor; $i++) {
            Installment::create([
                'payment_id'        => $payment->id,
                'installments_to'   => $i,
                'nominal'           => $perInstallment,
                'due_date'          => $startDate->copy()->addMonths($i - 1),
                'paid_at'           => $i === 1 ? now() : null, // cicilan pertama otomatis dibayar
                'remaining_balance' => $payment->amount - ($perInstallment * $i),
            ]);
        }

        return redirect()->route('admin.installment.index')
            ->with('success', 'Jadwal cicilan 3x berhasil dibuat.');
    }

    public function show($id)
    {
        // ambil user beserta payment + installments
        $user = User::with(['class', 'payments.installments'])->findOrFail($id);

        return view('admin.installment.show', compact('student'));
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'payment_id' => 'required|integer',
    //         'nominal' => 'required|string|max:50',
    //         'installments_to' => 'required|string|max:15',
    //         'paid_at' => 'required|date',
    //         'remaining_balance' => 'required|string|max:50',
    //     ]);

    //     Installment::create($request->all());

    //     return redirect()->route('admin.installment.index')
    //         ->with('success', 'Data cicilan berhasil ditambahkan.');
    // }

    public function edit($id)
    {
        $data = Installment::findOrFail($id);
        return view('admin.installment.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_id' => 'required|integer',
            'nominal' => 'required|string|max:50',
            'installments_to' => 'required|string|max:15',
            'paid_at' => 'required|date',
            'remaining_balance' => 'required|string|max:50',
        ]);

        $data = Installment::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Installment::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil dihapus.');
    }

    public function installmentList()
    {
        $data = Payment::with('installments')
            ->where('payment_for', 'register')
            ->where('payment_category', 'cicilan')
            ->get();

        return view('admin.payment.installments', compact('data'));
    }

     public function updateDueDate(Request $request, Installment $data)
    {
        $request->validate([
            'due_date' => 'required|date',
        ]);

        $data->update([
            'due_date' => $request->due_date,
        ]);

        return back()->with('success', 'Jatuh tempo cicilan berhasil diupdate.');
    }

    public function updateStatus($id)
{
    $data = Installment::findOrFail($id);

    // toggle status
    if ($data->status === 'paid') {
        $data->status = 'unpaid';
        $data->paid_at = null;
    } else {
        $data->status = 'paid';
        $data->paid_at = now();
    }

    $data->save();

    // opsional: cek apakah semua cicilan sudah lunas -> update parent payment
    $payment = $data->payment;
    if ($payment->installments()->where('status','!=','paid')->count() === 0) {
        $payment->status = 'paid';
    } else {
        $payment->status = 'pending';
    }
    $payment->save();

    return back()->with('success', 'Status cicilan berhasil diperbarui.');
}

}
