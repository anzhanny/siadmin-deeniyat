@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.class.store') }}" method="POST" id="classForm" class="p-4 border rounded shadow-sm bg-light">
            @csrf

            <div class="mb-3">
                <label for="class_name" class="form-label">Nama Kelas</label>
                <select class="form-select" id="class_name" name="class_name" required>
                    <option value="">Pilih Kelas</option>
                    <option value="0">Kelas 0</option>
                    <option value="1">Kelas 1</option>
                    <option value="2">Kelas 2</option>
                    <option value="3">Kelas 3</option>
                    <option value="4">Kelas 4</option>
                    <option value="5">Kelas 5</option>
                    <option value="6">Kelas 6</option>
                </select>

            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Siswa</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah Siswa" required>
            </div>

            <div class="mb-3">
                <label for="teacher_name" class="form-label">Wali Kelas</label>
                <input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="Masukkan Nama Wali Kelas" required>
            </div>

            <div class="mb-3">
                <label for="academic_year_first" class="form-label">Awal Tahun Ajaran</label>
                <input type="number" class="form-control" id="academic_year_first" name="academic_year_first" placeholder="Masukkan Awal Tahun Ajaran" required>

                <label for="academic_year_last" class="form-label mt-2">Akhir Tahun Ajaran</label>
                <input type="number" class="form-control" id="academic_year_last" name="academic_year_last" placeholder="Masukkan Akhir Tahun Ajaran" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection