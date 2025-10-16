@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12 col-lg-8 mx-auto">

    {{-- Flash Message --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <h4 class="mb-0"><b>Profil Saya</b></h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- Nama Lengkap -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Nama Lengkap</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->name }}" readonly>
          </div>

          <!-- Email -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Email</label>
            <input class="form-control border-0 bg-light" type="email" value="{{ $data->email }}" readonly>
          </div>

          <!-- NIS -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">NIS</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->nis }}" readonly>
          </div>

          <!-- Kelas -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Kelas</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->class?->class_name ?? '-' }}" readonly>
          </div>

          <!-- No Telepon -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">No Telepon</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->phone }}" readonly>
          </div>

          <!-- Alamat -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Alamat</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->address }}" readonly>
          </div>
        </div>

        <hr class="horizontal dark">
        <p class="text-uppercase text-sm"><b>Data Orang Tua</b></p>
        <div class="row">
          <!-- Nama Ayah -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Nama Ayah</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->father_name }}" readonly>
          </div>

          <!-- Pekerjaan Ayah -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Pekerjaan Ayah</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->father_job }}" readonly>
          </div>

          <!-- Nama Ibu -->
          <div class="col-md-6 mb-3">
            <label class="form-control-label">Nama Ibu</label>
            <input class="form-control border-0 bg-light" type="text" value="{{ $data->mother_name }}" readonly>
          </div>

          <!-- Pekerjaan Ibu -->
          <div class="col-md-6 mb-3">
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
      <img src="{{ asset('assets/img/bg-profile1.png') }}" alt="Image placeholder" class="card-img-top">
      <div class="row justify-content-center">
        <div class="col-4 col-lg-4 order-lg-2">
          <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
            <a href="javascript:;">
              <img src="{{ $data->photo ? asset('storage/'.$data->photo) : asset('assets/img/non-profile.png') }}"
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
