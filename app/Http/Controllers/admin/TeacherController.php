<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Teacher::paginate(10);
        return view('admin.teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = new Teacher();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->nip = $request->nip;
        $data->birthdate = $request->birthdate;
        $data->phone = $request->phone;
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
        $data = Teacher::find($id);
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
        $data = Teacher::find($id);
        if (isset($request->name)) $data->name = $request->name;
        if (isset($request->email)) $data->email = $request->email;
        if (isset($request->nip)) $data->nip = $request->nip;
        if (isset($request->birthdate)) $data->birthdate = $request->birthdate;
        if (isset($request->phone)) $data->phone = $request->phone;        
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Teacher::find($id);
        $data->delete();
    }
}
