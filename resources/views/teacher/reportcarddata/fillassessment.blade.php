@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="/submit-nilai" method="POST">
        <label for="nama_siswa">Nama Siswa:</label><br>
        <input type="text" id="nama_siswa" name="nama_siswa" required><br><br>

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

        <label for="sub_materi">Sub Materi:</label><br>
        <select id="sub_materi" name="sub_materi[]" multiple size="6" required>
            <!-- Sub materi akan diisi otomatis lewat JavaScript -->
        </select><br><br>

        <label for="nilai">Nilai:</label><br>
        <input type="number" id="nilai" name="nilai" min="0" max="100" required><br><br>

        <button type="submit">Simpan Nilai</button>
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

            // Kosongkan isi sebelumnya
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