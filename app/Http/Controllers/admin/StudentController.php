<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TbClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = $request->photo->storeAs('photos', $filename, 'public');
        }

        $data = new User();
        $data->role_id = 2; // student
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->class_id = $request->class_id;
        $data->birthplace = $request->birthplace;
        $data->birthdate = $request->birthdate;
        $data->gender = $request->gender;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->father_name = $request->father_name;
        $data->father_job = $request->father_job;
        $data->mother_name = $request->mother_name;
        $data->mother_job = $request->mother_job;
        $data->photo = $path;
        $data->is_active = $request->is_active ?? 1;

        // Simpan user, NIS, academic_year, batch akan otomatis dari model
        $data->save();

        // Auto-assign kelas (cek kuota, bikin kelas baru jika penuh)
        $assignedClass = TbClass::assignStudentToClass($request->grade, $data->id);


        return redirect()->route('admin.student.index')->with('success', 'Data berhasil disimpan');
    }

    public function show(string $id)
    {
        $student = User::with('class')->findOrFail($id);
        return view('admin.student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        $student->grade = (int) filter_var($student->class->class_name, FILTER_SANITIZE_NUMBER_INT);

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
