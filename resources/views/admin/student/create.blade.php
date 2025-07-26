@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <form action="{{ route('admin.student.store') }}" method="POST" id="studentForm" class="p-4 border rounded shadow-sm bg-light">
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

<script>
  (() => {
    'use strict';

    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        // Cek validasi
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>

@endsection
