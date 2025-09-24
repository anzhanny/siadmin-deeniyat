@extends('layouts.layout')
@section('content')

<div class="row mb-2" style="padding-left: 30px;">
  <div class="col-6">

    <h4 class="mb-1 text-white">Halo, {{ Auth::user()->name }}</h4>
    <p class="text-sm text-white mb-0">
      {{ Auth::user()->class->class_name ?? '-' }}
    </p>

  </div>
</div>

<div class="row" style="margin-bottom: 220px; padding-left: 30px;">
  <!-- Status SPP Bulan Ini -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <a href="{{ route('student.payment.spp') }}" class="text-decoration-none">
      <div class="card shadow-lg border-0">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Status SPP</p>
                <span class="text-xs text-secondary">
                  {{ $lastSpp?->month ?? '-' }} {{ $lastSpp?->year ?? date('Y') }}
                </span>
                <h5 class="font-weight-bolder mt-2 {{ $lastSpp?->status == 'paid' ? 'text-success' : 'text-warning' }}">
                  {{ ucfirst($lastSpp?->status ?? 'Belum Bayar') }}
                </h5>

              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- Total Tunggakan -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <a href="{{ route('student.payment.installment') }}" class="text-decoration-none">
      <div class="card shadow-lg border-0">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tunggakan</p>
                <span class="text-xs text-secondary">
                  @if($overdueCount > 0)
                  Ada {{ $overdueCount }} cicilan belum dibayar
                  @else
                  Tidak ada tunggakan 🎉
                  @endif
                </span>
                <h5 class="font-weight-bolder mt-2 {{ $overdueCount > 0 ? 'text-danger' : 'text-success' }}">
                  {{ $overdueCount }}
                </h5>

              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- Riwayat Pembayaran Terakhir -->
  <div class="col-12 col-md-6 col-lg-5 mb-4">
    <a href="{{ route('student.payment.history') }}" class="text-decoration-none">
      <div class="card shadow-lg border-0 h-100">
        <div class="card-body p-3">
          <div class="row align-items-center">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Riwayat Pembayaran Terakhir</p>
                <span class="text-xs text-secondary">
                  @if($lastHistory)
                  @if($lastHistory instanceof \App\Models\Payment)
                  Bayar {{ ucfirst($lastHistory->payment_for) }}
                  ({{ $lastHistory->paid_at?->format('d-m-Y') ?? $lastHistory->created_at->format('d-m-Y') }})
                  @elseif($lastHistory instanceof \App\Models\Installment)
                  Bayar Cicilan {{ $lastHistory->installments_to }} Pendaftaran
                  ({{ $lastHistory->paid_at?->format('d-m-Y') ?? $lastHistory->created_at->format('d-m-Y') }})
                  @endif
                  @else
                  Belum Ada
                  @endif
                </span>

                <h5 class="font-weight-bolder mt-2">
                  Rp
                  @if($lastHistory instanceof \App\Models\Payment)
                  {{ number_format($lastHistory->amount, 0, ',', '.') }}
                  @elseif($lastHistory instanceof \App\Models\Installment)
                  {{ number_format($lastHistory->nominal, 0, ',', '.') }}
                  @else
                  0
                  @endif
                </h5>

              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

</div>

@endsection