@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Detail Pembayaran "{{ $payment->user ? $payment->user->name : '-' }}"</h6>
      </div>
      <div class="card-body px-4 py-3">

        {{-- Tabel utama --}}
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-10">Nama Siswa</th>
              <td class="text-dark text-s opacity-10">{{ $payment->user ? $payment->user->name : '-' }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Kelas</th>
              <td class="text-dark text-s opacity-10">{{ $payment->class ? $payment->class->class_name : '-' }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Tipe Pembayaran</th>
              <td class="text-dark text-s opacity-10">{{ ucfirst($payment->payment_type) }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Kategori Pembayaran</th>
              <td class="text-dark text-s opacity-10">{{ ucfirst($payment->payment_category) }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Metode Pembayaran</th>
              <td class="text-dark text-s opacity-10">{{ ucfirst($payment->method) }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Bulan/Tahun</th>
              <td class="text-dark text-s opacity-10">{{ $payment->month ?? '-' }} {{ $payment->year ?? '-' }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Status</th>
              <td class="text-dark text-s opacity-10">
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
              <th class="text-dark text-s font-weight-bolder opacity-9">Jumlah</th>
              <td class="text-dark text-s opacity-10">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <th class="text-dark text-s font-weight-bolder opacity-9">Waktu Bayar</th>
              <td class="text-dark text-s opacity-10">
                {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y H:i') : '-' }}
              </td>
            </tr>
          </table>
        </div>

        {{-- Tambahin detail cicilan kalau kategori cicilan --}}
        @if($payment->payment_category === 'cicilan' && $payment->installments->count() > 0)
        <div class="mt-4">
          <h6>Rincian Cicilan</h6>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead class="text-white" style="background-color: #344767;">
                <tr>
                  <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-10">#</th>
                  <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-10">Cicilan Ke</th>
                  <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-10">Nominal</th>
                  <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-10">Status</th>
                  <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-10">Jatuh Tempo</th>
                  <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-10">Tanggal Bayar</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payment->installments as $i => $installment)
                <tr class="text-center">
                  <td class="text-dark text-s opacity-10">{{ $i+1 }}</td>
                  <td class="text-dark text-s opacity-10">Cicilan ke-{{ $installment->installments_to }}</td>
                  <td class="text-dark text-s opacity-10">Rp {{ number_format($installment->nominal ?? 0, 0, ',', '.') }}</td>
                  <td class="text-dark text-s opacity-10">
                    @if($installment->status === 'paid')
                    <span class="badge bg-success">Lunas</span>
                    @elseif($installment->status === 'overdue')
                    <span class="badge bg-danger">Terlambat</span>
                    @else
                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                    @endif
                  </td>
                  <td class="text-dark text-s opacity-10">{{ $installment->due_date?->format('d-m-Y') ?? '-' }}</td>
                  <td class="text-dark text-s opacity-10">{{ $installment->paid_at?->format('d-m-Y H:i') ?? '-' }}</td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif

        <div class="text-end mt-3">
          <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Kembali</a>
          <a href="{{ route('admin.payment.edit', $payment->id) }}" class="btn btn-primary">Edit</a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection