<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" rel="apple-touch-icon" sizes="76x76">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }} ">
  <title>
    Deeniyat App
  </title>
  <!--     Fonts and icons     -->
  <link href=" https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href=" {{ asset ('assets/css/argon-dashboard.css') }} " rel="stylesheet" >
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center mx-auto">
          <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" 
          alt="Deeniyat Al Hidayah Logo" style="width: 80px;">
            <h1 class="text-white mb-2 mt-2" style="font-size: 34px;"> Welcome to Deeniyat Al Hidayah!  </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
  <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-12 mx-auto">
      <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h4 class="font-weight-bolder">KODE QRIS</h4>
            </div>
            <div class="card-body">
            <form role="form">
              <div class="text-center">
                <img src="{{ asset('assets/img/QRIS.jpeg') }}" alt="QRIS Payment" style="max-width: 500px; height: auto;">
              </div>

                <div class="form-group text-center mt-4">
                <a href="{{ asset('assets/img/QRIS.jpeg') }}" download="QRIS-Deeniyat.jpeg" class="btn btn-primary btn-lg w-70">
                    Download QRIS
                </a>
                </div>

            </form>
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
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src=" {{ asset ('assets/js/core/popper.min.js') }} "></script>
  <script src=" {{ asset ('/assets/js/core/bootstrap.min.js') }} "></script>
  <script src=" {{ asset ('/assets/js/plugins/perfect-scrollbar.min.js') }} "></script>
  <script src=" {{ asset ('/assets/js/plugins/smooth-scrollbar.min.js') }} "></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>