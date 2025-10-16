<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
  <title>Terima Kasih - Deeniyat App</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
</head>

<body class="">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-75 pt-5 pb-10 m-3 border-radius-lg"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: center;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mx-auto text-white">
            <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" alt="Deeniyat Logo" style="width: 80px;">
            <h1 class="mt-4 fw-bold text-white">Terima Kasih!</h1>
            <p>Terima kasih sudah melakukan pembayaran. Silakan klik tombol di bawah untuk verifikasi data Anda.</p>

            @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @elseif(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @elseif(session('info'))
            <div class="alert alert-info mt-3">{{ session('info') }}</div>
            @endif

            <form action="{{ route('send.verification.email') }}" method="POST">
  @csrf
  <input type="hidden" name="user_id" 
         value="{{ $user->id ?? $latestPayment->user_id ?? '' }}">
  <button type="submit" class="btn btn-dark mt-4">
    <i class="fa fa-envelope"></i> Verifikasi Data & Kirim ke Email
  </button>
</form>


            <div class="mt-4">
              <a href="{{ route('login') }}" class="btn btn-info">Kembali ke Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1 text-muted">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          Deeniyat Al Hidayah. <i class="fa fa-heart"></i> All Rights Reserved.
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>