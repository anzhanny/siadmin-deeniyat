<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Payment::with(['user.class', 'installments']);

    // filter order_id
    if ($request->filled('order_id')) {
        $query->where('code', 'like', '%' . $request->order_id . '%');
    }

    // filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // filter date range
    if ($request->filled('date_range')) {
        [$start, $end] = explode(' - ', $request->date_range);
        $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
    }

    $data = $query->latest()->paginate(15)->appends($request->all());

    return view('admin.report.index', compact('data'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
