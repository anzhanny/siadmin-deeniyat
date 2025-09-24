@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Riwayat Pembayaran SPP</h6>
        <span class="badge bg-gradient-info p-2">
          Total Pembayaran Tahun Ini: Rp {{ number_format($total_pembayaran, 0, ',', '.') }}
        </span>
      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table class="table text-center align-items-center mb-0"> 
        <thead>
          <tr>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Bulan</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Jumlah</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Metode Bayar</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Status</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Tanggal Bayar</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($pembayaran as $item)
          <tr>
            <td class="align-middle text-center text-sm">{{ $item->month }}</td>
            <td class="align-middle text-center text-sm">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
            <td class="align-middle text-center text-sm">
              {{ $item->payment_type == 'full' ? 'Lunas' : 'Cicilan ' . $item->installment_no . '/' . $item->installment_total }}
            </td>
            <td class="align-middle text-center text-sm">
              @if($item->status == 'paid')
                <span class="badge badge-sm bg-gradient-success">Lunas</span>
              @elseif($item->status == 'pending')
                <span class="badge badge-sm bg-gradient-warning">Menunggu Pembayaran</span>
              @else
                <span class="badge badge-sm bg-gradient-danger">Gagal</span>
              @endif
            </td>
            <td class="align-middle text-center text-sm">
              {{ $item->paid_at ? $item->paid_at->format('d-m-Y') : '-' }}
            </td>
            <td class="align-middle text-center text-sm">
              @if($item->status != 'paid')
                <form action="{{ route('pembayaran.bayar', $item->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary btn-sm">Bayar Sekarang</button>
                </form>
              @else
                <a href="{{ asset('bukti_pembayaran/'.$item->bukti) }}" target="_blank" class="btn btn-success btn-sm">Lihat Bukti</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
