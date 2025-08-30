@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <form action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data" id="studentForm" class="p-4 border rounded shadow-sm bg-light"> 
      @csrf

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="name" class="form-label">Nama Siswa </span></label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="nis" class="form-label">NIS </span></label>
          <input type="text" class="form-control" id="nis" name="nis" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="class_id" class="form-label">Kelas Di Terima</span></label>
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

        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</span></label>
          <input type="email" class="form-control" id="email" name="email" required>
          <div class="invalid-feedback">Email tidak valid (harus mengandung @ dan format benar).</div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">No Telp</span></label>
          <input type="number" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="address" class="form-label">Alamat</span></label>
          <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="password" class="form-label">Password </span></label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="birthplace" class="form-label">Tempat Lahir </span></label>
          <input type="text" class="form-control" id="birthplace" name="birthplace" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="birthdate" class="form-label">Tanggal Lahir </span></label>
          <input type="date" class="form-control" id="birthdate" name="birthdate" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label d-block">Jenis Kelamin </span></label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="gender_male" name="gender" value="Laki-Laki" required>
            <label class="form-check-label" for="gender_male">Laki-Laki</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="gender_female" name="gender" value="Perempuan">
            <label class="form-check-label" for="gender_female">Perempuan</label>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="formal_education" class="form-label">Kelas Pendidikan Formal</span></label>
          <select class="form-select" id="formal_education" name="formal_education" required>
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

        <div class="col-md-6 mb-3">
          <label for="father_name" class="form-label">Nama Ayah </span></label>
          <input type="text" class="form-control" id="father_name" name="father_name" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="father_job" class="form-label">Pekerjaan Ayah</label>
          <input type="text" class="form-control" id="father_job" name="father_job">
        </div>

        <div class="col-md-6 mb-3">
          <label for="mother_name" class="form-label">Nama Ibu </span></label>
          <input type="text" class="form-control" id="mother_name" name="mother_name" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="mother_job" class="form-label">Pekerjaan Ibu</label>
          <input type="text" class="form-control" id="mother_job" name="mother_job">
        </div>


        <div class="col-md-6 mb-3">
          <label for="photo" class="form-label">Foto</label>
          <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        </div>
      </div>


      <div class="col-md-6 mb-3">
        <label for="is_active" class="form-label">Status </span></label>
        <select class="form-select" id="is_active" name="is_active" required>
          <option value="">-- Pilih Status --</option>
          <option value="1">Aktif</option>
          <option value="0">Tidak Aktif</option>
        </select>
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