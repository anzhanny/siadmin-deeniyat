@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <form action="{{ route('admin.student.update', $student->id) }}" enctype="multipart/form-data" method="POST" id="studentForm" class="p-4 border rounded shadow-sm bg-light">
      @csrf
      @method('PUT')
      <div class="row">


        <div class="col-md-6 mb-3">
          <label for="name" class="form-label">Nama Siswa</label>
          <input type="text" value="{{ old('name', $student->name) }}" class="form-control" id="name" name="name" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="nis" class="form-label">NIS</label>      
          <input type="text" value="{{ old('nis', $student->nis) }}"
           class="form-control" style="outline: none;" id="nis" name="nis" readonly disabled>
            <span class="text-danger text-xs fst-italic">*Tidak bisa diedit karena terisi otomatis oleh sistem</span>
        </div>

        <div class="col-md-6 mb-3">
          <label for="grade" class="form-label">Kelas Deeniyat
            <span class="text-danger">*</span>
          </label>
          <select class="form-select" id="grade" name="grade" required>
            @for ($i = 0; $i <= 6; $i++)
              <option value="{{ $i }}" {{ old('grade', $student->grade) == $i ? 'selected' : '' }}>
              {{ $i }}
              </option>
              @endfor
          </select>

        </div>

        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" value="{{ old('email', $student->email) }}" class="form-control" id="email" name="email" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">No Telp</label>
          <input type="number" value="{{ old('phone', $student->phone) }}" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="address" class="form-label">Alamat</label>
          <input type="text" value="{{ old('address', $student->address) }}" class="form-control" id="address" name="address" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
          <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
        </div>

        <div class="col-md-6 mb-3">
          <label for="birthplace" class="form-label">Tempat Lahir</label>
          <input type="text" value="{{ old('birthplace', $student->birthplace) }}" class="form-control" id="birthplace" name="birthplace" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="birthdate" class="form-label">Tanggal Lahir</label>
          <input type="date"
            value="{{ old('birthdate', $student->birthdate ? $student->birthdate->format('Y-m-d') : '') }}"
            class="form-control"
            id="birthdate"
            name="birthdate"
            required>
        </div>


        <div class="col-md-6 mb-3">
          <label class="form-label d-block">Jenis Kelamin</label>
          <div class="form-check form-check-inline">
<input class="form-check-input" type="radio" id="gender_male" name="gender"
  value="Laki-Laki"
  {{ old('gender', strtolower($student->gender)) == 'laki-laki' ? 'checked' : '' }} required>            
  <label class="form-check-label" for="gender_male">Laki-Laki</label>
          </div>
          <div class="form-check form-check-inline">
<input class="form-check-input" type="radio" id="gender_female" name="gender"
  value="Perempuan"
  {{ old('gender', strtolower($student->gender)) == 'perempuan' ? 'checked' : '' }}>
              <label class="form-check-label" for="gender_female">Perempuan</label>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="father_name" class="form-label">Nama Ayah</label>
          <input type="text" value="{{ old('father_name', $student->father_name) }}" class="form-control" id="father_name" name="father_name" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="father_job" class="form-label">Pekerjaan Ayah</label>
          <input type="text" value="{{ old('father_job', $student->father_job) }}" class="form-control" id="father_job" name="father_job">
        </div>

        <div class="col-md-6 mb-3">
          <label for="mother_name" class="form-label">Nama Ibu</label>
          <input type="text" value="{{ old('mother_name', $student->mother_name) }}" class="form-control" id="mother_name" name="mother_name" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="mother_job" class="form-label">Pekerjaan Ibu</label>
          <input type="text" value="{{ old('mother_job', $student->mother_job) }}" class="form-control" id="mother_job" name="mother_job">
        </div>

        <div class="col-md-6 mb-3">
          <label for="photo" class="form-label">Foto</label>
          <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
          @if ($student->photo)
          <img src="{{ asset('storage/'.$student->photo) }}" alt="Foto Siswa" class="mt-2" style="max-height: 100px;">
          @endif
        </div>
      </div>

      <div class="col-md-6 mb-3">
        <label for="is_active" class="form-label">Status</label>
        <select class="form-select" id="is_active" name="is_active" required>
          <option value="">-- Pilih Status --</option>
          <option value="1" {{ old('is_active', $student->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
          <option value="0" {{ old('is_active', $student->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
      </div>

      <div class="text-end mt-4">
        <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
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