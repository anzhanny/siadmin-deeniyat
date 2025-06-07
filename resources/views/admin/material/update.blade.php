@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
        <form method="POST" action="{{ route('materialdata.update', $materialdatum->id) }}">
    @csrf
    @method('PUT')
  <label for="pelajaran">Pelajaran:</label>
  <select id="pelajaran" name="pelajaran" onchange="updateSubMateri()">
    <option value="">-- Pilih Pelajaran --</option>
    <option value="alquran">AL-QURAN</option>
    <option value="hadits">HADITS</option>
    <option value="aqidah">AQIDAH FIQIH</option>
    <option value="pendidikan">PENDIDIKAN ISLAM</option>
    <option value="bahasa">BAHASA</option>
    <option value="muatan">MUATAN LOKAL</option>
  </select>

  <br><br>

  <label for="submateri">Sub Materi:</label>
  <select id="submateri" name="submateri">
    <option value="">-- Pilih Sub Materi --</option>
  </select>
</form>

<script>
  const subMateriOptions = {
    alquran: ["Qaidah Nuraniyah", "Hapalan Surat", "Doa Sunnah"],
    hadits: ["Hapalan Hadits"],
    aqidah: ["Aqidah", "Shalat", "Asmaul Husna", "Fiqh"],
    pendidikan: ["Pengetahuan Islam", "Pidato dan Doa", "Sirah", "Agama yang Mudah"],
    bahasa: ["Bahasa Arab"],
    muatan: ["Aqidatul Awwam", "Tuhfatul Athfal"]
  };

  function updateSubMateri() {
    const pelajaran = document.getElementById("pelajaran").value;
    const subMateriSelect = document.getElementById("submateri");
    subMateriSelect.innerHTML = '<option value="">-- Pilih Sub Materi --</option>';

    if (subMateriOptions[pelajaran]) {
      subMateriOptions[pelajaran].forEach(sub => {
        const option = document.createElement("option");
        option.value = sub;
        option.textContent = sub;
        subMateriSelect.appendChild(option);
      });
    }
  }
</script>


        </div>
      </div>
      @endsection