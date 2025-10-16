@extends('layouts.layout')
@section('content')
<!-- ROW: Statistik Atas -->
<div class="row">

  <!-- Total Siswa -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <a href="{{ route('admin.student.index') }}" class="text-decoration-none">
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
    </a>
  </div>

  <!-- Total Guru -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <a href="{{ route('admin.class.index') }}" class="text-decoration-none">

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
    </a>
  </div>



  <!-- Jumlah Kelas -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <a href="{{ route('admin.class.index') }}" class="text-decoration-none">
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
    </a>
  </div>

  @php
    use Carbon\Carbon;
    Carbon::setLocale('id'); // supaya nama bulan Indonesia
    $bulanSekarang = Carbon::now()->translatedFormat('F Y');
@endphp

<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <a href="{{ route('admin.payment.index') }}" class="text-decoration-none">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Uang Masuk</p>
              <h5 class="font-weight-bolder mt-2">
                Rp {{ number_format($totalUangMasuk, 0, ',', '.') }}
              </h5>
              <p class="text-xs text-muted mb-0">
                Periode: {{ $bulanSekarang }}
              </p>
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
  </a>
</div>
</div>

<!-- ROW: Grafik dan Statistik Tambahan -->
<div class="row mt-5 pb-4">
  <!-- <div class="col-lg-7 mb-lg-0 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0 p-3">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">Pembayaran Masuk</h6>
          </div>
          <div class="col-6 text-end">
            <a href="{{ route('admin.payment.index') }}" class="btn btn-outline-primary btn-sm mb-0">View All</a>
          </div>
        </div>
      </div>

      <div class="card-body p-3 pb-0">
        <div class="table-responsive">
          <table class="table align-items-center mb-0 text-xs">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Siswa</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-end">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              @forelse($latestPayments as $pay)
              <tr>
                <td>
                  <p class="text-xs font-weight-bold mb-0">
                    {{ $pay->paid_at?->format('d M Y') ?? $pay->created_at->format('d M Y') }}
                  </p>
                </td>
                <td>
                  <p class="text-xs mb-0">{{ $pay->user->name ?? '-' }}</p>
                </td>
                <td>
                  <span class="badge bg-info text-uppercase text-xxs">{{ $pay->payment_for }}</span>
                </td>
                <td>
                  <span class="badge bg-secondary text-xxs">{{ ucfirst($pay->payment_category) }}</span>
                </td>
                <td class="text-end">
                  <strong class="text-dark text-sm">
                    Rp {{ number_format($pay->amount, 0, ',', '.') }}
                  </strong>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center text-muted text-xs py-3">
                  Belum ada pembayaran masuk
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> -->



  <!-- KANAN: 3 Card Vertikal -->
  <!-- <div class="col-lg-5">
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
  </div> -->
</div>




@endsection