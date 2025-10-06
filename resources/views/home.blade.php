<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Deeniyat Al Hidayah</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/deeniyat-logo.png') }}">

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- CSS Argon -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
</head>

<body>

  <!-- Hero -->
  <section class="bg-gradient-primary pb-7 pt-5 pt-md-8 text-center text-white">
    <div class="container">
      <h1>Madrasah Deeniyat <br><span>Al-Hidayah</span></h1>
      <p class="mt-3">Jl. Cikuda No.49, Pasir Biru, Kec. Cibiru, Kota Bandung</p>
      <a href="#about" class="btn btn-secondary btn-lg mt-3">Jelajahi</a>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none">
        <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>

  <!-- Tentang -->
  <section id="about" class="py-6 bg-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="{{ asset('assets/img/about2.jpg') }}" class="img-fluid rounded shadow" alt="">
        </div>
        <div class="col-md-6">
          <h2 class="mb-3">Madrasah Deeniyat Al-Hidayah</h2>
          <h5>Satu Jam Membangun Karakter Islami</h5>
          <p>Deeniyat adalah program intensif pendidikan agama dan pembinaan karakter untuk anak, remaja, dan dewasa.</p>
          <ul class="list-unstyled">
            <li><i class="fas fa-check text-success"></i> Madrasah</li>
            <li><i class="fas fa-check text-success"></i> Privat Class</li>
            <li><i class="fas fa-check text-success"></i> Ekstra Kulikuler</li>
            <li><i class="fas fa-check text-success"></i> Muatan Lokal</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Program -->
  <section id="program" class="py-6 bg-light text-center">
    <div class="container">
      <h2 class="mb-4">Program Pembelajaran</h2>
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="card shadow border-0 p-4">
            <i class="fas fa-book fa-2x text-primary mb-3"></i>
            <h5>Al-Qur'an</h5>
            <p>Kitab Qaidah Nuraniyah dengan metode Tahajji Nurul Bayan dan hafalan surat.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow border-0 p-4">
            <i class="fas fa-mosque fa-2x text-success mb-3"></i>
            <h5>Hadits</h5>
            <p>Hafalan hadits, doa, dan adab sehari-hari.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow border-0 p-4">
            <i class="fas fa-chalkboard-teacher fa-2x text-warning mb-3"></i>
            <h5>Aqidah & Fiqih</h5>
            <p>Sholat, Asmaul Husna, dan fiqih dasar.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Dokumentasi -->
  <section id="dokumentasi" class="py-6 text-center">
    <div class="container">
      <h2 class="mb-4">Dokumentasi Kegiatan</h2>
      <div class="row">
        <div class="col-md-4 mb-3">
          <img src="{{ asset('assets/img/portfolio/pk-1.jpeg') }}" class="img-fluid rounded shadow">
          <p class="mt-2">Kegiatan Belajar Kelas 0</p>
        </div>
        <div class="col-md-4 mb-3">
          <img src="{{ asset('assets/img/portfolio/p-2.jpg') }}" class="img-fluid rounded shadow">
          <p class="mt-2">Penyerahan Hadiah</p>
        </div>
        <div class="col-md-4 mb-3">
          <img src="{{ asset('assets/img/portfolio/p-3.jpg') }}" class="img-fluid rounded shadow">
          <p class="mt-2">Foto Kelas 6</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Guru -->
  <section id="guru" class="py-6 bg-gradient-info text-white text-center">
    <div class="container">
      <h2 class="mb-4">Para Pengajar</h2>
      <div class="row">
        <div class="col-md-4">
          <img src="{{ asset('assets/img/team/ustadz.jpg') }}" class="rounded-circle shadow mb-3" width="120">
          <h5>Ustadz Didiek Tajul Arifin</h5>
          <p>Kepala Madrasah</p>
        </div>
        <div class="col-md-4">
          <img src="{{ asset('assets/img/team/guru/11.png') }}" class="rounded-circle shadow mb-3" width="120">
          <h5>Umi Uwais</h5>
          <p>Pengajar & Bendahara</p>
        </div>
        <div class="col-md-4">
          <img src="{{ asset('assets/img/team/guru/5.png') }}" class="rounded-circle shadow mb-3" width="120">
          <h5>Ummah Rif'at</h5>
          <p>Pengajar & Sekretaris</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="contact" class="py-6 bg-light text-center">
    <div class="container">
      <h2 class="mb-4">Kontak Kami</h2>
      <p><i class="fas fa-map-marker-alt text-danger"></i> Jl. Cikuda No.49, Pasir Biru, Cibiru, Bandung</p>
      <p><i class="fas fa-envelope text-primary"></i> DeeniyatAlhidayah@gmail.com</p>
      <p><i class="fas fa-phone text-success"></i> +62 896-6611-1700 (Ust. Didiek)</p>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-6 bg-gradient-warning text-center text-white">
    <div class="container">
      <h3>Siap Bergabung?</h3>
      <p class="mb-4">Daftar sekarang dan jadilah bagian dari Madrasah Unggulan.</p>
      <a href="{{ route('register') }}" class="btn btn-dark btn-lg">Daftar Sekarang</a>

      <!-- sudah punya akun? -->
      <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}" class="text-white font-weight-bold">Masuk di sini</a></p>
    </div>
  </section>

  <!-- Core JS -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
</body>
</html>
