@extends('layouts.layout')
@section('content')


<div class="row">
  <!-- Status Pembayaran Bulan Ini -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      

      <div class="card-body p-3">
  

        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Status SPP</p>
              <span class="text-xs text-secondary">Bulan April 2025</span>
              <h5 class="font-weight-bolder mt-2 text-success">
                Lunas
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
  </div>

  <!-- Total Tunggakan -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Tunggakan</p>
              <span class="text-xs text-secondary">Semester: Ganjil 2024</span>
              <h5 class="font-weight-bolder mt-2">
                0
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
  </div>

  <!-- Rata-rata Nilai Terakhir -->
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Rata-rata Nilai</p>
              <span class="text-xs text-secondary">Semester: Ganjil 2024</span>
              <h5 class="font-weight-bolder mt-2">
                87.3
              </h5>
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

  <!-- Notifikasi / Pengumuman -->
  <!-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card h-100">
      <div class="card-body p-3 d-flex flex-column justify-content-between">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <p class="text-sm mb-1 text-uppercase font-weight-bold">Pengumuman Terbaru</p>
            <h6 class="mb-0" style="font-size: 12px;">“Pembayaran SPP bulan April ditutup tanggal 25”</h6>
          </div>
          <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
            <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>


      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Papan Pengumuman</h6>
              <p class="text-sm mb-0 text-muted">Informasi terbaru untuk siswa</p>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Pembayaran SPP bulan April ditutup tanggal 25
                  <span class="badge bg-danger text-white rounded-pill">12 Apr 2025</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Ujian Tengah Semester dimulai 10 Mei
                  <span class="badge bg-warning text-dark rounded-pill">10 Mei 2025</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Libur Nasional: Hari Buruh
                  <span class="badge bg-info text-white rounded-pill">1 Mei 2025</span>
                </li>
              </ul>
            </div>
        </div>
      </div>

        

        <div class="col-lg-5">
          <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
              <div class="carousel-inner border-radius-lg h-100">
                <div class="carousel-item h-100 active" style="background-image: url('../assets/img/carousel-1.jpg');background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-camera-compact text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Get started with Argon</h5>
                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-2.jpg');background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Faster way to create web pages</h5>
                    <p>That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-3.jpg');background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-trophy text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      
      </div>

      @endsection