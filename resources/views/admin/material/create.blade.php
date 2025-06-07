@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
            <form id="MateriForm" class="p-4 border rounded shadow-sm bg-light" onsubmit="submitForm(event)">
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: X IPA 1" required>
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