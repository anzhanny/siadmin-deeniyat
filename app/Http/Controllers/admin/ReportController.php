<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Report::paginate(10);
        return view('admin.report.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = new Report();
        $data->student_id = $request->student_id;
        $data->class_id = $request->class_id;
        $data->teacher_id = $request->teacher_id;
        $data->daily_value = $request->daily_value;
        $data->monthly_exam = $request->monthly_exam;
        $data->final_exam = $request->final_exam;

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
        $data = Report::find($id);
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
        $data = Report::find($id);
        if (isset($request->student_id)) $data->student_id = $request->student_id;
        if (isset($request->class_id)) $data->class_id = $request->class_id;
        if (isset($request->teacher_id)) $data->teacher_id = $request->teacher_id;
        if (isset($request->daily_value)) $data->daily_value = $request->daily_value;
        if (isset($request->monthly_exam)) $data->monthly_exam = $request->monthly_exam;
        if (isset($request->final_exam)) $data->final_exam = $request->final_exam;
        
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Report::find($id);
        $data->delete();
    }
}
