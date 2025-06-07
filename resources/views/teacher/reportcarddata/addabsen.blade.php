@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
    <form action="/submit-nilai-absensi" method="POST">
  <!-- Data Siswa -->
  <label for="nama_siswa">Nama Siswa:</label><br>
  <input type="text" id="nama_siswa" name="nama_siswa" required><br><br>

  <!-- Pilih Pelajaran -->
  <label for="pelajaran">Pelajaran:</label><br>
  <select id="pelajaran" name="pelajaran" onchange="updateSubMateri()" required>
    <option value="">-- Pilih Pelajaran --</option>
    <option value="AL-QURAN">AL-QURAN</option>
    <option value="HADITS">HADITS</option>
    <option value="AQIDAH FIQIH">AQIDAH FIQIH</option>
    <option value="PENDIDIKAN ISLAM">PENDIDIKAN ISLAM</option>
    <option value="BAHASA">BAHASA</option>
    <option value="MUATAN LOKAL">MUATAN LOKAL</option>
  </select><br><br>

  <!-- Sub Materi -->
  <label for="sub_materi">Sub Materi:</label><br>
  <select id="sub_materi" name="sub_materi[]" multiple size="6" required>
  </select><br><br>

  <!-- Nilai -->
  <label for="nilai">Nilai:</label><br>
  <input type="number" id="nilai" name="nilai" min="0" max="100" required><br><br>

  <!-- Absensi -->
  <label for="absensi">Absensi:</label><br>
  <select id="absensi" name="absensi" required>
    <option value="">-- Pilih Status Absensi --</option>
    <option value="Hadir">Hadir</option>
    <option value="Sakit">Sakit</option>
    <option value="Izin">Izin</option>
    <option value="Tanpa Keterangan">Tanpa Keterangan</option>
  </select><br><br>

  <!-- Submit -->
  <button type="submit">Simpan Data</button>
</form>

<script>
  const subMateriMap = {
    "AL-QURAN": ["Qaidah Nuraniyah", "Hapalan Surat", "Doa Sunnah"],
    "HADITS": ["Hapalan Hadits"],
    "AQIDAH FIQIH": ["Aqidah", "Shalat", "Asmaul Husna", "Fiqh"],
    "PENDIDIKAN ISLAM": ["Pengetahuan Islam", "Pidato dan Doa", "Sirah", "Agama yang Mudah"],
    "BAHASA": ["Bahasa Arab"],
    "MUATAN LOKAL": ["Aqidatul Awwam", "Tuhfatul Athfal"]
  };

  function updateSubMateri() {
    const pelajaran = document.getElementById("pelajaran").value;
    const subMateriSelect = document.getElementById("sub_materi");

    // Kosongkan sub materi sebelumnya
    subMateriSelect.innerHTML = "";

    if (subMateriMap[pelajaran]) {
      subMateriMap[pelajaran].forEach(sub => {
        const option = document.createElement("option");
        option.value = sub;
        option.text = sub;
        subMateriSelect.add(option);
      });
    }
  }
</script>

        </div>
      </div>
      @endsection