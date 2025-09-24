<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\TbClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psy\VersionUpdater\Installer;

class StudentController extends Controller
{
    public function index()
    {
        $data = User::with('class')->where('role_id', 2)->paginate(10);
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
            'email'    => 'nullable|email|unique:users',
            'password' => 'required|min:8',
            'class_id' => 'nullable|integer',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_category' => 'required|in:lunas,cicilan',
            'payment_type'     => 'required|in:tunai,non-tunai',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = $request->photo->storeAs('photos', $filename, 'public');
        }

        // $data = new User();
        // $data->role_id = 2; // student
        // $data->name = $request->name;
        // $data->email = $request->email;
        // $data->password = bcrypt($request->password);
        // $data->class_id = $request->class_id;
        // $data->birthplace = $request->birthplace;
        // $data->birthdate = $request->birthdate;
        // $data->gender = $request->gender;
        // $data->phone = $request->phone;
        // $data->address = $request->address;
        // $data->father_name = $request->father_name;
        // $data->father_job = $request->father_job;
        // $data->mother_name = $request->mother_name;
        // $data->mother_job = $request->mother_job;
        // $data->photo = $path;
        // $data->is_active = $request->is_active ?? 1;

        // Simpan user, NIS, academic_year, batch akan otomatis dari model
        // $data->save();

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



        // Auto-assign kelas (cek kuota, bikin kelas baru jika penuh)
        $assignedClass = TbClass::assignStudentToClass($request->grade, $student->id);
        if ($assignedClass) {
    $student->class_id = $assignedClass->id;
    $student->save();
}

        // --- Buat Payment register ---
        $payment = Payment::create([
            'user_id'          => $student->id,
            'class_id'         => $student->class_id,
            'payment_for'      => 'register',
            'payment_category' => $request->payment_category, // lunas / cicilan
            'payment_type'     => $request->payment_type,     // tunai / non-tunai
            'amount'           => 450000, // bisa diambil dari tabel kelas kalau variatif
            'status'           => 'pending',
            'code'             => 'REG-' . strtoupper(Str::random(10)),
        ]);

        // --- Kalau cicilan, generate installments ---
        if ($request->payment_category === 'cicilan') {
            $total      = 450000;
            $perInstall = 150000;

            for ($i = 1; $i <= 3; $i++) {
                $dueDate = match ($i) {
                    1 => now(),
                    2 => now()->addMonthNoOverflow()->startOfMonth(),
                    3 => now()->addMonthsNoOverflow(2)->startOfMonth(),
                };

                Installment::create([
                    'payment_id'      => $payment->id,
                    'installments_to' => $i,
                    'nominal'         => $perInstall,
                    'status'          => 'pending',
                    'paid_at'         => null,
                    'due_date'        => $dueDate,
                ]);
            }

            $payment->update([
                'remaining_balance' => $total,
            ]);
        }

        return redirect()->route('admin.student.index')
            ->with('success', 'Siswa berhasil ditambahkan beserta pembayaran.');
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

        // Balik ke index, bawa flash message sukses
        return redirect()->route('admin.student.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }


    public function destroy($id)
    {
        $student = User::findOrFail($id);

        // hapus payment & cicilan dulu
        foreach ($student->payments as $payment) {
            $payment->installments()->delete();
            $payment->delete();
        }

        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }
        $student->delete();
        return redirect()->route('admin.student.index')->with('success', 'Data berhasil dihapus');
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
}
