<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\SppInvoiceMail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::with(['payment.user'])->paginate(10);

        return view('admin.spp.index', compact('data'));
    }

        public function sendInvoice($id)
    {
        $payment = Payment::with('user.class')->findOrFail($id);

        if (!$payment->user || !$payment->user->email) {
            return back()->with('error', 'Email untuk user ini tidak ditemukan.');
        }

        Mail::to($payment->user->email)->send(new SppInvoiceMail($payment));

        return back()->with('success', 'Invoice berhasil dikirim ke ' . $payment->user->email);
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
