@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 ">
      <div class="card-header pb-0">
      </div>

      @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <div class="table-responsive p-0">
        <table class="table text-center align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>
              <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Bulan</th>
              <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
              <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($months as $month)
            @php
            [$bulan, $tahun] = explode('-', $month);
            $payment = $payments[$bulan.'-'.$tahun] ?? null;
            @endphp
            <tr>
              <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
              <td class="align-middle text-center text-sm">{{ $month }}</td>
              <td class="align-middle text-center text-sm">
                @if($payment)
                @if($payment->status === 'paid')
                <span class="badge bg-success">Lunas</span>
                @else
                <span class="badge bg-warning text-dark">Pending</span>
                @endif
                @else
                <span class="badge bg-secondary">Belum Dibayar</span>
                @endif
              </td>
              <td class="align-middle text-center text-sm">
                @if(!$payment || $payment->status !== 'paid')
                <button type="button" class="btn btn-primary btn-sm pay-btn" data-month="{{ $month }}" style="height: 30px; margin-bottom: 0;">
                  Bayar
                </button>
                @else
                <button class="btn btn-sm btn-secondary" style="font-style: italic; height: 30px; margin-bottom: 0;" disabled>
                  Sudah Dibayar
                </button>
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


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pay-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        let month = this.dataset.month;

        fetch(`/student/spp/pay/${month}`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.snapToken) {
              window.snap.pay(data.snapToken, {
                onSuccess: function(result) {
                  location.reload();
                },
                onPending: function(result) {
                  location.reload();
                },
                onError: function(result) {
                  alert("Pembayaran gagal");
                }
              });
            }
          });
      });
    });
  });
</script>

@endsection