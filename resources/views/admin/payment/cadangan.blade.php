@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h6>Data Pembayaran</h6>
        <a href="{{ route('admin.payment.create') }}" class="btn btn-primary btn-sm">Tambah Pembayaran</a>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Jenis Pembayaran</th>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($payments as $key => $payment)
              <tr>
                {{-- nomor urut --}}
                <td class="text-center">{{ $payments->firstItem() + $key }}</td>

                {{-- nama siswa --}}
                <td>{{ $payment->user->name ?? '-' }}</td>

                {{-- kelas --}}
                <td>{{ $payment->class->class_name ?? '-' }}</td>

                {{-- jenis pembayaran --}}
                <td>{{ strtoupper($payment->payment_for ?? '-') }}</td>

                {{-- kategori --}}
                <td>{{ ucfirst($payment->payment_category) }}</td>

                {{-- nominal --}}
                <td>Rp {{ number_format($payment->nominal ?? 0, 0, ',', '.') }}</td>

                {{-- status --}}
                <td>
                  @if($payment->status === 'paid')
                    <span class="badge bg-success">Lunas</span>
                  @elseif($payment->status === 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                  @elseif($payment->status === 'unpaid')
                    <span class="badge bg-danger">Belum Bayar</span>
                  @else
                    <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                  @endif
                </td>

                {{-- aksi --}}
                <td class="text-center">
                  <a href="{{ route('admin.payment.show', $payment->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
              </tr>

              {{-- jika kategori cicilan, tampilkan breakdown cicilan --}}
              @if($payment->payment_category === 'cicilan' && $payment->installments->count())
              <tr>
                <td colspan="8" class="p-0">
                  <div class="table-responsive">
                    <table class="table table-sm mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th class="text-center" style="width: 5%">#</th>
                          <th style="width: 20%">Cicilan Ke</th>
                          <th style="width: 20%">Nominal</th>
                          <th style="width: 20%">Jatuh Tempo</th>
                          <th style="width: 15%">Status</th>
                          <th class="text-center" style="width: 20%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($payment->installments as $iKey => $item)
                        <tr>
                          <td class="text-center">{{ $iKey + 1 }}</td>
                          <td>Cicilan {{ $item->installments_to ?? '-' }}</td>
                          <td>Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}</td>
                          <td>
                            {{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('d/m/Y') : '-' }}
                          </td>
                          <td>
                            @if($item->status === 'paid')
                              <span class="badge bg-success">Lunas</span>
                            @elseif($item->status === 'partial' || $item->status === 'pending')
                              <span class="badge bg-warning text-dark">Partial</span>
                            @elseif($item->status === 'unpaid')
                              <span class="badge bg-danger">Belum Bayar</span>
                            @else
                              <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                          </td>
                          <td class="text-center">
                            {{-- Ubah Status --}}
                            <form action="{{ route('admin.installment.updateStatus', $item->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <div class="dropdown d-inline">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                  Ubah Status
                                </button>
                                <ul class="dropdown-menu">
                                  <li><button type="submit" name="status" value="pending" class="dropdown-item">Set Pending</button></li>
                                  <li><button type="submit" name="status" value="paid" class="dropdown-item">Set Paid</button></li>
                                  <li><button type="submit" name="status" value="failed" class="dropdown-item text-danger">Set Failed</button></li>
                                </ul>
                              </div>
                            </form>

                            {{-- Ubah Jatuh Tempo (modal) --}}
                            <button 
                              type="button" 
                              class="btn btn-sm btn-primary"
                              data-bs-toggle="modal" 
                              data-bs-target="#dueDateModal"
                              data-id="{{ $item->id }}"
                              data-date="{{ $item->due_date }}"
                              data-code="Cicilan {{ $item->installments_to }}">
                              <i class="fa fa-calendar"></i>
                            </button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
              @endif
              @empty
              <tr>
                <td colspan="8" class="text-center">Belum ada data pembayaran</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3 px-3">
          {{ $payments->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal: Ubah Jatuh Tempo --}}
<div class="modal fade" id="dueDateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="dueDateForm" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Jatuh Tempo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label class="form-label">Cicilan</label>
            <input type="text" id="modalCode" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" id="modalDueDate" name="due_date" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('dueDateModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const date = button.getAttribute('data-date');
    const code = button.getAttribute('data-code');

    document.getElementById('modalCode').value = code;
    document.getElementById('modalDueDate').value = date ?? '';

    document.getElementById('dueDateForm').action = `/admin/installments/${id}/due-date`;
  });
});
</script>
@endpush
