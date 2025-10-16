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
    Pendaftaran - Deeniyat Al Hidayah
  </title>
  <!--     Fonts and icons     -->
  <link href=" https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- CSS Files -->
  <link id="pagestyle" href=" {{ asset ('assets/css/argon-dashboard.css') }} " rel="stylesheet">
</head>

<style>
  .password-toggle {
    position: absolute;
    right: 1.5rem;
    /* Sama seperti me-5 */
    top: 73%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 0.8rem;
    color: #9a9fa3ff;
  }

  /* Responsif: kalau layar sempit (misalnya <576px), ikon agak dinaikkan */
  @media (max-width: 576px) {
    .password-toggle {
      top: 73%;
      /* kembali pas di tengah */
      right: 1rem;
      /* sedikit lebih ke kiri supaya nggak ketabrak edge */
      font-size: 1rem;
      /* ikon agak lebih besar biar gampang diklik */
    }
  }

  /* Form validation styles */
  .form-control.is-valid {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
  }

  .form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
  }

  .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }

  .form-check.is-valid {
    color: #28a745;
  }

  .form-check.is-invalid {
    color: #dc3545;
  }

  /* File upload styling */
  .form-control[type="file"] {
    padding: 0.375rem 0.75rem;
  }

  .form-control[type="file"]::-webkit-file-upload-button {
    padding: 0.375rem 0.75rem;
    margin: -0.375rem -0.75rem;
    margin-inline-end: 0.75rem;
    color: #495057;
    background-color: #e9ecef;
    border: 0;
    border-inline-end: 1px solid #ced4da;
    border-radius: 0.375rem;
  }

  .form-control[type="file"]::file-selector-button {
    padding: 0.375rem 0.75rem;
    margin: -0.375rem -0.75rem;
    margin-inline-end: 0.75rem;
    color: #495057;
    background-color: #e9ecef;
    border: 0;
    border-inline-end: 1px solid #ced4da;
    border-radius: 0.375rem;
  }

  /* Optional field styling */
  .form-label.optional::after {
    content: " (Opsional)";
    color: #6c757d;
    font-weight: normal;
    font-size: 0.875em;
  }

  /* Success button state */
  .btn-success {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
  }

  .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }

  /* Form text styling */
  .form-text {
    font-size: 0.875em;
    color: #6c757d;
    margin-top: 0.25rem;
  }

  /* Improved form validation feedback */
  .form-control.is-valid:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
  }

  .form-control.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
  }
</style>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-10 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>

      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="card shadow-lg border-0">
              <div class="card-body p-5">

                <h3 class="mb-4 text-center">Konfirmasi Pembayaran</h3>

                <!-- Data Siswa -->
                <h5 class="mb-3">Data Siswa</h5>
                <div class="row">
                  <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $payment->user->name }}</p>
                    <p><strong>Email:</strong> {{ $payment->user->email }}</p>
                    <p><strong>Telp:</strong> {{ $payment->user->phone ?? '-' }}</p>
                    <p><strong>Pembayaran Untuk:</strong> {{ ucfirst($payment->payment_for) }}</p>
                  </div>
                  <div class="col-md-6">
                    <p><strong>Tipe:</strong> {{ ucfirst($payment->payment_type) }}</p>
                    <p><strong>Kategori:</strong> {{ ucfirst($payment->payment_category) }}</p>
                    <p><strong>Nominal:</strong> Rp{{ number_format($payment->amount,0,',','.') }}</p>
                    @if($payment->installment_id)
                    <p><strong>Cicilan ke:</strong> {{ $payment->installment_to }}</p>
                    @endif
                  </div>
                </div>

                <hr>

                <!-- Tombol bayar -->
                @if($payment->payment_type === 'non-tunai')
                <div class="text-center">
                  <button id="pay-button" class="btn btn-primary btn-lg">Bayar Sekarang</button>
                </div>
                @else
                <div class="text-center">
                  @if($payment->payment_type === 'tunai')

                  @if($payment->payment_category === 'lunas')
                  <!-- Pembayaran tunai lunas -->
                  <a href="https://wa.me/6285864921179?text=Assalamu'alaikum Asatidz/Asatidzah Deeniyat Al Hidayah, perkenalkan Nama Saya {{ $payment->user->name }}. Saya ingin mengkonfirmasi pembayaran pendaftaran tunai secara lunas sebesar Rp450.000."
                    class="btn btn-success btn-lg wa-btn"
                    target="_blank">
                    Konfirmasi via WhatsApp
                  </a>

                  <p class="mt-3 text-muted" style="font-size: 0.9em;">
                    Anda memilih pembayaran <strong>tunai (lunas)</strong>. Silakan lakukan pembayaran sebesar <strong>Rp450.000</strong> kepada admin dan konfirmasi via WhatsApp.
                  </p>

                  @elseif($payment->payment_category === 'cicilan')
                  <!-- Pembayaran tunai cicilan -->
                  <a href="https://wa.me/6285864921179?text=Assalamu'alaikum Asatidz/Asatidzah Deeniyat Al Hidayah, perkenalkan Nama Saya {{ $payment->user->name }}, saya ingin konfirmasi pembayaran pendaftaran tunai secara cicilan, dan untuk cicilan pertama akan dibayarkan sebesar Rp150.000."
                    class="btn btn-warning btn-lg wa-btn"
                    target="_blank">
                    Konfirmasi Cicilan Pertama
                  </a>

                  <p class="mt-3 text-muted" style="font-size: 0.9em;">
                    Anda memilih pembayaran <strong>tunai (cicilan)</strong>. Silakan bayar <strong>cicilan pertama Rp150.000</strong> kepada admin.
                    Sisa <strong>Rp300.000</strong> dapat dibayarkan secara bertahap pada bulan berikutnya.
                  </p>

                  @endif

                  @endif
                </div>
                @endif


              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Midtrans Snap.js -->
  @if($payment->payment_type === 'non-tunai' && isset($snapToken))
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
  <script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
      snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
          window.location.href = "{{ route('payment.thankyoupage') }}";
        },
        onPending: function(result) {
          console.log("Pending:", result);
        },
        onError: function(result) {
          alert("Pembayaran gagal, silakan coba lagi.");
        },
        onClose: function() {
          alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
        }
      });
    };
  </script>
  @endif
  <!-- tunai -->
  @if($payment->payment_type === 'tunai')
  <script>
    document.querySelector(".wa-btn").addEventListener("click", function() {
      // kasih delay biar sempet buka WhatsApp dulu
      setTimeout(function() {
        window.location.href = "{{ route('payment.thankyoupage') }}";
      }, 1500); // delay 1,5 detik
    });
  </script>
  @endif

</body>

</html>