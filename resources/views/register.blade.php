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
    Deeniyat App
  </title>
  <!--     Fonts and icons     -->
  <link href=" https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href=" {{ asset ('assets/css/argon-dashboard.css') }} " rel="stylesheet" >
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center mx-auto">
          <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}" 
          alt="Deeniyat Al Hidayah Logo" style="width: 80px;">
            <h1 class="text-white mb-2 mt-2" style="font-size: 34px;"> Welcome to Deeniyat Al Hidayah!  </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
  <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-12 mx-auto">
      <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5 class="font-weight-bolder">Register</h5>
              <p class="text-lead" style="font-size: 12px;">Silakan isi formulir di bawah ini untuk membuat akun baru di <b>Deeniyat Al Hidayah!</b></p>
            </div>
            <div class="card-body">
              <form action="{{ route('register.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
                @csrf
              <div class="row">
                <!-- Nama Siswa -->
                <div class="col-md-6 mb-3">
                  <label for="name" class="form-label">Nama Siswa <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Siswa" required>
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                  <div class="invalid-feedback">Email tidak valid (harus mengandung @ dan format benar).</div>
                </div>

                <!-- Password -->
                <div class="col-md-6 mb-3">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="col-md-6 mb-3">
                  <label for="birthplace" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Masukkan Tempat Lahir" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="col-md-6 mb-3">
                  <label for="birthdate" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                </div>

                <!-- Jenis Kelamin -->
                <div class="col-md-6 mb-3">
                  <label class="form-label d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="gender" value="Laki-Laki" required>
                    <label class="form-check-label" for="gender_male">Laki-Laki</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female" name="gender" value="Perempuan">
                    <label class="form-check-label" for="gender_female">Perempuan</label>
                  </div>
                </div>

                <!-- Pendidikan Formal -->
                <div class="col-md-6 mb-3">
                  <label for="formal_education" class="form-label">Pendidikan Formal <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="formal_education" name="formal_education" placeholder="Contoh: SDN 1 Contoh" required>
                </div>

                <!-- NIS -->
                <div class="col-md-6 mb-3">
                  <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
                </div>

                <!-- No Telp -->
                <div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">No Telp <span class="text-danger">*</span></label>
                  <input type="integer" class="form-control" id="phone" name="phone" placeholder="Masukkan No Telp" required>
                </div>

                <!-- Alamat -->
                <div class="col-md-6 mb-3">
                  <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan Alamat" required>
                </div>

                <!-- Kelas -->
                <div class="col-md-6 mb-3">
                  <label for="class_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                  <select class="form-select" id="class_id" name="class_id" required>
                    <option value="">Pilih Kelas</option>
                    <option value="0">Kelas 0</option>
                    <option value="1">Kelas 1</option>
                    <option value="2">Kelas 2</option>
                    <option value="3">Kelas 3</option>
                    <option value="4">Kelas 4</option>
                    <option value="5">Kelas 5</option>
                    <option value="6">Kelas 6</option>
                  </select>
                </div>

                <!-- Status Aktif -->
                <div class="col-md-6 mb-3">
                  <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                  <select class="form-select" id="is_active" name="is_active" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                  </select>
                </div>

                <!-- Nama Ayah -->
                <div class="col-md-6 mb-3">
                  <label for="father_name" class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Masukkan Nama Ayah" required>
                </div>

                <!-- Pekerjaan Ayah -->
                <div class="col-md-6 mb-3">
                  <label for="father_job" class="form-label">Pekerjaan Ayah</label>
                  <input type="text" class="form-control" id="father_job" name="father_job" placeholder="Masukkan Pekerjaan Ayah">
                </div>

                <!-- Nama Ibu -->
                <div class="col-md-6 mb-3">
                  <label for="mother_name" class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Masukkan Nama Ibu" required>
                </div>

                <!-- Pekerjaan Ibu -->
                <div class="col-md-6 mb-3">
                  <label for="mother_job" class="form-label">Pekerjaan Ibu</label>
                  <input type="text" class="form-control" id="mother_job" name="mother_job" placeholder="Masukkan Pekerjaan Ibu">
                </div>

                <!-- Foto -->
                <div class="col-md-6 mb-3">
                  <label for="photo" class="form-label">Foto</label>
                  <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                </div>
              </div>


                <div class="text-end mt-4">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
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
                Deeniyat Al Hidayah.<i class="fa fa-heart"></i> All Rights Reserved.
                <!-- <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a> -->
                <!-- for a better web. -->

        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src=" {{ asset ('assets/js/core/popper.min.js') }} "></script>
  <script src=" {{ asset ('/assets/js/core/bootstrap.min.js') }} "></script>
  <script src=" {{ asset ('/assets/js/plugins/perfect-scrollbar.min.js') }} "></script>
  <script src=" {{ asset ('/assets/js/plugins/smooth-scrollbar.min.js') }} "></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>