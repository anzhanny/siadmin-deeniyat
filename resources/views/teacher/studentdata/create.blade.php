@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <form id="siswaForm" class="p-4 border rounded shadow-sm bg-light" onsubmit="submitForm(event)" enctype="multipart/form-data">
      
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Siswa</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Ahmad Rizki" required>
      </div>

      <div class="mb-3">
        <label for="nis" class="form-label">NIS</label>
        <input type="text" class="form-control" id="nis" name="nis" required>
      </div>

      <div class="mb-3">
        <label for="no_telp" class="form-label">No Telp</label>
        <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="Contoh: 081234567890" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Contoh: siswa@email.com" required>
      </div>

      <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
      </div>

      <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: XI IPS 1" required>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
          <option value="">-- Pilih Status --</option>
          <option value="Aktif">Aktif</option>
          <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="nama_ayah" class="form-label">Nama Ayah</label>
        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
      </div>

      <div class="mb-3">
        <label for="nama_ibu" class="form-label">Nama Ibu</label>
        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
      </div>

      <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>

    <script>
      function submitForm(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());
        console.log('Data yang disubmit:', data);
        alert("Data berhasil disimpan!");
        event.target.reset();
      }
    </script>
  </div>
</div>
@endsection
