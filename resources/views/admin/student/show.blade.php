@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Detail Data Siswa</h6>
            </div>

            <div class="card-body px-4 py-3">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>{{ $student->nis }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>
                                {{ $student->class ? $student->class->class_name : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $student->birthplace }}, {{ \Carbon\Carbon::parse($student->birthdate)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $student->gender }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $student->phone }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ayah</th>
                            <td>{{ $student->father_name }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan Ayah</th>
                            <td>{{ $student->father_job ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ibu</th>
                            <td>{{ $student->mother_name }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan Ibu</th>
                            <td>{{ $student->mother_job ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($student->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if($student->photo)
                                <img src="{{ asset('storage/'.$student->photo) }}" alt="Foto {{ $student->name }}" class="rounded" style="max-height: 120px;">
                                @else
                                Tidak ada foto
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Tombol aksi kanan bawah -->
                <div class="text-end mt-4">
                    <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-primary">Edit</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection