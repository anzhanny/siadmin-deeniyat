<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        // Pagination 5 data per halaman
        $data = User::where('role_id', 2)->paginate(10);
        return view('admin.student.index', compact('data'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:8',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan foto
        $filename = time() . '.' . $request->photo->getClientOriginalExtension();
        $path = $request->photo->storeAs('photos', $filename, 'public');

        $data = new User();
        $data->name = $request->name;
        $data->role_id = 2;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->birthplace = $request->birthplace;
        $data->birthdate = $request->birthdate;
        $data->gender = $request->gender;
        $data->nis = $request->nis;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->class_id = $request->class_id;
        $data->is_active = $request->is_active;
        $data->father_name = $request->father_name;
        $data->father_job = $request->father_job;
        $data->mother_name = $request->mother_name;
        $data->mother_job = $request->mother_job;
        $data->photo = $path; // simpan path relatif

        $data->save();

        return redirect()->route('admin.student.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $id,
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }
        $data->birthplace = $request->birthplace;
        $data->birthdate = $request->birthdate;
        $data->gender = $request->gender;
        $data->nis = $request->nis;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->class_id = $request->class_id;
        $data->is_active = $request->is_active;
        $data->father_name = $request->father_name;
        $data->father_job = $request->father_job;
        $data->mother_name = $request->mother_name;
        $data->mother_job = $request->mother_job;

        if ($request->hasFile('photo')) {
            if ($data->photo && Storage::disk('public')->exists($data->photo)) {
                Storage::disk('public')->delete($data->photo);
            }
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = $request->photo->storeAs('photos', $filename, 'public');
            $data->photo = $path;
        }

        $data->save();

        return redirect()->route('admin.student.index')->with('success', 'Data berhasil diperbarui');
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
}
