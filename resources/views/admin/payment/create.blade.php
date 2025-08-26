@extends('layouts.layout')
@section('content')
<div class="container">
    <h4>Tambah Pembayaran</h4>
    <form action="{{ route('admin.payment.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id">Nama Siswa</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="class_id">Kelas</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_type">Tipe Pembayaran</label>
            <input type="text" name="payment_type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="amount">Jumlah</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="method">Metode Pembayaran</label>
            <select name="method" class="form-control">
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

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
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>

         <div class="mb-3">
            <label for="status">Status Pembayaran</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="paid_at">Tanggal Pembayaran</label>
            <input type="date" name="paid_at" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection