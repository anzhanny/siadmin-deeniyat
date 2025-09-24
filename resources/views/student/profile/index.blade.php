@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12 col-lg-8 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <h4 class="mb-0"><b>Profil Saya</b></h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <label class="form-control-label">Nama Lengkap</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->name }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Email</label>
            <input class="form-control border-0 bg-light" type="email" value="{{ $data->email }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">NIS</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->nis }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Kelas</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->class?->class_name ?? '-' }}" readonly>

          </div>
          <div class="col-md-6">
            <label class="form-control-label">No Telepon</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->phone }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Alamat</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->address }}" readonly>
          </div>
        </div>

        <hr class="horizontal dark">
        <p class="text-uppercase text-sm"><b>Data Orang Tua</b></p>
        <div class="row">
          <div class="col-md-6">
            <label class="form-control-label">Nama Ayah</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->father_name }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Pekerjaan Ayah</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->father_job }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Nama Ibu</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->mother_name }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Pekerjaan Ibu</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->mother_job }}" readonly>
          </div>
        </div>
        <div class="text-end mt-4">
          <a href="{{ route('student.profile.edit', $data->id) }}" class="btn btn-primary btn-sm ms-auto">
            Edit Profil
          </a>
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
            <a href="javascript:;">
              <img src="{{ $data->photo ? asset('storage/'.$data->photo) : asset('assets/img/default-avatar.png') }}"
                class="rounded-circle img-fluid border border-2 border-white">
            </a>
          </div>
        </div>
      </div>
      <div class="card-body text-center">
        <h5>{{ $data->name }}</h5>
        <p class="text-sm text-muted mb-0">{{ $data->email }}</p>
      </div>
    </div>
  </div>
</div>
@endsection