@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <form action="{{ route('admin.class.store') }}" method="POST" id="classForm" class="p-4 border rounded shadow-sm bg-light">
            @csrf
            <div class="mb-3">
                <label for="class_name" class="form-label">Nama Kelas</label>
                <select class="form-select" id="class_name" name="class_name" required>
                    <option value="">Pilih Kelas</option>
                    <optgroup label="Kelas 0">
                        <option value="Kelas 0A">Kelas 0A</option>
                        <option value="Kelas 0B">Kelas 0B</option>
                        <option value="Kelas 0C">Kelas 0C</option>
                    </optgroup>
                    <optgroup label="Kelas 1">
                        <option value="Kelas 1 kecil">Kelas 1A</option>
                        <option value="Kelas 1 sedang">Kelas 1B</option>
                        <option value="Kelas 1 besar">Kelas 1C</option>
                    </optgroup>
                    <optgroup label="Kelas 2">
                        <option value="Kelas 2 kecil">Kelas 2A</option>
                        <option value="Kelas 2 besar">Kelas 2B</option>
                        <option value="Kelas 2 besar">Kelas 2C</option>
                    </optgroup>
                    <optgroup label="Kelas 3">
                        <option value="Kelas 3A">Kelas 3A</option>
                        <option value="Kelas 3B">Kelas 3B</option>
                        <option value="Kelas 3C">Kelas 3C</option>
                    </optgroup>
                    <optgroup label="Kelas 4">
                        <option value="Kelas 4A">Kelas 4A</option>
                        <option value="Kelas 4B">Kelas 4B</option>
                        <option value="Kelas 4C">Kelas 4C</option>
                    </optgroup>
                    <optgroup label="Kelas 5">
                        <option value="Kelas 5A">Kelas 5A</option>
                        <option value="Kelas 5B">Kelas 5B</option>
                        <option value="Kelas 5C">Kelas 5C</option>
                    </optgroup>
                    <optgroup label="Kelas 6">
                        <option value="Kelas 6A">Kelas 6A</option>
                        <option value="Kelas 6B">Kelas 6B</option>
                        <option value="Kelas 6C">Kelas 6C</option>
                    </optgroup>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Siswa</label>
                <input type="text" class="form-control text-danger small fst-italic"
                    value="*Akan diisi otomatis oleh sistem" readonly disabled>
            </div>

            <div class="mb-3">
                <label for="teacher_name" class="form-label">Wali Kelas</label>
                <input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="Masukkan Nama Wali Kelas" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Ajaran</label>
                <div class="row">
                    <div class="col">
                        <input type="number" class="form-control" id="academic_year_first" name="academic_year_first" placeholder="Awal (misal 2023)" required>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="academic_year_last" name="academic_year_last" placeholder="Akhir (misal 2024)" required>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.class.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection