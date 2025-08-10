@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.class.update', $class->id) }}" method="POST" id="classForm" class="p-4 border rounded shadow-sm bg-light">
            @csrf
            @method('PUT')

            <div class="col-md-6 mb-3">
                <label for="class_id" class="form-label">Nama Kelas</label>
                <select class="form-select" id="class_name" name="class_name" required>
                    <option value="">Pilih Kelas</option>
                    @for ($i = 0; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ old('class_name', $class->class_name) == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
                        @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Siswa</label>
                <input type="number"
                    class="form-control"
                    id="amount"
                    name="amount"
                    value="{{ old('amount', $class->amount) }}"
                    placeholder="Masukkan Jumlah Siswa"
                    required>
            </div>

            <div class="mb-3">
                <label for="teacher_name" class="form-label">Wali Kelas</label>
                <input type="text"
                    class="form-control"
                    id="teacher_name"
                    name="teacher_name"
                    value="{{ old('teacher_name', $class->teacher_name) }}"
                    placeholder="Masukkan Nama Wali Kelas"
                    required>
            </div>

            <div class="mb-3">
                <label for="academic_year_first" class="form-label">Awal Tahun Ajaran</label>
                <input type="number"
                    class="form-control"
                    id="academic_year_first"
                    name="academic_year_first"
                    value="{{ old('academic_year_first', $class->academic_year_first) }}"
                    placeholder="Masukkan Awal Tahun Ajaran"
                    required>

                <label for="academic_year_last" class="form-label mt-2">Akhir Tahun Ajaran</label>
                <input type="number"
                    class="form-control"
                    id="academic_year_last"
                    name="academic_year_last"
                    value="{{ old('academic_year_last', $class->academic_year_last) }}"
                    placeholder="Masukkan Akhir Tahun Ajaran"
                    required>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection