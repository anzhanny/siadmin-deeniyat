@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Daftar Cicilan Siswa</h6>
      </div>
      <div class="card-body px-3 pt-3 pb-2">

        {{-- Filter --}}
        <form method="GET" action="{{ route('admin.installment.index') }}" class="row g-2 mb-3">
          <div class="col-md-3">
            <select name="status" class="form-select">
              <option value="">-- Semua Status --</option>
              <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
              <option value="partial" {{ request('status')=='partial'?'selected':'' }}>Partial</option>
              <option value="paid" {{ request('status')=='paid'?'selected':'' }}>Paid</option>
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">Filter</button>
          </div>
        </form>

        {{-- Tabel --}}
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Total Cicilan</th>
                <th>Sisa Hutang</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($installments as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->class->class_name ?? '-' }}</td>
                <td>Rp {{ number_format($item->nominal,0,',','.') }}</td>
                <td>Rp {{ number_format($item->remaining_balance ?? 0,0,',','.') }}</td>
                <td>
                  @if($item->status == 'paid')
                    <span class="badge bg-success">Lunas</span>
                  @elseif($item->status == 'partial')
                    <span class="badge bg-warning text-dark">Partial</span>
                  @else
                    <span class="badge bg-secondary">Pending</span>
                  @endif
                </td>
                <td>{{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('d/m/Y') : '-' }}</td>
                <td>
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                    Detail
                  </button>
                </td>
              </tr>

              {{-- Modal Detail Cicilan --}}
              <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Detail Cicilan - {{ $item->user->name }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nominal</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($item->payments as $p)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>Rp {{ number_format($p->amount,0,',','.') }}</td>
                            <td>{{ $p->due_date ? \Carbon\Carbon::parse($p->due_date)->format('d/m/Y') : '-' }}</td>
                            <td>
                              @if($p->status == 'paid')
                                <span class="badge bg-success">Paid</span>
                              @elseif($p->status == 'pending')
                                <span class="badge bg-secondary">Pending</span>
                              @elseif($p->status == 'failed')
                                <span class="badge bg-danger">Failed</span>
                              @else
                                <span class="badge bg-warning text-dark">Overdue</span>
                              @endif
                            </td>
                            <td>
                              {{-- Update status --}}
                              <form action="{{ route('admin.payment.updateStatus', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                  <option value="pending" {{ $p->status=='pending'?'selected':'' }}>Pending</option>
                                  <option value="paid" {{ $p->status=='paid'?'selected':'' }}>Paid</option>
                                  <option value="failed" {{ $p->status=='failed'?'selected':'' }}>Failed</option>
                                  <option value="overdue" {{ $p->status=='overdue'?'selected':'' }}>Overdue</option>
                                </select>
                              </form>
                              {{-- Update due date --}}
                              <form action="{{ route('admin.installment.updateDueDate', $item->id) }}" method="POST" class="mt-1">
                                @csrf
                                @method('PUT')
                                <input type="date" name="due_date" value="{{ $item->due_date }}" class="form-control form-control-sm" onchange="this.form.submit()">
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <tr>
                <td colspan="8" class="text-center">Tidak ada data cicilan</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{ $installments->withQueryString()->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
