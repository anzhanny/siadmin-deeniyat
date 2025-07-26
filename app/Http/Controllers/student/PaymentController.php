<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::paginate(10);
        return view('admin.payment.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = new Payment();
        $data->user_id = $request->user_id;
        $data->class_id = $request->class_id;
        $data->payment_type = $request->payment_type;
        $data->amount = $request->amount;
        $data->method = $request->method;
        $data->month = $request->month;
        $data->paid_at = $request->paid_at;
        $data->reference_number = $request->reference_number;
        $data->status = $request->status;
        $data->description = $request->description;
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
       $data = Payment::find($id);
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
       $data = Payment::find($id);
       if (isset($request->user_id)) $data->user_id = $request->user_id;
       if (isset($request->class_id)) $data->class_id = $request->class_id;
       if (isset($request->payment_type)) $data->payment_type = $request->payment_type;
       if (isset($request->amount)) $data->amount = $request->amount;
       if (isset($request->method)) $data->method = $request->method;
       if (isset($request->month)) $data->month = $request->month;
       if (isset($request->paid_at)) $data->paid_at = $request->paid_at;
       if (isset($request->reference_number)) $data->reference_number = $request->reference_number;
       if (isset($request->status)) $data->status = $request->status;
       if (isset($request->description)) $data->description = $request->description;
       $data->save();
       return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Payment::find($id);
        $data->delete();
    }
}
