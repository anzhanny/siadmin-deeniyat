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
        <div class="page-header align-items-start min-vh-75 pt-10 pb-10 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: center;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container text-center py-5">
                <h4 class="font-weight-bolder text-white">Pembayaran Tunai</h4>
                <p class="text-white">Silakan klik tombol di bawah ini untuk melanjutkan konfirmasi pembayaran tunai via WhatsApp! <br> Setelah itu kembali ke beranda dan login!</p>

                <a href="{{ $url }}" class="btn btn-lg btn-success " target="_blank">
                    Hubungi Admin via WhatsApp
                </a>

                <a href="{{ route('login') }}" class="btn btn-lg btn-primary">
                <i class="fas fa-home"></i> Kembali ke Beranda
              </a>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // coba buka WA otomatis
            window.open(document.getElementById('waBtn').href, "_blank");

            // countdown 5 detik
            let counter = 5;
            let countdownEl = document.getElementById('countdown');
            let timer = setInterval(() => {
                counter--;
                countdownEl.textContent = counter;
                if (counter <= 0) {
                    clearInterval(timer);
                    window.location.href = "{{ route('payment.thankyoupage') }}"; // thankyou page
                }
            }, 1000);
        });
    </script>
</body>

</html>