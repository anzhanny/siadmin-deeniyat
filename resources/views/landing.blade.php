<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/logos/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
  <title>Deeniyat Al Hidayah - Sistem Pembayaran Sekolah</title>

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/argon-design-system.css?v=1.2.2') }}" rel="stylesheet" />
</head>

<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5" href="{{ route('landing') }}">
        <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" width="60">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
        aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <ul class="navbar-nav ml-lg-auto">
          <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-neutral">Masuk</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Hero Section -->
  <div class="section section-hero section-shaped">
    <div class="shape shape-style-3 shape-primary">
      <span class="span-150"></span>
      <span class="span-50"></span>
      <span class="span-50"></span>
      <span class="span-75"></span>
      <span class="span-100"></span>
    </div>
    <div class="page-header">
      <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="text-white display-3">Selamat Datang di Sistem Pembayaran Sekolah</h1>
              <p class="lead text-white mt-3">Kelola pembayaran SPP, registrasi, dan cicilan dengan mudah dan cepat.</p>
              <div class="btn-wrapper mt-4">
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="btn btn-dark btn-lg">Masuk</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none">
        <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>

  <!-- Features Section -->
  <div class="section features-1">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center">
          <span class="badge badge-primary badge-pill mb-3">Fitur Utama</span>
          <h3 class="display-3">Mudah, Cepat, Transparan</h3>
          <p class="lead">Sistem ini memudahkan admin dan orang tua siswa memantau pembayaran dengan cepat.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="info">
            <div class="icon icon-lg icon-shape bg-gradient-primary shadow rounded-circle text-white">
              <i class="fas fa-money-bill-wave"></i>
            </div>
            <h6 class="info-title text-primary">Pembayaran Online</h6>
            <p class="description">Bayar SPP dan registrasi langsung melalui sistem dengan metode lunas maupun cicilan.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow rounded-circle text-white">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <h6 class="info-title text-success">Kelola Cicilan</h6>
            <p class="description">Pantau jadwal cicilan siswa dengan notifikasi jatuh tempo.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info">
            <div class="icon icon-lg icon-shape bg-gradient-warning shadow rounded-circle text-white">
              <i class="fas fa-chart-line"></i>
            </div>
            <h6 class="info-title text-warning">Laporan Lengkap</h6>
            <p class="description">Ekspor laporan pembayaran dalam format Excel untuk administrasi sekolah.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Call To Action -->
  <section class="py-6 bg-gradient-warning">
    <div class="container text-center text-white">
      <h3>Siap Bergabung?</h3>
      <p class="mb-4">Daftar sekarang dan jadilah bagian dari Madrasah Unggulan.</p>
      <a href="{{ route('register') }}" class="btn btn-dark btn-lg">Daftar Sekarang</a>
      <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}" class="text-white font-weight-bold">Masuk di sini</a></p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <hr>
      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
          <div class="copyright">
            &copy; {{ date('Y') }} <a href="#">Deeniyat Al Hidayah</a>.
          </div>
        </div>
        <div class="col-md-6">
          <ul class="nav nav-footer justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link">Tentang Kami</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Kontak</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Core JS -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon-design-system.min.js?v=1.2.2') }}"></script>
</body>
</html>
