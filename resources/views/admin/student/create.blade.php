@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <form action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data"
      class="p-4 border rounded shadow-sm bg-light needs-validation" novalidate>
      @csrf
      <div class="row">
        <!-- Nama Siswa -->
        <div class="col-md-6 mb-3">
          <label for="name" class="form-label">Nama Siswa</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- NIS otomatis -->
        <div class="col-md-6 mb-3">
          <label for="nis" class="form-label">NIS</label>
          <input type="text" class="form-control text-danger small fst-italic"
            id="nis" value="*Akan diisi otomatis oleh sistem" readonly disabled>
        </div>

        <!-- Kelas -->
        <div class="col-md-6 mb-3">
          <select class="form-select" id="class_id" name="class_id" required>
            <option value="">Pilih Kelas</option>
            @foreach ($classes as $class)
            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
              Kelas {{ $class->class_name }}
            </option>
            @endforeach
          </select>

        </div>


        <!-- Email -->
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>

        <!-- Password -->
        <div class="col-md-6 mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- No Telp -->
        <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">No Telp</label>
          <input type="text" class="form-control" id="phone" name="phone">
        </div>

        <!-- Alamat -->
        <div class="col-md-6 mb-3">
          <label for="address" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>

        <!-- Tempat Lahir -->
        <div class="col-md-6 mb-3">
          <label for="birthplace" class="form-label">Tempat Lahir</label>
          <input type="text" class="form-control" id="birthplace" name="birthplace">
        </div>

        <!-- Tanggal Lahir -->
        <div class="col-md-6 mb-3">
          <label for="birthdate" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="birthdate" name="birthdate">
        </div>

        <!-- Jenis Kelamin -->
        <div class="col-md-6 mb-3">
          <label class="form-label d-block">Jenis Kelamin</label>
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
          <label for="father_name" class="form-label">Nama Ayah</label>
          <input type="text" class="form-control" id="father_name" name="father_name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="father_job" class="form-label">Pekerjaan Ayah</label>
          <input type="text" class="form-control" id="father_job" name="father_job">
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_name" class="form-label">Nama Ibu</label>
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
      </div>

      <!-- Button Simpan & Kembali -->
      <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">Kembali</a>
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
@endsection