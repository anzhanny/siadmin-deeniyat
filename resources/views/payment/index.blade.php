<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
    <title>Proses Pembayaran - Deeniyat App</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">

    <style>
        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            border-color: #5e72e4;
            background-color: #f8f9ff;
        }

        .payment-option.selected {
            border-color: #5e72e4;
            background-color: #f8f9ff;
            box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
        }

        .installment-schedule {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            display: none;
        }

        .installment-schedule.show {
            display: block;
        }

        .card-header.bg-light {
            background-color: #f8f9fa !important;
        }

        .list-group-item {
            border: none;
            padding: 8px 0;
        }
    </style>
</head>

<body>
    <main class="main-content mt-0">
        <!-- Header -->
        <div class="page-header align-items-start min-vh-50 pt-5 pb-9 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container text-center">
                <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" alt="Deeniyat Al Hidayah Logo"
                    style="width: 80px; margin-bottom: 35px;">
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-12 mx-auto">
                    <form action="{{ route('payment.process') }}" method="POST" id="paymentForm"
                        data-total-amount="{{ ($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000) }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ session('user_id', auth()->id()) }}">
                        <input type="hidden" name="class_id" value="{{ session('class_id', 0) }}">

                        <!-- Card Konfirmasi -->
                        <div class="card z-index-0 mb-4">
                            <div class="card-header text-center pt-4">
                                <h5 class="font-weight-bolder">Konfirmasi Pembayaran</h5>
                                <p class="text-lead" style="font-size: 12px; margin-bottom: -30px;">Rincian biaya yang harus dibayar untuk pendaftaran</p>
                            </div>


                            <!-- Card Data Siswa -->
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header bg-light text-center rounded-top">
                                    <h5 class="mb-0">Data Siswa</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Kolom kiri -->
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush mb-3">
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Nama</span>
                                                    <strong>Fulan</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Alamat</span>
                                                    <strong>Bandung</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Tempat, tanggal lahir</span>
                                                    <strong>Bandung, 11 Agustus 2019</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Nama Ayah</span>
                                                    <strong>ayah Fulan</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Kelas Pendidikan Formal</span>
                                                    <strong>1 SD</strong>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Kolom kanan -->
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush mb-3">
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Nama</span>
                                                    <strong>Fulan</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Alamat</span>
                                                    <strong>Bandung</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Tempat, tanggal lahir</span>
                                                    <strong>Bandung, 11 Agustus 2019</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Nama Ayah</span>
                                                    <strong>ayah Fulan</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Kelas Pendidikan Formal</span>
                                                    <strong>1 SD</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Detail Pembayaran -->
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header bg-light text-center rounded-top">
                                    <h5 class="mb-0">Detail Pembayaran</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Tipe Pembayaran</span>
                                            <strong>Tunai</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Kategori Pembayaran</span>
                                            <strong>Lunas</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total yang harus dibayarkan</span>
                                            <strong>Rp450.000</strong>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-footer d-flex justify-content-between bg-white border-0">
                                    <button type="button" class="btn btn-secondary">
                                        Simpan & Bayar Nanti (Cash)
                                    </button>
                                    <button type="button" class="btn btn-secondary">
                                        Lanjutkan ke Pembayaran
                                    </button>
                                </div>

                            </div>

                            <!-- Button Actions -->
                            <!-- <div class="d-flex justify-content-between mt-4 mb-5">
                            <a href="/" class="btn btn-primary">Bayarkan</a>
                        </div> -->
                        </div>
                    </form>
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
</body>

</html>