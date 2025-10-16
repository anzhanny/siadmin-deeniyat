<!--
=========================================================
* Argon Design System - v1.2.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
  <title>Beranda - Deeniyat Al Hidayah</title>

  <!-- Fonts and icons -->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Argon CSS -->
  <link href="{{ asset('assets/css/argon-design-system.css?v=1.2.2') }}" rel="stylesheet" />

  <style>
    /* ====== Navbar ====== */
    .logo-responsive {
      height: 40px;
      width: auto;
      max-width: 100%;
      transition: 0.3s ease;
    }

    @media (max-width: 768px) {
      .logo-responsive {
        height: 30px;
      }
    }

    .navbar-toggler {
      border: none;
      outline: none;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30'
        xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,0.9)'
        stroke-width='2' stroke-linecap='round' stroke-miterlimit='10'
        d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
    }

    /* ====== Hero Section ====== */
    .header-2 {
      background: linear-gradient(87deg, #172b4d 0, #1a174d 100%);
      background-size: cover;
      background-position: center;
      min-height: 60vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
    }

    /* ====== Footer ====== */
    footer {
      background-color: #111;
      padding: 2rem 0;
      text-align: center;
      color: white;
    }
  </style>
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light py-2">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand text-white d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" alt="Logo Deeniyat" class="me-2 logo-responsive">
        <span class="d-none d-md-inline fw-bold" style="margin-left: 5px;">Deeniyat Al Hidayah</span>
      </a>

      <!-- Toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_global"
        aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="navbar_global" style="align-items: end;">
        <ul class="navbar-nav ms-auto align-items-lg-center" style="font-size: medium;">
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-info btn-sm ms-lg-3">Daftar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <div class="wrapper">
    <div class="section section-hero section-shaped">
      <div class="shape shape-style-3 shape-default">
        <span class="span-150"></span><span class="span-50"></span><span class="span-75"></span><span class="span-100"></span>
      </div>

      <div class="page-header">
        <div class="container shape-container d-flex align-items-center py-lg">
          <div class="col px-0 text-center">
            <h3 class="text-white display-1 mb-3">Selamat Datang di Website Deeniyat Al Hidayah!</h3>
            <h5 class="display-4 font-weight-normal text-white mb-4">
              Kini Sistem Pembayaran Sekolah dapat diakses dengan Mudah dan Cepat
            </h5>
            <!-- <a href="{{ route('login') }}" class="btn btn-info btn-icon mt-3">
              <span class="btn-inner--icon"><i class="ni ni-key-25"></i></span>
              <span class="btn-inner--text">Masuk Sekarang</span>
            </a> -->
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>

    <!-- About Section -->
    <div class="section features-6 py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12">
            <div class="info info-horizontal">
              <div class="description">
                <h5 class="title">About Deeniyat Al Hidayah</h5>
                <p>
                  Deeniyat adalah program intensif pendidikan agama dan pembinaan karakter untuk anak, remaja, dan dewasa.
                </p>
              </div>
            </div>
            <div class="info mt-4">
              <div class="description">
                <h5 class="title">Deeniyat hadir sebagai:</h5>
                <ul>
                  <li>Madrasah</li>
                  <li>Privat Class</li>
                  <li>Ekstra Kulikuler</li>
                  <li>Muatan Lokal</li>
                </ul>
              </div>
            </div>
            <div class="info mt-4">
              <div class="description">
                <h5 class="title">Madrasah Unggulan dengan:</h5>
                <ul>
                  <li>Guru terstandar</li>
                  <li>Materi berkelanjutan selama 16 tahun</li>
                  <li>Pembinaan rutin</li>
                  <li>1 jam per hari menguasai banyak materi</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-10 mx-auto mt-4 mt-lg-0">
            <img src="{{ asset('assets/img/ill/ill2.png') }}" alt="Illustration" class="img-fluid">
          </div>
        </div>
      </div>
    </div>

    <!-- Materi -->
    <div class="section features-1 py-5">
      <div class="container text-center">
        <span class="badge badge-primary badge-pill mb-3">PROGRAM</span>
        <h3 class="display-4">Materi Pembelajaran Deeniyat Al-Hidayah</h3>
        <p class="lead mb-5">Berikut ini adalah Materi Pembelajaran Deeniyat Al-Hidayah yang berbeda dengan Madrasah lainnya.</p>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-3">
                <i class="fas fa-book fa-2x text-primary"></i>
              </div>
              <h6 class="info-title text-uppercase text-primary">Al-Qur'an</h6>
              <p>Menggunakan Kitab Qaidah Nuraniyah dengan metode Tahajji Nurul Bayan ditambah dengan Hafalan Surat.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle mb-3">
                <i class="ni ni-atom"></i>
              </div>
              <h6 class="info-title text-uppercase text-success">Hadits</h6>
              <p>Mempelajari Hafalan Hadist, Doa, dan Adab Sehari-hari.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-danger shadow rounded-circle mb-3">
                <i class="ni ni-istanbul text-danger"></i>
              </div>
              <h6 class="info-title text-uppercase text-danger">Aqidah & Fiqih</h6>
              <p>Memperlajari Sholat, Asmaul Husna dan Fiqih.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle mb-3">
                <i class="ni ni-world-2 text-warning"></i>
              </div>
              <h6 class="info-title text-uppercase text-warning">Pendidikan Islam</h6>
              <p>Pidato, Sirah Nabawiyah dan Pengetahuan Islam.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-info shadow rounded-circle mb-3">
                <i class="ni ni-world text-info"></i>
              </div>
              <h6 class="info-title text-uppercase text-info">Bahasa Arab</h6>
              <p>Menguasai Perkenalan Bahasa Arab dan Huruf Jawi.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br /><br />
    <footer class="footer">
      <div class="container">
        <div class="row row-grid align-items-center mb-5">
          <div class="col-lg-6">
            <h3 class="text-primary font-weight-light mb-2">
              Mari gabung dengan kami!
            </h3>
            <h4 class="mb-0 font-weight-light">
              Daftar sekarang dan jadilah bagian dari Madrasah Deeniyat Al-Hidayah
            </h4>
            <a href="{{ route('register') }}" class="btn bg-gradient-primary btn-lg text-white mt-3">
              Daftar Sekarang
            </a>
            <hr class="my-4">
            <p class="mt-3">
              Sudah punya akun?
              <a href="{{ route('login') }}" class="text-primary font-weight-bold">
                Login di sini!
              </a>
            </p>

          </div>

        </div>
        <hr />
        <div class="row align-items-center justify-content-md-between">
          <div class="col-8 mx-auto text-center mt-1">

          © <script>
            document.write(new Date().getFullYear())
          </script>,
          Deeniyat Al Hidayah.<i class="fa fa-heart"></i> All Rights Reserved.
          <!-- <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a> -->
          <!-- for a better web. -->

        </div>


        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script
    src="../assets/js/core/jquery.min.js"
    type="text/javascript"></script>
  <script
    src="../assets/js/core/popper.min.js"
    type="text/javascript"></script>
  <script
    src="../assets/js/core/bootstrap.min.js"
    type="text/javascript"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="../assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script
    src="../assets/js/plugins/nouislider.min.js"
    type="text/javascript"></script>
  <script src="../assets/js/plugins/moment.min.js"></script>
  <script
    src="../assets/js/plugins/datetimepicker.js"
    type="text/javascript"></script>
  <script src="../assets/js/plugins/bootstrap-datepicker.min.js"></script>
  <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script
    src="../assets/js/argon-design-system.min.js?v=1.2.2"
    type="text/javascript"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-design-system-pro",
      });
  </script>
</body>

</html>