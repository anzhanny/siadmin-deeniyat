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
</head>

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

    .payment-option input[type="radio"] {
        margin-right: 10px;
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
</style>

<body class="">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-10 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center mx-auto">
                        <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}"
                            alt="Deeniyat Al Hidayah Logo" style="width: 80px;">
                        <h3 class="text-white mb-2 mt-2">Proses Pembayaran Administrasi</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
                    <form action="{{ route('payment.process') }}" method="POST" id="paymentForm" data-total-amount="{{ ($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000) }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ session('user_id', auth()->id()) }}">
                        <input type="hidden" name="class_id" value="{{ session('class_id', 0) }}">

                        <!-- Card 1: Detail Pembayaran -->
                        <div class="card z-index-0 border shadow-sm" style="background-color: #F5F7F8;">

                            <div class="card-header text-center pt-4">
                                <h4 class="font-weight-bolder">Konfirmasi Pembayaran</h4>
                                <p class="text-lead" style="font-size: 12px; margin-bottom: -30px;">Cek dan periksa apakah data yang anda masukan sudah sesuai dengan apa yang anda pilih sebelumnya, jika sudah maka lanjutkan pembayaran</p>
                            </div>

                            <div class="card-body">
                                <div class="p-4 bg-white rounded" style="border:1.5px solid #dee2e6;">
                                    <div class="card-header text-center pt-4 bg-transparent border-0">
                                        <h4 class="font-weight-bolder">Data Calon Siswa
                                            <hr class="my-4 border border-secondary">
                                        </h4>
                                    </div>
                                    <div class="row p-4">
                                        <!-- Kolom Kiri -->
                                        <div class="row g-3" style="margin-top: -3rem;">
                                            <!-- Kolom Kiri -->
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Nama Calon Siswa</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">Ahmad Fauzi</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Alamat</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">Jl. Merdeka No.123, Jakarta</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Tempat, Tanggal Lahir</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">Jakarta, 01 Januari 2010</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Nama Ayah</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">Budi Santoso</span>
                                                </div>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div class="col-12 col-md-6 ps-md-10">
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Email</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">ahmad.fauzi@example.com</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">No Telp</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">0812-3456-7890</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Jenis Kelamin</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">Laki-laki</span>
                                                </div>
                                                <div class="mb-3">
                                                    <strong class="d-block text-secondary small opacity-50">Kelas Pendidikan Formal</strong>
                                                    <span class="d-block fs-5 fw-semibold text-dark">5 SD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="p-4 bg-white rounded" style="border:1.5px solid #dee2e6;">
                                    <div class="card-header text-center pt-4 bg-transparent border-0">
                                        <h4 class="font-weight-bolder">Pilihan Pembayaran Anda
                                            <hr class="my-4 border border-secondary">
                                        </h4>
                                    </div>
                                    <div class="p-4" style="margin-top: -3rem;">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <strong class="d-block text-secondary">Tipe Pembayaran Anda</strong>
                                            </div>
                                            <div class="col-6 ps-md-10">
                                                <span class="d-block text-dark">: Tunai</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <strong class="d-block text-secondary">Kategori Pembayaran Anda</strong>
                                            </div>
                                            <div class="col-6 ps-md-10">
                                                <span class="d-block text-dark">: Lunas</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <strong class="d-block text-secondary">Total Biaya</strong>
                                            </div>
                                            <div class="col-6 ps-md-10">
                                                <span class="d-block text-dark">: Rp450.000</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-end mt-2" style="padding-right: 1.7rem;">
                                <a href="{{route('payment.detailpayment')}}" class="btn btn-primary">Kembali</a>
                                <a href="{{route('payment.thankyoupage')}}" class="btn btn-primary">Lanjutkan Pembayaran</a>
                                <!-- <button type="submit" class="btn btn-primary" id="lanjutkanBtn" disabled>
                Lanjutkan ➡
              </button> -->
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

    <script>
        function selectPaymentType(type) {
            // Remove selected class from all payment type options
            document.querySelectorAll('input[name="payment_type"]').forEach(radio => {
                radio.closest('.payment-option').classList.remove('selected');
            });

            // Add selected class to clicked option
            document.getElementById(type).closest('.payment-option').classList.add('selected');
            document.getElementById(type).checked = true;

            validateForm();
        }

        function selectPaymentCategory(category) {
            // Remove selected class from all payment category options
            document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                radio.closest('.payment-option').classList.remove('selected');
            });

            // Add selected class to clicked option
            document.getElementById(category).closest('.payment-option').classList.add('selected');
            document.getElementById(category).checked = true;

            // Show/hide installment schedule
            const installmentSchedule = document.getElementById('installmentSchedule');
            if (category === 'installment') {
                installmentSchedule.classList.add('show');
                // Reset installment period selection
                document.getElementById('installment_period').value = '';
                document.getElementById('installmentPreview').style.display = 'none';
            } else {
                installmentSchedule.classList.remove('show');
                document.getElementById('installmentPreview').style.display = 'none';
            }

            validateForm();
        }

        function validateForm() {
            const paymentType = document.querySelector('input[name="payment_type"]:checked');
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            const installmentPeriod = document.getElementById('installment_period');
            const lanjutkanBtn = document.getElementById('lanjutkanBtn');

            let isValid = paymentType && paymentMethod;

            // If installment is selected, check if period is selected
            if (paymentMethod && paymentMethod.value === 'installment') {
                isValid = isValid && installmentPeriod.value !== '';
            }

            if (isValid) {
                lanjutkanBtn.disabled = false;
                lanjutkanBtn.classList.remove('btn-secondary');
                lanjutkanBtn.classList.add('btn-primary');
            } else {
                lanjutkanBtn.disabled = true;
                lanjutkanBtn.classList.remove('btn-primary');
                lanjutkanBtn.classList.add('btn-secondary');
            }
        }

        // Handle installment period selection
        document.getElementById('installment_period').addEventListener('change', function() {
            const period = this.value;
            const preview = document.getElementById('installmentPreview');
            const previewContent = document.getElementById('installmentPreviewContent');

            if (period) {
                const totalAmount = parseInt(document.getElementById('paymentForm').getAttribute('data-total-amount'));
                const installmentAmount = Math.ceil(totalAmount / period);
                const lastInstallment = totalAmount - (installmentAmount * (period - 1));

                let html = '';
                for (let i = 1; i <= period; i++) {
                    const amount = i === period ? lastInstallment : installmentAmount;
                    const colorClass = i === 1 ? 'text-success' : i === period ? 'text-info' : 'text-warning';

                    html += '<div class="col-md-' + (12 / Math.min(period, 4)) + ' mb-2">' +
                        '<div class="text-center p-3 bg-white rounded border">' +
                        '<h6 class="' + colorClass + '">Cicilan ' + i + '</h6>' +
                        '<p class="mb-1">Rp' + amount.toLocaleString('id-ID') + '</p>' +
                        '<small class="text-muted">' + (i === 1 ? 'Tanggal Pendaftaran' : 'Bulan ke-' + i) + '</small>' +
                        '</div></div>';
                }

                previewContent.innerHTML = html;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }

            validateForm();
        });

        // Initialize form validation
        document.addEventListener('DOMContentLoaded', function() {
            validateForm();
        });
    </script>
</body>

</html>