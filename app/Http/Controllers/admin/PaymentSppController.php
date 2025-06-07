<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSpp;
use Illuminate\Http\Request;

class PaymentSppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PaymentSpp::paginate(10);
        return view('admin.paymentspp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = new PaymentSpp();
        $data->student_id = $request->student_id;
        $data->class_id = $request->class_id;
        $data->month = $request->month;
        $data->payment_status = $request->payment_status;
        $data->paid_at = $request->paid_at;
        $data->upload_transactions = $request->upload_transactions;
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
        $data = PaymentSpp::find($id);
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
        $data = PaymentSpp::find($id);
        if (isset($request->student_id)) $data->student_id = $request->student_id;
        if (isset($request->class_id)) $data->class_id = $request->class_id;
        if (isset($request->month)) $data->month = $request->month;
        if (isset($request->payment_status)) $data->payment_status = $request->payment_status;
        if (isset($request->paid_at)) $data->paid_at = $request->paid_at;
        if (isset($request->upload_transactions)) $data->upload_transactions = $request->upload_transactions;
        
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PaymentSpp::find($id);
        $data->delete();
    }
}
