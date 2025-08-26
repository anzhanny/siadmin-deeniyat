<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
        public function index()
    {
        $installment = Installment::latest()->paginate(10);
        return view('admin.installment.index', compact('installment'));
    }

    public function create()
    {
        return view('admin.installment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|integer',
            'nominal' => 'required|string|max:50',
            'installments_to' => 'required|string|max:15',
            'paid_at' => 'required|date',
            'remaining_balance' => 'required|string|max:50',
        ]);

        Installment::create($request->all());

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $installment = Installment::findOrFail($id);
        return view('admin.installment.edit', compact('installment'));
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

        $installment = Installment::findOrFail($id);
        $installment->update($request->all());

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $installment = Installment::findOrFail($id);
        $installment->delete();

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil dihapus.');
    }
}
