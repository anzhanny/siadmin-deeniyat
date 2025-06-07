@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
            <form id="kelasForm" class="p-4 border rounded shadow-sm bg-light" onsubmit="submitForm(event)">
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: X IPA 1" required>
                </div>

                <div class="mb-3">
                    <label for="waliKelas" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="waliKelas" name="waliKelas" placeholder="Nama wali kelas" required>
                </div>

                <div class="mb-3">
                    <label for="jumlahSiswa" class="form-label">Jumlah Siswa</label>
                    <input type="number" class="form-control" id="jumlahSiswa" name="jumlahSiswa" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="tahunAjaran" class="form-label">Tahun Ajaran</label>
                    <input type="text" class="form-control" id="tahunAjaran" name="tahunAjaran" placeholder="Contoh: 2024/2025" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Tidak Aktif</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

            <script>
            function submitForm(event) {
                event.preventDefault();
                // Ambil data dari form dan proses sesuai kebutuhan
                const formData = new FormData(event.target);
                const data = Object.fromEntries(formData.entries());
                console.log('Data yang disubmit:', data);
                // Tambahkan logika pengiriman ke backend atau update tabel di sini
                alert("Data berhasil disimpan!");
                event.target.reset();
            }
            </script>

        </div>
      </div>
      @endsection