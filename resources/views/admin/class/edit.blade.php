@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.class.update', $class->id) }}" method="POST" id="classForm" class="p-4 border rounded shadow-sm bg-light">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Nama Kelas --}}
                <div class="col-md-6 mb-3">
                    <label for="class_name" class="form-label">Nama Kelas</label>
                    <select class="form-select" id="class_name" name="class_name" required>
                        <option value="">Pilih Kelas</option>

                        <optgroup label="Kelas 0">
                            <option value="Kelas 0A" {{ $class->class_name == 'Kelas 0A' ? 'selected' : '' }}>Kelas 0A</option>
                            <option value="Kelas 0B" {{ $class->class_name == 'Kelas 0B' ? 'selected' : '' }}>Kelas 0B</option>
                            <option value="Kelas 0C" {{ $class->class_name == 'Kelas 0C' ? 'selected' : '' }}>Kelas 0C</option>
                        </optgroup>

                        <optgroup label="Kelas 1">
                            <option value="Kelas 1A" {{ $class->class_name == 'Kelas 1A' ? 'selected' : '' }}>Kelas 1A</option>
                            <option value="Kelas 1B" {{ $class->class_name == 'Kelas 1B' ? 'selected' : '' }}>Kelas 1B</option>
                            <option value="Kelas 1C" {{ $class->class_name == 'Kelas 1C' ? 'selected' : '' }}>Kelas 1C</option>
                        </optgroup>

                        <optgroup label="Kelas 2">
                            <option value="Kelas 2A" {{ $class->class_name == 'Kelas 2A' ? 'selected' : '' }}>Kelas 2A</option>
                            <option value="Kelas 2B" {{ $class->class_name == 'Kelas 2B' ? 'selected' : '' }}>Kelas 2B</option>
                            <option value="Kelas 2C" {{ $class->class_name == 'Kelas 2C' ? 'selected' : '' }}>Kelas 2C</option>
                        </optgroup>

                        <optgroup label="Kelas 3">
                            <option value="Kelas 3A" {{ $class->class_name == 'Kelas 3A' ? 'selected' : '' }}>Kelas 3A</option>
                            <option value="Kelas 3B" {{ $class->class_name == 'Kelas 3B' ? 'selected' : '' }}>Kelas 3B</option>
                            <option value="Kelas 3C" {{ $class->class_name == 'Kelas 3C' ? 'selected' : '' }}>Kelas 3C</option>
                        </optgroup>

                        <optgroup label="Kelas 4">
                            <option value="Kelas 4A" {{ $class->class_name == 'Kelas 4A' ? 'selected' : '' }}>Kelas 4A</option>
                            <option value="Kelas 4B" {{ $class->class_name == 'Kelas 4B' ? 'selected' : '' }}>Kelas 4B</option>
                            <option value="Kelas 4C" {{ $class->class_name == 'Kelas 4C' ? 'selected' : '' }}>Kelas 4C</option>
                        </optgroup>

                        <optgroup label="Kelas 5">
                            <option value="Kelas 5A" {{ $class->class_name == 'Kelas 5A' ? 'selected' : '' }}>Kelas 5A</option>
                            <option value="Kelas 5B" {{ $class->class_name == 'Kelas 5B' ? 'selected' : '' }}>Kelas 5B</option>
                            <option value="Kelas 5C" {{ $class->class_name == 'Kelas 5C' ? 'selected' : '' }}>Kelas 5C</option>
                        </optgroup>

                        <optgroup label="Kelas 6">
                            <option value="Kelas 6A" {{ $class->class_name == 'Kelas 6A' ? 'selected' : '' }}>Kelas 6A</option>
                            <option value="Kelas 6B" {{ $class->class_name == 'Kelas 6B' ? 'selected' : '' }}>Kelas 6B</option>
                            <option value="Kelas 6C" {{ $class->class_name == 'Kelas 6C' ? 'selected' : '' }}>Kelas 6C</option>
                        </optgroup>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="teacher_name" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                        value="{{ old('teacher_name', $class->teacher_name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Ajaran</label>
                    <div class="row">
                        <div class="col">
                            <input type="number" class="form-control" id="academic_year_first" name="academic_year_first"
                                value="{{ old('academic_year_first', $class->academic_year_first) }}" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" id="academic_year_last" name="academic_year_last"
                                value="{{ old('academic_year_last', $class->academic_year_last) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('admin.class.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection