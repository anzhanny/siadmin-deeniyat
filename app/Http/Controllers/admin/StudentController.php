<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\TbClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psy\VersionUpdater\Installer;

class StudentController extends Controller
{
    public function index()
    {
        $data = User::with('class')->where('role_id', 2)->paginate(20);
        return view('admin.student.index', compact('data'));
    }

    public function create()
    {
        $data = TbClass::all(); // ambil semua kelas
        return view('admin.student.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'class_id' => 'nullable|integer',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_category' => 'required|in:lunas,cicilan',
            'payment_type'     => 'required|in:tunai,non-tunai',
            'birthplace'       => 'required|string|max:255',
            'birthdate'        => 'required|date',
            'gender'           => 'required|in:Laki-laki,Perempuan',
            'phone'            => 'required|string|max:15',
        ]);

        // Upload foto
        $path = null;
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = $request->photo->storeAs('photos', $filename, 'public');
        }

        // Simpan data siswa
        $student = User::create([
            'role_id'     => 2,
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'class_id'    => $request->class_id,
            'birthplace'  => $request->birthplace,
            'birthdate'   => $request->birthdate,
            'gender'      => $request->gender,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'father_name' => $request->father_name,
            'father_job'  => $request->father_job,
            'mother_name' => $request->mother_name,
            'mother_job'  => $request->mother_job,
            'photo'       => $path,
            'is_active'   => $request->is_active ?? 1,
        ]);

        // Auto-assign kelas
        $assignedClass = TbClass::assignStudentToClass($request->grade, $student->id);
        if ($assignedClass) {
            $student->class_id = $assignedClass->id;
            $student->save();
        }

        // --- Buat Installment sebagai parent ---
        $total = 450000; // bisa disesuaikan dengan kelas
        $installment = Installment::create([
            'user_id'           => $student->id,
            'class_id'          => $student->class_id,
            'nominal'           => $total,
            'remaining_balance' => $total,
            'status'            => $request->payment_category === 'lunas' ? 'paid' : 'pending',
            'due_date'          => now()->addMonth(), // contoh
        ]);

        // --- Buat Payment sebagai child ---
        if ($request->payment_category === 'lunas') {
            Payment::create([
                'installment_id'   => $installment->id,
                'user_id'          => $student->id,
                'class_id'         => $student->class_id,
                'payment_for'      => 'register',              // ✅ fixed "register"
                'payment_type'     => $request->payment_type,  // ✅ dari request
                'payment_category' => 'lunas',
                'amount'           => $total,
                'status'           => 'paid',
                'paid_at'          => now(),
                'code'             => 'REG-' . strtoupper(Str::random(10)),
            ]);

            $installment->update(['remaining_balance' => 0]);
        } else {
            // cicilan (misal 3x angsuran)
            $perInstall = $total / 3;
            for ($i = 1; $i <= 3; $i++) {
                Payment::create([
                    'installment_id'   => $installment->id,
                    'user_id'          => $student->id,
                    'class_id'         => $student->class_id,
                    'payment_for'      => 'register',              // ✅ fixed "register"
                    'payment_type'     => $request->payment_type,  // ✅ dari request
                    'payment_category' => 'cicilan',
                    'amount'           => $perInstall,
                    'status'           => 'pending',
                    'paid_at'          => null,
                    'code'             => 'REG-' . strtoupper(Str::random(10)),
                ]);
            }
        }

        return redirect()->route('admin.student.index')->with('success', 'Data siswa berhasil disimpan.');
    }



    public function show(string $id)
    {
        $student = User::with('class')->findOrFail($id);
        return view('admin.student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        $student->grade = (int) filter_var($student->class->class_name ?? 0, FILTER_SANITIZE_NUMBER_INT);

        // ambil semua kelas
        $data = TbClass::all();
        return view('admin.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $id,
            'batch'  => 'nullable|numeric',
            'photo'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data->fill([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'birthplace'  => $request->birthplace,
            'birthdate'   => $request->birthdate,
            'gender'      => $request->gender,
            'father_name' => $request->father_name,
            'father_job'  => $request->father_job,
            'mother_name' => $request->mother_name,
            'mother_job'  => $request->mother_job,
            'is_active'   => $request->is_active,
        ]);

        // isi field selain password & photo
        $data->fill($request->except(['password', 'photo']));

        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($data->photo && Storage::disk('public')->exists($data->photo)) {
                Storage::disk('public')->delete($data->photo);
            }
            $data->photo = $request->photo->storeAs(
                'photos',
                time() . '.' . $request->photo->getClientOriginalExtension(),
                'public'
            );
        }

        $data->save();

        return redirect()->route('admin.student.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }



    public function destroy($id)
    {
        $student = User::findOrFail($id);

        // hapus installment & payment
        foreach ($student->installments as $installment) {
            $installment->payments()->delete();
            $installment->delete();
        }

        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->delete();

        return redirect()->route('admin.student.index')->with('success', 'Data siswa berhasil dihapus');
    }


    private function getClassName($classId)
    {
        $classNames = [
            0 => 'Kelas TK',
            1 => 'Kelas 1',
            2 => 'Kelas 2',
            3 => 'Kelas 3',
            4 => 'Kelas 4',
            5 => 'Kelas 5',
            6 => 'Kelas 6',
        ];

        return $classNames[$classId] ?? 'Kelas Tidak Diketahui';
    }

    public function fixPayments($id)
    {
        $student = User::findOrFail($id);

        // cek apakah sudah punya installment atau payment
        $hasInstallment = Installment::where('user_id', $student->id)->exists();
        $hasPayment     = Payment::where('user_id', $student->id)->exists();

        if ($hasInstallment || $hasPayment) {
            return back()->with('info', 'Siswa ini sudah memiliki data pembayaran / cicilan.');
        }

        // ambil nominal dari kelas kalau tersedia, kalau tidak pakai default
        $class = TbClass::find($student->class_id);
        // ganti 'register_fee' sesuai nama kolom di tb_class, kalau tidak ada gunakan default
        $amount = $class?->register_fee ?? $class?->fee ?? 450000;

        DB::beginTransaction();
        try {
            // Buat parent installment (total kewajiban)
            $installment = Installment::create([
                'user_id'          => $student->id,
                'nominal'          => $amount,
                'remaining_balance' => $amount,
                'due_date'         => Carbon::now()->addMonth(), // default jatuh tempo global
                'status'           => 'pending',
            ]);

            // Pecah jadi 3 payment (anak). Ubahan: sesuaikan jumlah cicilan kalau mau
            $totalCicilan = 3;
            // bagi rata, sisakan sisa ke cicilan pertama
            $per = intdiv($amount, $totalCicilan);
            $remainder = $amount - ($per * $totalCicilan);

            for ($i = 1; $i <= $totalCicilan; $i++) {
                $amt = $per + ($i === 1 ? $remainder : 0);

                Payment::create([
                    'installment_id'   => $installment->id,
                    'user_id'          => $student->id,
                    'class_id'         => $student->class_id,
                    'payment_for'      => 'register',
                    'payment_category' => 'cicilan',
                    'payment_type'     => 'tunai', // default, admin bisa edit setelahnya
                    'code'             => 'CIC-' . Str::upper(Str::random(6)),
                    'amount'           => $amt,
                    'status'           => 'pending',
                    'due_date'         => Carbon::now()->addMonths($i - 1)->startOfMonth(), // per cicilan
                    'created_at'       => Carbon::now(),
                    'updated_at'       => Carbon::now(),
                ]);
            }

            DB::commit();
            return back()->with('success', "Berhasil membuat installment + {$totalCicilan} payment untuk siswa {$student->name}.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("fixPayments error for user {$student->id}: " . $e->getMessage());
            return back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }
}
