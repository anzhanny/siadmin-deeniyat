@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Detail Pembayaran</h6>
      </div>
      <div class="card-body px-4 py-3">

        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>Nama Siswa</th>
              <td>{{ $payment->user ? $payment->user->name : '-' }}</td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td>{{ $payment->class ? $payment->class->class_name : '-' }}</td>
            </tr>
            <tr>
              <th>Tipe Pembayaran</th>
              <td>{{ ucfirst($payment->payment_type) }}</td>
            </tr>
            <tr>
              <th>Kategori Pembayaran</th>
              <td>{{ ucfirst($payment->payment_category) }}</td>
            </tr>
            <tr>
              <th>Metode Pembayaran</th>
              <td>{{ ucfirst($payment->method) }}</td>
            </tr>
            <tr>
              <th>Bulan</th>
              <td>{{ $payment->month ?? '-' }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                @if($payment->status == 'paid')
                  <span class="badge bg-success">Lunas</span>
                @elseif($payment->status == 'pending')
                  <span class="badge bg-warning text-dark">Menunggu</span>
                @else
                  <span class="badge bg-danger">Dibatalkan</span>
                @endif
              </td>
            </tr>
            <tr>
              <th>Jumlah</th>
              <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <th>Waktu Bayar</th>
              <td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y H:i') : '-' }}</td>
            </tr>
          </table>
        </div>

        <div class="mt-3">
          <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Kembali</a>
          <a href="{{ route('admin.payment.edit', $payment->id) }}" class="btn btn-primary">Edit</a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
