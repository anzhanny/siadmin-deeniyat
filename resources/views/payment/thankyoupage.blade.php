<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
  <title>
    Deeniyat App - Thank You
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" 
         style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center mx-auto">
            <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" 
                 alt="Deeniyat Al Hidayah Logo" style="width: 80px;">
            <h1 class="text-white mb-2 mt-2" style="font-size: 34px;"> Pembayaran Berhasil! </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5 class="font-weight-bolder text-success">Selamat!</h5>
              <p class="text-lead" style="font-size: 14px;">
                Terima kasih telah melakukan pembayaran pendaftaran.<br>
                Data Anda telah kami terima dan status Anda sekarang adalah <strong>Siswa Aktif</strong> di 
                <b>Deeniyat Al Hidayah</b>.
              </p>
            </div>
            <div class="card-body text-center">
              <img src="{{ asset('assets/img/thankyou.png') }}" alt="Thank You" 
                   class="img-fluid mb-4" style="max-width: 220px;">
              <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                  Lanjut ke Dashboard
                </a>
              </div>
              <p class="text-sm mt-3 mb-0">
                Jika ada pertanyaan, silakan hubungi admin sekolah.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          © <script>document.write(new Date().getFullYear())</script>,
          Deeniyat Al Hidayah. <i class="fa fa-heart"></i> All Rights Reserved.
        </div>
      </div>
    </div>
  </footer>
  
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>
</html>
