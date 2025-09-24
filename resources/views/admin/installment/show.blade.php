@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Detail Cicilan Siswa</h6>
        <p class="text-sm mb-0">
          <strong>Nama:</strong> {{ $user->name }} <br>
          <strong>Kelas:</strong> {{ $user->class->name ?? '-' }} <br>
          <strong>NIS:</strong> {{ $user->nis ?? '-' }}
        </p>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        @forelse($user->payments as $payment)
          <div class="mb-4 px-3">
            <h6 class="text-dark">Kode Pembayaran: {{ $payment->code }} ({{ ucfirst($payment->payment_category) }})</h6>
          </div>

          <div class="table-responsive p-0">
            <table class="table text-center align-items-center mb-4">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cicilan Ke</th>
                  <th>Nominal</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
                  <th>Tanggal Bayar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($payment->installments as $i => $installment)
                  <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $installment->installments_to }}</td>
                    <td>Rp {{ number_format($installment->nominal, 0, ',', '.') }}</td>
                    <td>{{ $installment->due_date?->format('d-m-Y') ?? '-' }}</td>
                    <td>
                      @if ($installment->paid_at)
                        <span class="badge bg-success">Lunas</span>
                      @else
                        <span class="badge bg-warning text-dark">Belum Bayar</span>
                      @endif
                    </td>
                    <td>{{ $installment->paid_at?->format('d-m-Y') ?? '-' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @empty
          <div class="alert alert-secondary text-center mx-3">
            Belum ada data cicilan untuk siswa ini.
          </div>
        @endforelse
      </div>
    </div>

  </div>
</div>
@endsection
