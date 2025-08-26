@extends('layouts.layout')
@section('content')
<div class="container">
    <h4>Edit Pembayaran</h4>
    <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Siswa --}}
        <div class="mb-3">
            <label for="user_id">Nama Siswa</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}" {{ $student->id == $payment->user_id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Kelas --}}
        <div class="mb-3">
            <label for="class_id">Kelas</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $class->id == $payment->class_id ? 'selected' : '' }}>
                    {{ $class->class_name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Tipe Pembayaran --}}
        <div class="mb-3">
            <label for="payment_type">Tipe Pembayaran</label>
            <input type="text" name="payment_type" class="form-control" value="{{ $payment->payment_type }}" required>
        </div>

        {{-- Jumlah --}}
        <div class="mb-3">
            <label for="amount">Jumlah</label>
            <input type="number" name="amount" class="form-control" value="{{ $payment->amount }}" required>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-3">
            <label for="method">Metode Pembayaran</label>
            <select name="method" class="form-control">
                <option value="cash" {{ $payment->method == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ $payment->method == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>

        {{-- Bulan --}}
        <div class="mb-3">
            <label for="month">Bulan</label>
            <select name="month" id="month" class="form-control" required>
                @php
                    $months = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                @endphp
                @foreach($months as $month)
                    <option value="{{ $month }}" {{ $payment->month == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status">Status Pembayaran</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Lunas</option>
                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Dibatalkan</option>

            </select>
        </div>

        {{-- Tanggal Pembayaran --}}
        <div class="mb-3">
            <label for="paid_at">Tanggal Pembayaran</label>
            <input type="date" name="paid_at" class="form-control"
                value="{{ $payment->paid_at && strtotime($payment->paid_at) ? \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d') : '' }}">
        </div>

        {{-- Tombol Simpan --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection