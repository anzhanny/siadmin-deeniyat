@extends('layouts.layout')
@section('content')
      <!-- ROW: Statistik Atas -->
<div class="row">
  <!-- Total Guru -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Guru</p>
              <h5 class="font-weight-bolder mt-2">20</h5>
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

  <!-- Total Siswa -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Siswa</p>
              <h5 class="font-weight-bolder mt-2">350</h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
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
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Kelas</p>
              <h5 class="font-weight-bolder mt-2">15</h5>
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
</div>

<!-- ROW: Grafik dan Statistik Tambahan -->
<div class="row mt-5">
  <!-- KIRI: Grafik Pembayaran -->
  <div class="col-lg-7 mb-lg-0 mb-4">
    <div class="card z-index-2 h-100">
      <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Pembayaran SPP Bulan Ini</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-arrow-up text-success"></i>
          <span class="font-weight-bold">60% meningkat</span> Semester Ganjil2024/2025
        </p>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
        </div>
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
            <p class="text-sm text-uppercase font-weight-bold mb-1">Siswa Belum Bayar SPP</p>
            <span class="text-xs text-secondary">Semester Ganjil 2024/2025</span>
            <h5 class="font-weight-bolder">57 /350 Siswa</h5>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
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
            <p class="text-sm text-uppercase font-weight-bold mb-1">Raport Diinput</p>
            <h5 class="font-weight-bolder">8 / 10 Kelas</h5>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
              <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CARD 3: Jadwal Penginputan -->
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <p class="text-sm text-uppercase font-weight-bold mb-1">Jadwal Penginputan Nilai</p>
            <h6 class="font-weight-normal mb-0">Batas: 25 April 2025</h6>
            <span class="text-xs text-danger">2 Guru belum input</span>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
              <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


      

      @endsection