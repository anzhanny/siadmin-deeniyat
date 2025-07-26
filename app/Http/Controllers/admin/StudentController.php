<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('role_id', 2)->paginate(10);
        return view('admin.student.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $role_id = $request->input('role_id');
        $email = $request->input('email');
        $password = $request->input('password');
        $birthdate = $request->input('birthdate');
        $gender = $request->input('gender');
        $nis = $request->input('nis');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $class_id = $request->input('class_id');
        $is_active = $request->input('is_active');
        $father_name = $request->input('father_name');
        $father_job = $request->input('father_job');
        $mother_name = $request->input('mother_name');
        $mother_job = $request->input('mother_job');
        $photo = $request->input('photo');
        
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = new User();
        $data->name = $name;
        $data->role_id = $role_id;
        $data->email = $email;
        $data->password = $password;
        $data->birthdate = $birthdate;
        $data->gender = $gender;
        $data->nis = $nis;
        $data->phone = $phone;
        $data->address = $address;
        $data->class_id = $class_id;
        $data->is_active = $is_active;
        $data->father_name = $father_name;
        $data->father_job = $father_job;
        $data->mother_name = $mother_name;
        $data->mother_job = $mother_job;
        $data->photo = $photo;
        
        if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('photos', 'public'); // disimpan di storage/app/public/photos
        $data->photo = $path; // simpan path-nya ke database
        }

        $data->save();
        return redirect()->route('admin.student.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::find($id);
        if (isset($request->name)) $data->name = $request->name;
        if (isset($request->role_id)) $data->role_id = $request->role_id;
        if (isset($request->email)) $data->email = $request->email;
        if (isset($request->password)) $data->password = $request->password;
        if (isset($request->birthdate)) $data->birthdate = $request->birthdate;
        if (isset($request->gender)) $data->gender = $request->gender;
        if (isset($request->nis)) $data->nis = $request->nis;
        if (isset($request->phone)) $data->phone = $request->phone;
        if (isset($request->address)) $data->address = $request->address;
        if (isset($request->class_id)) $data->class_id = $request->class_id;
        if (isset($request->is_active)) $data->is_active = $request->is_active;
        if (isset($request->father_name)) $data->father_name = $request->father_name;
        if (isset($request->father_job)) $data->father_job = $request->father_job;
        if (isset($request->mother_name)) $data->mother_name = $request->mother_name;
        if (isset($request->mother_job)) $data->mother_job = $request->mother_job;
        if (isset($request->photo)) $data->photo = $request->photo;
        
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();
    }
}
