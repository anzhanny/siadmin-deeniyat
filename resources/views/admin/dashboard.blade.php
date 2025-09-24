@extends('layouts.layout')
@section('content')
<!-- ROW: Statistik Atas -->
<div class="row">

  <!-- Total Siswa -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Siswa</p>
              <h5 class="font-weight-bolder mt-2">{{ $studentCount }}</h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
              <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Guru -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Guru</p>
              <h5 class="font-weight-bolder mt-2">{{ $teacherCount }}</h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Jumlah Kelas -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Kelas</p>
              <h5 class="font-weight-bolder mt-2">{{ $classCount }}</h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-building text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Uang Masuk</p>
              <h5 class="font-weight-bolder mt-2">
                Rp {{ number_format($totalUangMasuk, 0, ',', '.') }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ROW: Grafik dan Statistik Tambahan -->
<div class="row mt-5">
  <!-- KIRI: Grafik Pembayaran -->
  <div class="col-lg-7 mb-lg-0 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0 p-3">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">Pembayaran Masuk</h6>
          </div>
          <div class="col-6 text-end">
            <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
          </div>
        </div>
      </div>
      <div class="card-body p-3 pb-0">
        <ul class="list-group">
          @forelse($latestPayments as $pay)
          <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
            <div class="d-flex flex-column">
              <h6 class="mb-1 text-dark font-weight-bold text-sm">
                {{ $pay->paid_at?->format('d M, Y') ?? $pay->created_at->format('d M, Y') }}
              </h6>
              <span class="text-xs">
                {{ ucfirst($pay->payment_for) }} - {{ $pay->user->name }}
              </span>
            </div>
            <div class="d-flex align-items-center text-sm">
              Rp {{ number_format($pay->amount, 0, ',', '.') }}
            </div>
          </li>
          @empty
          <li class="list-group-item border-0 text-center text-muted">Belum ada pembayaran</li>
          @endforelse
        </ul>

      </div>
    </div>
  </div>


  <!-- KANAN: 3 Card Vertikal -->
  <div class="col-lg-5">
    <!-- CARD 1: Siswa Belum Bayar -->
    <div class="card mb-3">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <p class="text-sm text-uppercase font-weight-bold mb-1">Siswa Belum Lunas Pendaftaran</p>
            <h5 class="font-weight-bolder">{{ $registerBelumLunas }} / {{ $studentCount }} Siswa</h5>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-folder-17 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CARD 2: Raport Diinput -->
    <div class="card mb-3">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <p class="text-sm text-uppercase font-weight-bold mb-1">Siswa Belum Lunas SPP</p>
            <span class="text-xs text-secondary">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</span>
            <h5 class="font-weight-bolder">{{ $sppBelumLunas }} / {{ $studentCount }} Siswa</h5>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
              <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>




@endsection