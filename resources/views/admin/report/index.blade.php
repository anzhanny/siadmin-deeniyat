@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Laporan Pembayaran</h6>
      </div>

      <div class="card-body">
        {{-- Filter Form --}}
        <form method="GET" action="{{ route('admin.report.payment') }}" class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label">Jenis Pembayaran</label>
            <select name="payment_for" class="form-select">
              <option value="">-- Semua --</option>
              <option value="register" {{ request('payment_for')=='register'?'selected':'' }}>Register</option>
              <option value="spp" {{ request('payment_for')=='spp'?'selected':'' }}>SPP</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="">-- Semua --</option>
              <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
              <option value="paid" {{ request('status')=='paid'?'selected':'' }}>Paid</option>
              <option value="failed" {{ request('status')=='failed'?'selected':'' }}>Failed</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Tanggal Dari</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
          </div>

          <div class="col-md-3">
            <label class="form-label">Sampai</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
          </div>

          <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('admin.report.payment') }}" class="btn btn-secondary">Reset</a>
          </div>
        </form>

        {{-- Export Buttons --}}
        <div class="mb-3">
          <a href="{{ route('admin.report.export', array_merge(request()->all(), ['format'=>'excel'])) }}" class="btn btn-success btn-sm me-2">Export Excel</a>
          <a href="{{ route('admin.report.export', array_merge(request()->all(), ['format'=>'pdf'])) }}" class="btn btn-danger btn-sm">Export PDF</a>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal Bayar</th>
              </tr>
            </thead>
            <tbody>
              @forelse($payments as $key => $item)
              <tr>
                <td class="text-center">{{ $payments->firstItem() + $key }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->class->class_name ?? '-' }}</td>
                <td>{{ strtoupper($item->payment_for) }}</td>
                <td>{{ ucfirst($item->payment_category) }}</td>
                <td>Rp {{ number_format($item->amount ?? 0,0,',','.') }}</td>
                <td>{{ ucfirst($item->method ?? '-') }}</td>
                <td>
                  @if($item->status == 'paid')
                    <span class="badge bg-success">Paid</span>
                  @elseif($item->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                  @else
                    <span class="badge bg-danger">Failed</span>
                  @endif
                </td>
                <td>{{ $item->paid_at ? \Carbon\Carbon::parse($item->paid_at)->format('d/m/Y') : '-' }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="9" class="text-center">Tidak ada data pembayaran</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          {{ $payments->withQueryString()->links() }}
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
