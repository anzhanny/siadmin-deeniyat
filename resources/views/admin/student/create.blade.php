@extends('layouts.layout')
@section('content')
<style>
  .password-toggle {
    position: absolute;
    right: 1.5rem;
    top: 70%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #9a9fa3;
  }

  @media (max-width: 576px) {
    .password-toggle {
      right: 1rem;
      top: 70%;
      font-size: 1rem;
    }
  }

          .form-check-input:checked {
            background-color: #5e72e4;
            border-color: #5e72e4;
          }

          .form-check-label {
            font-weight: 500;
            color: #344767;
          }

          .form-check-inline {
            margin-right: 15px;
          }

</style>

<div class="row">
  <div class="col-12">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data"
      class="p-4 border rounded shadow-sm bg-light needs-validation" novalidate>
      @csrf
      <div class="row">
        <!-- Nama Siswa -->
        <div class="col-md-6 mb-3">
          <label for="name" class="form-label">Nama Siswa <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- NIS otomatis -->
        <div class="col-md-6 mb-3">
          <label for="nis" class="form-label">NIS</label>
          <input type="text" class="form-control text-danger small fst-italic" style="outline: none;"
            id="nis" value="*Akan diisi otomatis oleh sistem" readonly disabled>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email
            <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="email" name="email" required>
          <div class="invalid-feedback">Email tidak valid (harus mengandung @ dan format benar).</div>
        </div>

        <!-- Password -->
        <div class="col-md-6 mb-3 position-relative">
          <label for="password" class="form-label">
            Password <span class="text-danger">*</span>
          </label>
          <input type="password" class="form-control pe-5" id="password" name="password" required>
          <span class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
            <i id="toggleIcon1" class="fas fa-eye"></i>
          </span>
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

        <!-- Pendidikan Formal -->
        <div class="col-md-6 mb-3">
          <label for="grade" class="form-label">Kelas Pendidikan Formal Sebelumnya
            <span class="text-danger">*</span>
          </label>
          <select class="form-select" id="grade" name="grade" required>
            <option value="">Pilih Tingkat</option>
            <option value="0">TK</option>
            <option value="1">Kelas 1 SD</option>
            <option value="2">Kelas 2 SD</option>
            <option value="3">Kelas 3 SD</option>
            <option value="4">Kelas 4 SD</option>
            <option value="5">Kelas 5 SD</option>
            <option value="6">Kelas 6 SD</option>
          </select>
        </div>





        <!-- Alamat -->
        <div class="col-md-6 mb-3">
          <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <!-- Tempat Lahir -->
        <div class="col-md-6 mb-3">
          <label for="birthplace" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="birthplace" name="birthplace" required>
        </div>

        <!-- Tanggal Lahir -->
        <div class="col-md-6 mb-3">
          <label for="birthdate" class="form-label">Tanggal Lahir
            <span class="text-danger">*</span></label>
          <input type="date" class="form-control" id="birthdate" name="birthdate" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="col-md-6 mb-3">
          <label class="form-label d-block">Jenis Kelamin <span class="text-danger">*</span></label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="genderL" value="Laki-laki" required>
            <label class="form-check-label" for="genderL">Laki-laki</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="genderP" value="Perempuan" required>
            <label class="form-check-label" for="genderP">Perempuan</label>
          </div>
          @error('gender')
          <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <!-- Ayah/Ibu -->
        <div class="col-md-6 mb-3">
          <label for="father_name" class="form-label">Nama Ayah<span class="text-danger">*</span> </label>
          <input type="text" class="form-control" id="father_name" name="father_name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="father_job" class="form-label">Pekerjaan Ayah</label>
          <input type="text" class="form-control" id="father_job" name="father_job">
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_name" class="form-label">Nama Ibu <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="mother_name" name="mother_name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_job" class="form-label">Pekerjaan Ibu</label>
          <input type="text" class="form-control" id="mother_job" name="mother_job">
        </div>

        <!-- Foto -->
        <div class="col-md-6 mb-3">
          <label for="photo" class="form-label">Foto</label>
          <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        </div>


        {{-- === Data Pembayaran === --}}
        <h5 class="mt-4 mb-3">Pilih Pembayaran</h5>

        <div class="row">
          {{-- === Tipe Pembayaran === --}}
          <div class="col-md-6 mb-3" >
            <label class="form-label d-block mb-2">Tipe Pembayaran</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="payment_type" id="type_tunai" value="tunai"
                {{ old('payment_type') == 'tunai' ? 'checked' : '' }} required>
              <label class="form-check-label" for="type_tunai">Tunai</label>
            </div>
            <div class="form-check form-check-inline" hidden>
              <input class="form-check-input" type="radio" name="payment_type" id="type_non_tunai" value="non-tunai"
                {{ old('payment_type') == 'non-tunai' ? 'checked' : '' }} required>
              <label class="form-check-label" for="type_non_tunai">Non-Tunai</label>
            </div>
          </div>

          {{-- === Kategori Pembayaran === --}}
          <div class="col-md-6 mb-3">
            <label class="form-label d-block mb-2">Kategori Pembayaran</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="payment_category" id="category_lunas" value="lunas"
                {{ old('payment_category') == 'lunas' ? 'checked' : '' }} required>
              <label class="form-check-label" for="category_lunas">Lunas</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="payment_category" id="category_cicilan" value="cicilan"
                {{ old('payment_category') == 'cicilan' ? 'checked' : '' }} required>
              <label class="form-check-label" for="category_cicilan">Cicilan</label>
            </div>
          </div>
        </div>

        

        <div class="col-md-6 mb-3">
          <label for="amount" class="form-label">Nominal Pembayaran</label>
          <input type="number" name="amount" id="amount" class="form-control"
            value="{{ old('amount') }}" placeholder="Masukkan nominal" required>
        </div>



        <!-- Button Simpan & Kembali -->
        <div class="text-end mt-4">
          <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>

<script>
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
<script>
  function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>

@endsection