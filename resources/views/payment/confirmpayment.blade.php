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
    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card shadow-lg border-0">
            <div class="card-body p-5">

              <h3 class="mb-4">Konfirmasi Pembayaran</h3>

              <!-- Data Siswa -->
              <h5 class="mb-3">Data Siswa</h5>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Nama:</strong> {{ $payment->user->name }}</p>
                  <p><strong>Email:</strong> {{ $payment->user->email }}</p>
                  <p><strong>Telp:</strong> {{ $payment->user->phone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                  <p><strong>Pembayaran Untuk:</strong> {{ ucfirst($payment->payment_for) }}</p>
                  <p><strong>Kategori:</strong> {{ ucfirst($payment->payment_category) }}</p>
                  <p><strong>Tipe:</strong> {{ ucfirst($payment->payment_type) }}</p>
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
                <a href="https://wa.me/6285864921179?text=Halo admin, saya ingin konfirmasi pembayaran ID {{ $payment->id }}"
                  class="btn btn-success btn-lg wa-btn"
                  target="_blank">
                  Konfirmasi via WhatsApp
                </a>

                <p class="mt-3 text-muted" style="font-size: 0.9em;">
                  Klik tombol di atas untuk menghubungi admin via WhatsApp dan konfirmasi pembayaran Anda.
                </p>
              </div>

              @endif

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