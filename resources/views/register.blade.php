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
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center mx-auto">
            <img src="{{ asset('assets/img/logos/deeniyat-logo.png') }}"
              alt="Deeniyat Al Hidayah Logo" style="width: 80px;">
            <h3 class="text-white mb-2 mt-2">Welcome to Deeniyat Al Hidayah!</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
          <div class="card z-index-0 border shadow-sm">
            <div class="card-header text-center pt-4 bg-transparent border-0">
              <h4 class="font-weight-bolder">Register</h4>
              <p class="text-lead" style="font-size: 14px;">Silakan isi formulir di bawah ini untuk membuat akun baru di <b>Deeniyat Al Hidayah!</b></p>
            </div>
            <div class="card-body">
              <form action="{{ route('register.store') }}" method="POST" class="p-0" id="registerForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <!-- Nama Siswa -->
                  <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Siswa <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>

                  <!-- Email -->
                  <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">Email tidak valid (harus mengandung @ dan format benar).</div>
                  </div>

                  <!-- Password -->
                  <div class="col-md-6 mb-3 position-relative">
                    <label for="password" class="form-label">
                      Password <span class="text-danger">*</span>
                    </label>
                    <input id="password" name="password" type="password"
                      class="form-control form-control-lg pe-5"
                      aria-label="Password"
                      value="{{ old('password') }}">
                    <span class="password-toggle"
                      onclick="togglePassword('password', 'toggleIcon1')">
                      <i id="toggleIcon1" class="fas fa-eye"></i>
                    </span>
                  </div>

                  <div class="col-md-6 mb-3 position-relative">
                    <label for="password_confirmation" class="form-label">
                      Konfirmasi Password <span class="text-danger">*</span>
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                      class="form-control form-control-lg pe-5"
                      aria-label="Konfirmasi Password"
                      value="{{ old('password_confirmation') }}">
                    <span class="password-toggle"
                      onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                      <i id="toggleIcon2" class="fas fa-eye"></i>
                    </span>
                  </div>



                  <!-- Tempat Lahir -->
                  <div class="col-md-6 mb-3">
                    <label for="birthplace" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="birthplace" name="birthplace" required>
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
                    <label for="formal_education" class="form-label">Kelas Pendidikan Formal<span class="text-danger">*</span></label>
                    <select class="form-select" id="class_id" name="class_id" required>
                      <option value="">Pilih Kelas</option>
                      <option value="0">Kelas TK</option>
                      <option value="1">Kelas 1</option>
                      <option value="2">Kelas 2</option>
                      <option value="3">Kelas 3</option>
                      <option value="4">Kelas 4</option>
                      <option value="5">Kelas 5</option>
                      <option value="6">Kelas 6</option>
                    </select>
                  </div>

                  <!-- No Telp -->
                  <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">No Telp <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="phone" name="phone" 
                           pattern="[0-9]{10,13}" 
                           placeholder="08123456789" 
                           required>
                    <div class="form-text">
                      <i class="fas fa-info-circle"></i> 
                      Format: 08xxxxxxxxxx (10-13 digit)
                    </div>
                  </div>

                  <!-- Alamat -->
                  <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div>

                  <!-- Nama Ayah -->
                  <div class="col-md-6 mb-3">
                    <label for="father_name" class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="father_name" name="father_name" required>
                  </div>

                  <!-- Pekerjaan Ayah -->
                  <div class="col-md-6 mb-3">
                    <label for="father_job" class="form-label optional">Pekerjaan Ayah</label>
                    <input type="text" class="form-control" id="father_job" name="father_job">
                  </div>

                  <!-- Nama Ibu -->
                  <div class="col-md-6 mb-3">
                    <label for="mother_name" class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                  </div>

                  <!-- Pekerjaan Ibu -->
                  <div class="col-md-6 mb-3">
                    <label for="mother_job" class="form-label optional">Pekerjaan Ibu</label>
                    <input type="text" class="form-control" id="mother_job" name="mother_job">
                  </div>

                  <!-- Foto -->
                  <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label optional">Foto</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <div class="form-text">
                      <i class="fas fa-info-circle"></i> 
                      Format: JPG, PNG, GIF, SVG. Maksimal 2MB.
                    </div>
                  </div>
                </div>

                <div class="text-end mt-2">
                  <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                    Kembali
                  </a>
                  <button type="button" class="btn btn-info me-2" id="previewBtn" onclick="showFormPreview()">
                    <i class="fas fa-eye me-2"></i>Preview Data
                  </button>
                  <button type="submit" class="btn btn-secondary" id="nextBtn" disabled>
                    Lanjutkan
                  </button>
                </div>
                <div class="text-center mt-2">
                  <small class="text-muted">
                    <i class="fas fa-info-circle"></i> 
                    Semua field bertanda <span class="text-danger">*</span> harus diisi untuk melanjutkan
                  </small>
                  <div class="progress mt-2" style="height: 8px;">
                    <div class="progress-bar" id="formProgress" role="progressbar" style="width: 0%"></div>
                  </div>
                  <small class="text-muted mt-1 d-block">
                    <span id="progressText">0%</span> lengkap
                  </small>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="card-footer text-left pt-0 px-lg-4 px-1 pt-4">
        <p class="mb-4 text-sm mx-auto">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Login</a>
        </p>
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
  <script>
    function togglePassword(inputId, iconId) {
      const passwordInput = document.getElementById(inputId);
      const toggleIcon = document.getElementById(iconId);

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }

    // Validasi konfirmasi password real-time
    const pass = document.getElementById('password');
    const passConfirm = document.getElementById('password_confirmation');
    const nextBtn = document.getElementById('nextBtn');

    function validatePasswords() {
      if (passConfirm.value.trim() && pass.value !== passConfirm.value) {
        passConfirm.classList.add('is-invalid');
        passConfirm.classList.remove('is-valid');
      } else if (passConfirm.value.trim() && pass.value === passConfirm.value) {
        passConfirm.classList.remove('is-invalid');
        passConfirm.classList.add('is-valid');
      } else {
        passConfirm.classList.remove('is-invalid');
        passConfirm.classList.remove('is-valid');
      }
      
      // Periksa lagi semua field required
      validateForm();
    }

    // Ambil semua elemen form yang required
    const form = document.getElementById('registerForm');
    const requiredFields = form.querySelectorAll('[required]');
    
    // Get all form fields for validation
    const allFields = form.querySelectorAll('input, select, textarea');

    function validateForm() {
      let allValid = true;
      let missingFields = [];

      // Validate required fields
      requiredFields.forEach(field => {
        if (field.type === 'radio') {
          // Check radio group
          const radioGroup = form.querySelectorAll(`[name="${field.name}"]`);
          const oneChecked = Array.from(radioGroup).some(r => r.checked);
          if (!oneChecked) {
            allValid = false;
            missingFields.push(field.name);
          }
        } else if (field.type === 'file') {
          // File fields are optional, so skip validation
        } else if (field.type === 'select-one') {
          // Check select fields
          if (!field.value || field.value === '') {
            allValid = false;
            missingFields.push(field.name);
          }
        } else if (field.name === 'phone') {
          // Special validation for phone number
          const phoneValue = field.value.trim();
          if (!phoneValue) {
            allValid = false;
            missingFields.push(field.name);
          } else if (!/^08[0-9]{8,11}$/.test(phoneValue)) {
            allValid = false;
            missingFields.push(field.name);
            field.classList.add('is-invalid');
          } else {
            field.classList.remove('is-invalid');
          }
        } else {
          // Check text, email, number, date fields
          if (!field.value.trim()) {
            allValid = false;
            missingFields.push(field.name);
          }
        }
      });

      // Check password confirmation
      if (pass.value !== passConfirm.value) {
        allValid = false;
        missingFields.push('password_confirmation');
      }

      // Debug logging
      console.log('Form validation result:', allValid);
      console.log('Password match:', pass.value === passConfirm.value);
      console.log('Missing fields:', missingFields);
      
      nextBtn.disabled = !allValid;
      
      // Update button appearance
      if (allValid) {
        nextBtn.classList.remove('btn-secondary');
        nextBtn.classList.add('btn-primary');
        console.log('✅ Form is valid - button enabled');
      } else {
        nextBtn.classList.remove('btn-primary');
        nextBtn.classList.add('btn-secondary');
        console.log('❌ Form is invalid - button disabled');
      }
      
      // Update progress bar
      updateFormProgress();
    }

    // Function to show form preview
    function showFormPreview() {
      const formData = new FormData(form);
      let previewHTML = '<div class="modal fade" id="previewModal" tabindex="-1">';
      previewHTML += '<div class="modal-dialog modal-lg">';
      previewHTML += '<div class="modal-content">';
      previewHTML += '<div class="modal-header">';
      previewHTML += '<h5 class="modal-title">Preview Data Pendaftaran</h5>';
      previewHTML += '<button type="button" class="btn-close" data-bs-dismiss="modal"></button>';
      previewHTML += '</div>';
      previewHTML += '<div class="modal-body">';
      previewHTML += '<div class="row">';
      
      // Student data
      previewHTML += '<div class="col-md-6">';
      previewHTML += '<h6 class="text-primary">Data Siswa</h6>';
      previewHTML += '<p><strong>Nama:</strong> ' + (formData.get('name') || '-') + '</p>';
      previewHTML += '<p><strong>Email:</strong> ' + (formData.get('email') || '-') + '</p>';
      previewHTML += '<p><strong>Tempat Lahir:</strong> ' + (formData.get('birthplace') || '-') + '</p>';
      previewHTML += '<p><strong>Tanggal Lahir:</strong> ' + (formData.get('birthdate') || '-') + '</p>';
      previewHTML += '<p><strong>Jenis Kelamin:</strong> ' + (formData.get('gender') || '-') + '</p>';
      previewHTML += '<p><strong>Kelas:</strong> ' + (document.getElementById('class_id').options[document.getElementById('class_id').selectedIndex].text || '-') + '</p>';
      previewHTML += '<p><strong>No Telp:</strong> ' + (formData.get('phone') || '-') + '</p>';
      previewHTML += '<p><strong>Alamat:</strong> ' + (formData.get('address') || '-') + '</p>';
      previewHTML += '</div>';
      
      // Parent data
      previewHTML += '<div class="col-md-6">';
      previewHTML += '<h6 class="text-primary">Data Orang Tua</h6>';
      previewHTML += '<p><strong>Nama Ayah:</strong> ' + (formData.get('father_name') || '-') + '</p>';
      previewHTML += '<p><strong>Pekerjaan Ayah:</strong> ' + (formData.get('father_job') || '-') + '</p>';
      previewHTML += '<p><strong>Nama Ibu:</strong> ' + (formData.get('mother_name') || '-') + '</p>';
      previewHTML += '<p><strong>Pekerjaan Ibu:</strong> ' + (formData.get('mother_job') || '-') + '</p>';
      previewHTML += '<p><strong>Foto:</strong> ' + (document.getElementById('photo').files[0] ? document.getElementById('photo').files[0].name : 'Tidak ada foto') + '</p>';
      previewHTML += '</div>';
      
      previewHTML += '</div>';
      previewHTML += '</div>';
      previewHTML += '<div class="modal-footer">';
      previewHTML += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
      previewHTML += '</div>';
      previewHTML += '</div>';
      previewHTML += '</div>';
      previewHTML += '</div>';
      
      // Remove existing modal if any
      const existingModal = document.getElementById('previewModal');
      if (existingModal) {
        existingModal.remove();
      }
      
      // Add modal to body
      document.body.insertAdjacentHTML('beforeend', previewHTML);
      
      // Show modal
      const modal = new bootstrap.Modal(document.getElementById('previewModal'));
      modal.show();
    }

    // Function to update form completion progress
    function updateFormProgress() {
      const totalRequiredFields = requiredFields.length;
      let completedFields = 0;
      
      requiredFields.forEach(field => {
        if (field.type === 'radio') {
          const radioGroup = form.querySelectorAll(`[name="${field.name}"]`);
          const oneChecked = Array.from(radioGroup).some(r => r.checked);
          if (oneChecked) completedFields++;
        } else if (field.type === 'select-one') {
          if (field.value && field.value !== '') completedFields++;
        } else {
          if (field.value.trim()) completedFields++;
        }
      });
      
      // Check password confirmation
      if (pass.value === passConfirm.value && pass.value.trim()) {
        completedFields++;
      }
      
      const progressPercentage = Math.round((completedFields / (totalRequiredFields + 1)) * 100);
      
      // Update progress bar
      const progressBar = document.getElementById('formProgress');
      const progressText = document.getElementById('progressText');
      
      if (progressBar && progressText) {
        progressBar.style.width = progressPercentage + '%';
        progressBar.setAttribute('aria-valuenow', progressPercentage);
        progressText.textContent = progressPercentage + '%';
        
        // Update progress bar color based on completion
        if (progressPercentage < 50) {
          progressBar.className = 'progress-bar bg-danger';
        } else if (progressPercentage < 100) {
          progressBar.className = 'progress-bar bg-warning';
        } else {
          progressBar.className = 'progress-bar bg-success';
        }
      }
    }

    // Add validation event listeners to all fields
    allFields.forEach(field => {
      if (field.type === 'radio') {
        field.addEventListener('change', function() {
          // Add visual feedback for radio buttons
          const radioGroup = form.querySelectorAll(`[name="${this.name}"]`);
          radioGroup.forEach(radio => {
            if (radio.checked) {
              radio.closest('.form-check').classList.add('is-valid');
              radio.closest('.form-check').classList.remove('is-invalid');
            } else {
              radio.closest('.form-check').classList.remove('is-valid');
              radio.closest('.form-check').classList.remove('is-invalid');
            }
          });
          validateForm();
        });
      } else if (field.type === 'file') {
        field.addEventListener('change', function() {
          // Handle file upload validation
          const file = this.files[0];
          if (file) {
            // Check file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
              this.classList.add('is-invalid');
              this.classList.remove('is-valid');
              alert('Ukuran file terlalu besar. Maksimal 2MB.');
              this.value = '';
            } else {
              // Check file type
              const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
              if (allowedTypes.includes(file.type)) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
              } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                alert('Tipe file tidak didukung. Gunakan JPG, PNG, GIF, atau SVG.');
                this.value = '';
              }
            }
          } else {
            this.classList.remove('is-valid', 'is-invalid');
          }
        });
      } else if (field.type === 'select-one') {
        field.addEventListener('change', function() {
          // Add visual feedback for select fields
          if (this.value && this.value !== '') {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
          } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
          }
          validateForm();
        });
      } else {
        // Handle text, email, number, date fields
        field.addEventListener('input', function() {
          // Add visual feedback
          if (this.value.trim()) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
          } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
          }
          validateForm();
        });
      }
    });

    // Handle form submission
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (!nextBtn.disabled) {
        // Show loading state
        nextBtn.disabled = true;
        nextBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        
        // Validate file upload if present
        const photoInput = document.getElementById('photo');
        if (photoInput.files.length > 0) {
          const file = photoInput.files[0];
          if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            photoInput.classList.add('is-invalid');
            nextBtn.disabled = false;
            nextBtn.innerHTML = 'Lanjutkan';
            return;
          }
        }
        
        // Try AJAX submission first
        fetch(this.action, {
          method: 'POST',
          body: new FormData(this),
          headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            // Show success message before redirect
            nextBtn.innerHTML = '<i class="fas fa-check me-2"></i>Berhasil!';
            nextBtn.classList.remove('btn-primary');
            nextBtn.classList.add('btn-success');
            
            // Redirect to detailpayment page after a short delay
            setTimeout(() => {
              window.location.href = '{{ route("payment.detailpayment") }}';
            }, 1000);
          } else {
            alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
            // Reset button state
            nextBtn.disabled = false;
            nextBtn.innerHTML = 'Lanjutkan';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          console.log('AJAX failed, trying traditional form submission...');
          
          // Fallback to traditional form submission
          alert('Menggunakan metode alternatif untuk mendaftar...');
          this.submit();
        });
      }
    });

    pass.addEventListener('input', validatePasswords);
    passConfirm.addEventListener('input', validatePasswords);

    // Validasi awal saat halaman dimuat
    validateForm();
    
    // Debug: Log form elements
    console.log('Form found:', document.getElementById('registerForm'));
    console.log('Next button found:', document.getElementById('nextBtn'));
    console.log('Required fields found:', requiredFields.length);
    
    // Add click event to next button for debugging
    nextBtn.addEventListener('click', function(e) {
      console.log('Next button clicked');
      console.log('Button disabled:', this.disabled);
      console.log('Form valid:', validateForm());
    });
  </script>


</body>

</html>