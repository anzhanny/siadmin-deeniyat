@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
            <form id="SppForm" class="p-4 border rounded shadow-sm bg-light" onsubmit="submitForm(event)">
                <div class="mb-3">
                    <label for="Student" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="Student" name="kelas" placeholder="Nama" required>
                </div>

                <div class="mb-3">
                    <label for="waliKelas" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="waliKelas" name="waliKelas" placeholder="NIS" required>
                </div>
                <div class="mb-3">
                    <label for="Student" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="Student" name="kelas" placeholder="Kelas" required>
                </div>

                <div class="mb-3">
                    <label for="jumlahStudent" class="form-label">Tanggal Bayar</label>
                    <input type="date" class="form-control" id="jumlahStudent" name="jumlahStudent" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif">Selsai</option>
                    <option value="Nonaktif">Menunggu Konfirmasi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Bukti Pembayaran</label>
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