<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\User;
use App\Models\TbClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class InstallmentController extends Controller
{
    /**
     * List semua cicilan
     */
    public function index(Request $request)
    {
        $installments = Installment::with(['user.class', 'payments'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->class_id, fn($q) => $q->whereHas('user.class', fn($qq) => $qq->where('id', $request->class_id)))
            ->latest()
            ->paginate(10);

        return view('admin.installment.index', compact('installments'));
    }

    // public function updateDueDate(Request $request, $id)
    // {
    //     $request->validate([
    //         'due_date' => 'required|date'
    //     ]);

    //     $installment = Installment::findOrFail($id);
    //     $installment->due_date = $request->due_date;
    //     $installment->save();

    //     return back()->with('success', 'Jatuh tempo berhasil diperbarui');
    // }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,partial,paid'
        ]);

        $installment = Installment::with('payments')->findOrFail($id);
        $installment->status = $request->status;

        if ($request->status === 'paid') {
            $installment->remaining_balance = 0;
            $installment->paid_at = now();
        } elseif ($request->status === 'pending') {
            $installment->remaining_balance = $installment->amount; // reset
            $installment->paid_at = null;
        }

        $installment->save();

        return back()->with('success', 'Status cicilan berhasil diperbarui');
    }


    /**
     * Form create cicilan baru
     */
    public function create()
    {
        $students = User::where('role_id', 2)->get();
        $classes  = TbClass::all();

        return view('admin.installment.create', compact('students', 'classes'));
    }



    /**
     * Store cicilan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'class_id'    => 'required|exists:tb_class,id',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $validated['status'] = 'pending';
        $installment = Installment::create($validated);

        return redirect()->route('admin.installment.index')
            ->with('success', 'Cicilan berhasil ditambahkan.');
    }

    /**
     * Detail cicilan (beserta riwayat pembayaran)
     */
public function show($id)
    {
        // Ambil installment beserta user, kelas user, dan semua payments
        $installment = Installment::with(['user.class', 'payments'])->findOrFail($id);

        return view('admin.installment.show', compact('installment'));
    }

    /**
     * Form edit cicilan
     */
    public function edit($id)
    {
        $installment = Installment::findOrFail($id);
        $students    = User::where('role_id', 2)->get();
        $classes     = TbClass::all();

        return view('admin.installment.edit', compact('installment', 'students', 'classes'));
    }

    /**
     * Update cicilan
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'class_id'    => 'required|exists:tb_class,id',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $installment = Installment::findOrFail($id);
        $installment->update($validated);

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil diperbarui.');
    }

    /**
     * Hapus cicilan (beserta pembayaran anak-anaknya)
     */
    public function destroy($id)
    {
        $installment = Installment::with('payments')->findOrFail($id);

        // hapus semua payments child
        foreach ($installment->payments as $payment) {
            $payment->delete();
        }

        $installment->delete();

        return redirect()->route('admin.installment.index')
            ->with('success', 'Data cicilan berhasil dihapus.');
    }

    /**
     * Tambah pembayaran ke cicilan
     */
    public function addPayment(Request $request, $id)
    {
        $installment = Installment::findOrFail($id);

        $validated = $request->validate([
            'amount'       => 'required|numeric|min:0',
            'payment_type' => 'required|string|max:255',
            'method'       => 'required|string|max:255',
            'status'       => 'required|in:pending,paid,overdue',
            'paid_at'      => 'nullable|date',
        ]);

        $validated['user_id']   = $installment->user_id;
        $validated['class_id']  = $installment->class_id;
        $validated['payment_for'] = 'register';
        $validated['payment_category'] = 'cicilan';

        if ($request->filled('paid_at')) {
            $validated['paid_at'] = date('Y-m-d H:i:s', strtotime($request->paid_at));
        }

        $installment->payments()->create($validated);

        // 🔥 update status installment otomatis
        $this->updateInstallmentStatus($installment->id);

        return redirect()->route('admin.installment.show', $installment->id)
            ->with('success', 'Pembayaran cicilan berhasil ditambahkan.');
    }

    /**
     * Update status cicilan berdasarkan payments anak-anaknya
     */
    // di InstallmentController
    public function updateInstallmentStatus($installmentId)
    {
        $installment = Installment::with('payments')->findOrFail($installmentId);

        $paidCount = $installment->payments()->where('status', 'paid')->count();
        $totalCount = $installment->payments()->count();

        if ($paidCount === 0) {
            $installment->status = 'pending';
        } elseif ($paidCount < $totalCount) {
            $installment->status = 'partial';
        } else {
            $installment->status = 'paid';
            $installment->paid_at = now();
        }

        $installment->save();
    }



    /**
     * Edit pembayaran anak cicilan
     */
    public function editPayment(Request $request, $installmentId, $paymentId)
    {
        $installment = Installment::findOrFail($installmentId);
        $payment     = $installment->payments()->findOrFail($paymentId);

        $validated = $request->validate([
            'amount'       => 'required|numeric|min:0',
            'payment_type' => 'required|string|max:255',
            'method'       => 'required|string|max:255',
            'status'       => 'required|in:pending,paid,overdue',
            'paid_at'      => 'nullable|date',
        ]);

        if ($request->filled('paid_at')) {
            $validated['paid_at'] = date('Y-m-d H:i:s', strtotime($request->paid_at));
        }

        $payment->update($validated);

        // update status cicilan
        $this->updateInstallmentStatus($installment->id);

        return redirect()->route('admin.installment.show', $installment->id)
            ->with('success', 'Pembayaran cicilan berhasil diperbarui.');
    }

    /**
     * Hapus pembayaran anak cicilan
     */
    public function deletePayment($installmentId, $paymentId)
    {
        $installment = Installment::findOrFail($installmentId);
        $payment     = $installment->payments()->findOrFail($paymentId);

        $payment->delete();

        // update status cicilan
        $this->updateInstallmentStatus($installment->id);

        return redirect()->route('admin.installment.show', $installment->id)
            ->with('success', 'Pembayaran cicilan berhasil dihapus.');
    }
}
