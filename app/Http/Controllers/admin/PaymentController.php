<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
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
        $data = Student::all();
        return view('admin.payment.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student_id = $request->input('student_id');
        $class_id = $request->input('class_id');
        $payment_type = $request->input('payment_type');
        $amount = $request->input('amount');
        $method = $request->input('method');
        $month = $request->input('month');
        $paid_at = $request->input('paid_at');
        $reference_number = $request->input('reference_number');
        $status = $request->input('status');
        $description = $request->input('description');

        $data = new Payment();
        $data->student_id = $student_id;
        $data->class_id = $class_id;
        $data->payment_type = $payment_type;
        $data->amount = $amount;
        $data->method = $method;
        $data->month = $month;
        $data->paid_at = $paid_at;
        $data->reference_number = $reference_number;
        $data->status = $status;
        $data->description = $description;
        $data->save();
        return redirect()->route('admin.payment.index');

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
       if (isset($request->student_id)) $data->student_id = $request->student_id;
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
