<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/logos/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
  <title>Deeniyat Al Hidayah</title>

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- CSS -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

  <style>
    #toggleIcon {
      font-size: 0.8rem;
      color: #9a9fa3;
    }
  </style>
</head>

<body class="">
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                
                <!-- Logo -->
                <div class="card-header pb-0 text-center">
                  <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" 
                       alt="Deeniyat Al Hidayah Logo" 
                       style="width: 100px; margin-bottom: 10px;">
                </div>

                <!-- Title -->
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Login</h4>
                  <p class="mb-0" style="font-size: 12px;">
                    Masukkan email dan password Anda untuk masuk <b>Deeniyat Al Hidayah</b>
                  </p>
                </div>

                <!-- Form -->
                <div class="card-body">
                  @if($errors->any())
                    <div class="alert alert-danger">
                      <ul class="mb-0">
                        @foreach($errors->all() as $item)
                          <li>{{ $item }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <form role="form" method="POST">
                    @csrf
                    <div class="mb-3">
                      <input name="email" type="email" 
                             class="form-control form-control-lg" 
                             placeholder="Email" aria-label="Email" 
                             value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3 position-relative">
                      <input id="password" name="password" type="password"
                             class="form-control form-control-lg"
                             placeholder="Password" aria-label="Password"
                             required>

                      <!-- toggle eye -->
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                            onclick="togglePassword()" style="cursor:pointer; z-index:10;">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                      </span>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary w-100 mt-4 mb-0">
                        Masuk
                      </button>
                    </div>
                  </form>
                </div>

                <!-- Register link -->
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Daftar</a>
                  </p>
                </div>
              </div>
            </div>

            <!-- Right side image -->
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" 
                   style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg'); background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Mendidik dengan Cinta"</h4>
                <p class="text-white position-relative">
                  Setiap huruf Al-Qur’an yang dipelajari hari ini, adalah pondasi kemuliaan bangsa esok hari.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Core JS -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
    }
  </script>

  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>

  <!-- Toggle password visibility -->
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>
