@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <form action="{{ route('admin.payment.store') }}" method="POST" id="classForm" class="p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Masukkan Nama Siswa" required>
        </div>

        <div class="mb-3">
        <label for="payment_type" class="form-label">Jenis Pembayaran</label>
        <select class="form-select" id="payment_type" name="payment_type" required>
            <option value="" disabled selected>Pilih Jenis Pembayaran</option>
            <option value="pendaftaran">Bayar Pendaftaran</option>
            <option value="spp">Bayar SPP</option>
]        </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Pembayaran</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah Pembayaran" required>
        </div>

        <div class="mb-3">
        <label for="method" class="form-label">Metode Pembayaran</label>
        <select class="form-select" id="method" name="method" required>
            <option value="" disabled selected>Pilih Metode Pembayaran</option>
            <option value="CASH">CASH</option>
            <option value="QRIS">QRIS</option>
            <option value="QRIS">Cicilan</option>
        </select>
        </div>

        <div class="mb-3">
            <label for="month" class="form-label">Bulan Pembayaran</label>
            <select class="form-select" id="month" name="month" required>
            <option value="" disabled selected>Pilih Bulan</option>
            <option value="Januari">Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>
        </select>
        </div>

        <div class="mb-3">
            <label for="paid_at" class="form-label">Tanggal Pembayaran</label>
            <input type="date" class="form-control" id="paid_at" name="paid_at" placeholder="Masukkan Tanggal Pembayaran" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi" required></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>
@endsection
