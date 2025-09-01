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
    <!-- Header -->
    <div class="page-header align-items-start min-vh-50 pt-5 pb-9 m-3 border-radius-lg"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container text-center">
        <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}"
          alt="Deeniyat Al Hidayah Logo" style="width: 80px; margin-bottom: 35px;">
      </div>
    </div>

    <!-- Content -->
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12 mx-auto">
          <form action="{{ route('payment.process') }}" method="POST" id="paymentForm" data-total-amount="{{ ($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ session('user_id', auth()->id()) }}">
            <input type="hidden" name="class_id" value="{{ session('class_id', 0) }}">
            
            <!-- Card 1: Detail Pembayaran -->
            <div class="card z-index-0 mb-4">
              <div class="card-header text-center pt-4">
                <h5 class="font-weight-bolder">Detail Pembayaran</h5>
                <p class="text-lead" style="font-size: 12px; margin-bottom: -30px;">Rincian biaya yang harus dibayar untuk pendaftaran</p>
              </div>
              <div class="card-body">
                <div class="p-4 bg-light rounded">
                  <div class="d-flex justify-content-between mb-3">
                    <strong>Biaya Pendaftaran</strong>
                    <span>: Rp{{ number_format($class->registration_fee ?? 200000, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <strong>Biaya Prasarana</strong>
                    <span>: Rp{{ number_format($class->infrastructure_fee ?? 100000, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <strong>Biaya Seragam</strong>
                    <span>: Rp{{ number_format($class->uniform_fee ?? 150000, 0, ',', '.') }}</span>
                  </div>
                  <hr class="horizontal dark">
                  <div class="d-flex justify-content-between">
                    <strong class="fw-bold text-primary">Total Biaya</strong>
                    <span class="fw-bold text-primary">: Rp{{ number_format(($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000), 0, ',', '.') }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 2: Pilih Tipe Pembayaran -->
            <div class="card z-index-0 mb-4">
              <div class="card-header text-center pt-4">
                <h5 class="font-weight-bolder">Pilih Tipe Pembayaran</h5>
                <p class="text-lead" style="font-size: 12px; margin-bottom: -30px;">Pilih metode pembayaran yang sesuai dengan preferensi Anda</p>
              </div>
              <div class="card-body">
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

            <!-- Card 3: Pilih Kategori Pembayaran -->
            <div class="card z-index-0 mb-4">
              <div class="card-header text-center pt-4">
                <h5 class="font-weight-bolder">Pilih Kategori Pembayaran</h5>
                <p class="text-lead" style="font-size: 12px; margin-bottom: -30px;">Pilih cara pembayaran yang sesuai dengan kemampuan finansial Anda</p>
              </div>
              <div class="card-body">
                <div class="p-4">
                  <div class="payment-option" onclick="selectPaymentCategory('full')">
                    <input type="radio" name="payment_method" value="full" id="full" required>
                    <label for="full" class="h6 mb-2">Lunas</label>
                    <p class="text-muted mb-0">Bayar seluruh total biaya Rp{{ number_format(($class->registration_fee ?? 200000) + ($class->infrastructure_fee ?? 100000) + ($class->uniform_fee ?? 150000), 0, ',', '.') }}</p>
                  </div>
                  
                  <div class="payment-option" onclick="selectPaymentCategory('installment')">
                    <input type="radio" name="payment_method" value="installment" id="installment" required>
                    <label for="installment" class="h6 mb-2">Cicilan</label>
                    <p class="text-muted mb-0">Total biaya bisa dibayar dalam beberapa kali cicilan</p>
                  </div>
                  
                  <!-- Installment Period Selector (hidden by default) -->
                  <div class="installment-schedule" id="installmentSchedule">
                    <h6 class="text-primary mb-3">Pilih Jumlah Cicilan:</h6>
                    <div class="form-group">
                      <select class="form-control" name="installment_period" id="installment_period">
                        <option value="">Pilih jumlah cicilan</option>
                        <option value="2">2x Cicilan</option>
                        <option value="3">3x Cicilan</option>
                        <option value="4">4x Cicilan</option>
                        <option value="6">6x Cicilan</option>
                        <option value="12">12x Cicilan</option>
                      </select>
                    </div>
                    
                    <div class="mt-3" id="installmentPreview" style="display: none;">
                      <h6 class="text-success mb-2">Preview Cicilan:</h6>
                      <div class="row" id="installmentPreviewContent">
                        <!-- Dynamic content will be inserted here -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Button Actions -->
            <div class="d-flex justify-content-between mt-4 mb-5">
              <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                ⬅ Kembali
              </a>
              <button type="submit" class="btn btn-primary" id="lanjutkanBtn" disabled>
                Lanjutkan ➡
              </button>
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

