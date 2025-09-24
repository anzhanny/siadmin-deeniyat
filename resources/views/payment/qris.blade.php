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
    <title>Pembayaran Midtrans - Deeniyat App</title>
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
        <div class="page-header align-items-start min-vh-50 pt-5 pb-10 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container text-center">
                <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" alt="Logo" style="width: 80px;">
                <h3 class="text-white mt-2">Pembayaran QRIS</h3>
                <p class="text-white">Silakan scan QR Code di bawah untuk menyelesaikan pembayaran.</p>
            </div>
        </div>

        <div class="container">
            <div class="row mt-n10 justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-12 mx-auto">
                    <div class="card shadow-lg border-0">
                        <div class="card-body text-center p-5">
                            <h4>Pembayaran Online</h4>
                            <p>Kode Transaksi: <b>{{ $payment->code }}</b></p>
                            <p>Jumlah: Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>

                            @if($qrString)
                            <img src="{{ $qrString }}" alt="QRIS" style="max-width:300px;">
                            <p class="mt-3">Scan menggunakan aplikasi e-wallet Anda (Dana, OVO, ShopeePay, GoPay, dll).</p>


                            <button id="checkPayment" class="btn btn-success mt-4">Saya sudah bayar</button>
        <p id="statusText" class="mt-3"></p>
    @else
        <p>QRIS tidak tersedia, silakan coba lagi.</p>
    @endif
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

    <!-- Midtrans Snap.js -->
     <script>
        document.getElementById('checkPayment').addEventListener('click', function() {
    fetch("{{ route('payment.qris.check', $payment->id) }}")
        .then(res => res.json())
        .then(data => {
            if (data.status === 'settlement' || data.status === 'capture') {
                window.location.href = "{{ route('payment.thankyou') }}";
            } else {
                document.getElementById('statusText').innerText = "Status: " + data.status + " (belum berhasil)";
            }
        })
        .catch(() => {
            document.getElementById('statusText').innerText = "Gagal cek status pembayaran.";
        });
});
     </script>

</body>

</html>