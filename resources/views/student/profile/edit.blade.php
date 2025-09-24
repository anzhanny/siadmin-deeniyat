@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <form action="{{ route('student.profile.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $data->name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">Email</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email', $data->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">NIS</label>
                            <input class="form-control" type="text" value="{{ $data->nis }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">Kelas</label>
                            <input class="form-control" type="text" value="{{ $data->class?->class_name ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">No Telepon</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone', $data->phone) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">Alamat</label>
                            <input class="form-control" type="text" name="address" value="{{ old('address', $data->address) }}">
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Data Orang Tua</p>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label">Nama Ayah</label>
                            <input class="form-control" type="text" name="father_name" value="{{ old('father_name', $data->father_name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">Pekerjaan Ayah</label>
                            <input class="form-control" type="text" name="father_job" value="{{ old('father_job', $data->father_job) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">Nama Ibu</label>
                            <input class="form-control" type="text" name="mother_name" value="{{ old('mother_name', $data->mother_name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label">Pekerjaan Ibu</label>
                            <input class="form-control" type="text" name="mother_job" value="{{ old('mother_job', $data->mother_job) }}">
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan</button>
                    </div>

                </div>
            </div>
    </div>

    <!-- Sidebar Foto -->
    <div class="col-md-4">
       <div class="card card-profile">
        <img src="{{ asset('assets/img/bg-profile.jpg') }}" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
            <div class="col-4 col-lg-4 order-lg-2">
                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                    <img src="{{ $data->photo ? asset('storage/'.$data->photo) : asset('assets/img/default-avatar.png') }}"
                         class="rounded-circle img-fluid border border-2 border-white">
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <h5>{{ $data->name }}</h5>
            <p class="text-sm text-muted mb-0">{{ $data->email }}</p>

            {{-- Input untuk ganti foto --}}
            <div class="mt-3">
                <label for="photo" class="form-label">Ganti Foto</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                @error('photo')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
        </form>
    </div>
</div>
@endsection