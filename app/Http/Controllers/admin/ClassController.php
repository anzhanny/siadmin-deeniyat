<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TbClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TbClass::paginate(20);
        return view('admin.class.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $class_name = $request->input('class_name');
        $amount = $request->input('amount');
        $teacher_name = $request->input('teacher_name');
        $academic_year_first = $request->input('academic_year_first');
        $academic_year_last = $request->input('academic_year_last');
        $status = $request->input('status');
        
        $data = new TbClass();
        $data->class_name = $class_name;   
        $data->amount = $amount;     
        $data->teacher_name = $teacher_name;
        $data->academic_year_first = $academic_year_first;
        $data->academic_year_last = $academic_year_last;
        $data->status = $status;
        $data->save();
        return redirect()->route('admin.class.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = TbClass::find($id);
        if (!$data) {
            abort(404);
        }
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
        $data = TbClass::find($id);
        if (isset($request->class_name)) $data->class_name = $request->class_name;
        if (isset($request->amount)) $data->amount = $request->amount;
        if (isset($request->teacher_name)) $data->teacher_name = $request->teacher_name;
        if (isset($request->academic_year_first)) $data->academic_year_first = $request->academic_year_first;
        if (isset($request->academic_year_last)) $data->academic_year_last = $request->academic_year_last;
        if (isset($request->status)) $data->status = $request->status;
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TbClass::find($id);
        $data->delete();
    }
}
