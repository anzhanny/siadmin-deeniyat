<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::paginate(10);
        return view('admin.student.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = new Student();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
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
        $data->photo = $request->photo;
        $data->save();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Student::find($id);
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
        $data = Student::find($id);
        if (isset($request->name)) $data->name = $request->name;
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
        $data = Student::find($id);
        $data->delete();
    }
}
