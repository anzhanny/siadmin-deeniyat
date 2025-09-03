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
          <form action="{{ route('payment.confirmpayment') }}" method="POST" id="paymentForm" data-total-amount="{{ ($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ session('user_id', auth()->id()) }}">
            <input type="hidden" name="class_id" value="{{ session('class_id', 0) }}">

            <div class="card z-index-0 border shadow-sm" style="background-color: #F5F7F8;">

              <div class="card-body">
                <div class="p-4 bg-white rounded" style="border:1.5px solid #dee2e6;">
                  <div class="card-header text-center pt-4 bg-transparent border-0">
                    <h4 class="font-weight-bolder">Detail Pembayaran</h4>
                    <p class="text-lead" style="font-size: 12px; margin-bottom: -10px;">Rincian biaya yang harus dibayar untuk pendaftaran
                    </p>
                    <hr class="my-4 border border-secondary">
                  </div>

                  <div class="d-flex justify-content-between mb-3" style="margin-left:1.5rem; margin-right:1.5rem; margin-top:-2rem;">
                    <strong>Biaya Pendaftaran</strong>
                    <span class="col-6 ps-md-10">: Rp{{ number_format($class->registration_fee ?? 200000, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3" style="margin:1.5rem">
                    <strong>Biaya Prasarana</strong>
                    <span class="col-6 ps-md-10">: Rp{{ number_format($class->infrastructure_fee ?? 100000, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3" style="margin:1.5rem">
                    <strong>Biaya Prasarana</strong>
                    <span class="col-6 ps-md-10">: Rp{{ number_format($class->infrastructure_fee ?? 100000, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3" style="margin:1.5rem">
                    <strong>Biaya Seragam</strong>
                    <span class="col-6 ps-md-10">: Rp{{ number_format($class->uniform_fee ?? 150000, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3" style="margin:1.5rem">
                    <strong class="fw-bold text-primary">Total Biaya</strong>
                    <span class="col-6 ps-md-10 fw-bold text-primary">: Rp{{ number_format(($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000), 0, ',', '.') }}</span>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="p-4 bg-white rounded" style="border:1.5px solid #dee2e6;">
                  <div class="card-header text-center pt-4 bg-transparent border-0">
                    <h4 class="font-weight-bolder">Pilih Tipe Pembayaran</h4>
                    <p class="text-lead" style="font-size: 12px; margin-bottom: -10px;">Pilih metode pembayaran yang sesuai dengan preferensi Anda</p>
                  </div>
                  <div class="p-4">
                    <div class="payment-option" onclick="selectPaymentType('tunai')">
                      <input type="radio" name="payment_type" value="tunai" id="tunai" required>
                      <label for="tunai" class="h6 mb-2">Tunai</label>
                      <p class="text-muted mb-0">Bayar langsung dan datang ke sekolah</p>
                    </div>

                    <div class="payment-option" onclick="selectPaymentType('non-tunai')">
                      <input type="radio" name="payment_type" value="non-tunai" id="non-tunai" required>
                      <label for="non-tunai" class="h6 mb-2">Non-Tunai</label>
                      <p class="text-muted mb-0">Bayar melalui bank/e-wallet tanpa harus ke sekolah</p>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card-body">
                <div class="p-4 bg-white rounded" style="border:1.5px solid #dee2e6;">
                  <div class="card-header text-center pt-4 bg-transparent border-0">
                    <h4 class="font-weight-bolder">Pilih Kategori Pembayaran</h4>
                    <p class="text-lead" style="font-size: 12px; margin-bottom: -10px;">Pilih cara pembayaran yang sesuai dengan kemampuan finansial Anda</p>
                  </div>
                  <div class="p-4">
                    <div class="payment-option" onclick="selectPaymentCategory('Lunas')">
                      <input type="radio" name="payment_method" value="full" id="full" required>
                      <label for="full" class="h6 mb-2">Lunas</label>
                      <p class="text-muted mb-0">Bayar seluruh total biaya Rp{{ number_format(($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000), 0, ',', '.') }}</p>
                    </div>

                    <div class="payment-option" onclick="selectPaymentCategory('Cicilan')">
                      <input type="radio" name="payment_method" value="installment" id="installment" required>
                      <label for="installment" class="h6 mb-2">Cicilan</label>
                      <p class="text-muted mb-0">Total biaya yang bisa dibayar dalam 3x cicilan adalah Rp150.000/Cicilan</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-end mt-2" style="padding-right: 1.7rem;">
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                  Kembali
                </a>
                <button type="submit" class="btn btn-primary" id="lanjutkanBtn" disabled>
                  Lanjutkan ➡
                </button>
              </div>
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



      validateForm();
    }

    function validateForm() {
      const paymentType = document.querySelector('input[name="payment_type"]:checked');
      const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
      const lanjutkanBtn = document.getElementById('lanjutkanBtn');

      let isValid = paymentType && paymentMethod;

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



    // Initialize form validation
    document.addEventListener('DOMContentLoaded', function() {
      validateForm();
    });
  </script>
</body>

</html>