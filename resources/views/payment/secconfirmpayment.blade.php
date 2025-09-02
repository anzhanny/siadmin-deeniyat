<!-- resources/views/payment/confirmpayment.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">
  <title>Konfirmasi Pembayaran - Deeniyat App</title>
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
    <!-- Header -->
    <div class="page-header align-items-start min-vh-50 pt-5 pb-9 m-3 border-radius-lg"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container text-center">
        <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" alt="Logo" style="width: 80px; margin-bottom: 35px;">
      </div>
    </div>

    <!-- Content -->
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12 mx-auto">

                     <form action="/" method="POST">
             @csrf
             <input type="hidden" name="user_id" value="{{ $payment->user_id }}">
             <input type="hidden" name="class_id" value="{{ $payment->class_id }}">

            <!-- Card: Data Siswa -->
            <div class="card z-index-0 mb-4">
              <div class="card-header pt-4">
                <h5 class="font-weight-bolder text-center">Data Siswa</h5>
              </div>
              <div class="card-body">
                                 <div class="row">
                   <div class="col-md-6 mb-3"><strong>Nama Calon Siswa</strong><br>{{ $payment->user->name }}</div>
                   <div class="col-md-6 mb-3"><strong>Email</strong><br>{{ $payment->user->email }}</div>
                   <div class="col-md-6 mb-3"><strong>Alamat</strong><br>{{ $payment->user->address }}</div>
                   <div class="col-md-6 mb-3"><strong>No Telp</strong><br>{{ $payment->user->phone }}</div>
                   <div class="col-md-6 mb-3"><strong>Tempat, Tanggal Lahir</strong><br>{{ $payment->user->birthplace }}, {{ $payment->user->birthdate }}</div>
                   <div class="col-md-6 mb-3"><strong>Jenis Kelamin</strong><br>{{ $payment->user->gender }}</div>
                   <div class="col-md-6 mb-3"><strong>Nama Ayah</strong><br>{{ $payment->user->father_name }}</div>
                   <div class="col-md-6 mb-3"><strong>Nama Ibu</strong><br>{{ $payment->user->mother_name }}</div>
                   <div class="col-md-6 mb-3"><strong>Kelas Pendidikan Formal</strong><br>{{ $payment->user->class->class_name ?? 'N/A' }}</div>
                 </div>
              </div>
            </div>

            <!-- Card: Detail Pembayaran -->
            <div class="card z-index-0 mb-4">
              <div class="card-header pt-4">
                <h5 class="font-weight-bolder text-center">Detail Pembayaran</h5>
              </div>
              <div class="card-body">
                <div class="p-4 bg-light rounded">
                  <div class="d-flex justify-content-between mb-2">
                    <strong>Total Biaya</strong>
                    <span class="fw-bold text-primary">: Rp{{ number_format($payment->total_amount,0,',','.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <strong>Tipe Pembayaran</strong>
                    <span>: {{ ucfirst($payment->payment_type) }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <strong>Metode Pembayaran</strong>
                    <span>: {{ ucfirst($payment->payment_method) }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <strong>Jumlah Cicilan</strong>
                    <span>: {{ $payment->installment_count }}x</span>
                  </div>
                  
                  @if($payment->payment_method === 'installment' && $payment->installments->count() > 0)
                  <hr class="horizontal dark my-3">
                  <h6 class="text-primary mb-3">Detail Cicilan:</h6>
                  <div class="row">
                    @foreach($payment->installments as $installment)
                    <div class="col-md-{{ 12 / min($payment->installment_count, 4) }} mb-2">
                      <div class="text-center p-3 bg-white rounded border">
                        <h6 class="{{ $installment->installments_to == 1 ? 'text-success' : ($installment->installments_to == $payment->installment_count ? 'text-info' : 'text-warning') }}">
                          Cicilan {{ $installment->installments_to }}
                        </h6>
                        <p class="mb-1">Rp{{ number_format($installment->nominal, 0, ',', '.') }}</p>
                        <small class="text-muted">
                          @if($installment->installments_to == 1)
                            Tanggal Pendaftaran
                          @else
                            Bulan ke-{{ $installment->installments_to }}
                          @endif
                        </small>
                        @if($installment->paid_at)
                          <br><small class="text-success">✓ Dibayar</small>
                        @endif
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endif
                  
                  <hr class="horizontal dark my-3">
                  <small class="text-muted">
                    Catatan: 
                    @if($payment->payment_method === 'full')
                      Karena Anda memilih pembayaran lunas, setelah ini Anda akan diarahkan ke WhatsApp Admin untuk konfirmasi pembayaran.
                    @else
                      Silakan selesaikan pembayaran sesuai jadwal cicilan yang telah ditentukan.
                    @endif
                  </small>
                </div>
              </div>
            </div>

            <!-- Warning -->
            <div class="alert alert-warning" role="alert">
              <i class="fas fa-exclamation-triangle"></i>
              Pastikan semua data siswa dan pilihan pembayaran sudah benar sebelum konfirmasi.
              Jika ada kesalahan, segera hubungi admin sekolah.
            </div>

            <!-- Checkbox konfirmasi -->
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="checkConfirm" required>
              <label class="form-check-label fw-bold text-success" for="checkConfirm">
                Saya sudah memeriksa dan memastikan data siswa serta pilihan pembayaran sudah benar.
              </label>
            </div>

            <!-- Button Action -->
            <div class="d-flex justify-content-end mb-5">
              <button type="submit" class="btn btn-primary" id="confirmBtn" disabled>
                Lanjutkan ke Pembayaran ➡
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
          © <script>document.write(new Date().getFullYear())</script>,
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
    const checkConfirm = document.getElementById('checkConfirm');
    const confirmBtn = document.getElementById('confirmBtn');

    checkConfirm.addEventListener('change', () => {
      confirmBtn.disabled = !checkConfirm.checked;
    });
  </script>
</body>

</html>
