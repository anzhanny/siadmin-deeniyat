@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6 class="mb-0">Riwayat Cicilan Pendaftaran</h6>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          @if($installments->isEmpty())
            <div class="p-4 text-center text-muted">Belum ada data cicilan.</div>
          @else
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kode Pembayaran</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Cicilan Ke</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nominal</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jatuh Tempo</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($installments as $inst)
                  @forelse($inst->payments as $i => $cicilan)
                    <tr>
                     <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                     <td class="align-middle text-center text-sm"><span class="badge bg-dark text-white">{{ $cicilan->code }}</span></td>
                     <td class="align-middle text-center text-sm">Cicilan ke-{{ $cicilan->installment_to }}</td>
                     <td class="align-middle text-center text-sm">Rp {{ number_format($cicilan->amount, 0, ',', '.') }}</td>
                     <td class="align-middle text-center text-sm">
                        @switch($cicilan->status)
                          @case('paid') 
                            <span class="badge bg-success">Lunas</span> 
                            @break
                          @case('partial') 
                            <span class="badge bg-info">Sebagian</span> 
                            @break
                          @case('pending') 
                            <span class="badge bg-warning">Menunggu</span> 
                            @break
                          @default 
                            <span class="badge bg-danger">{{ ucfirst($cicilan->status) }}</span>
                        @endswitch
                      </td>
                     <td class="align-middle text-center text-sm">{{ $cicilan->due_date?->format('d/m/Y') ?? '-' }}</td>
                     <td class="align-middle text-center text-sm">
                        @if($cicilan->status !== 'paid')
                          <button type="button" 
                            class="btn btn-sm btn-primary installment-pay-btn" 
                            data-id="{{ $cicilan->id }}">
                            Bayar
                          </button>
                        @else
                          <button class="btn btn-sm btn-secondary" disabled>Sudah Dibayar</button>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center text-muted">
                        Belum ada cicilan untuk installment ini.
                      </td>
                    </tr>
                  @endforelse
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


{{-- Script Midtrans khusus installment --}}
@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
  data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.querySelectorAll(".installment-pay-btn").forEach(btn => {
  btn.addEventListener("click", function() {
    let installmentId = this.dataset.id;
    console.log("Klik tombol installment id:", installmentId);

    fetch(`/student/installment/pay/${installmentId}`, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json",
        "Content-Type": "application/json"
      }
    })
    .then(res => res.json())
    .then(data => {
      console.log("Response dari server:", data);
      if (data.snapToken) {
        window.snap.pay(data.snapToken, {
          onSuccess: function(result) { location.reload(); },
          onPending: function(result) { location.reload(); },
          onError: function(result) { alert("Pembayaran gagal"); }
        });
      } else {
        alert(data.error || "Gagal dapat Snap Token");
      }
    })
    .catch(err => {
      console.error("Fetch error:", err);
      alert("Terjadi error saat request ke server.");
    });
  });
});
</script>
    @stack('scripts')

@endpush
