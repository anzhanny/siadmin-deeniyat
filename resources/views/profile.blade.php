@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card px-4 py-3">
        <div class="card-header px-0 d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Edit Profile</h5>
        </div>
        <div class="card-body px-0">
          <form method="POST" action="#" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Avatar Upload --}}
            <div class="text-center mb-4">
              <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="d-none" onchange="previewPhoto(event)">
              <label for="profile_photo" style="cursor: pointer;">
                <img src="{{ Auth::user()->profile_photo_url ?? asset('default-profile.png') }}"
                  alt="Profile Photo"
                  class="rounded-circle shadow-sm"
                  style="width: 150px; height: 150px; object-fit: cover;"
                  id="profile-preview"
                  title="Click to change photo">
              </label>
              <div class="small text-muted mt-2">Klik untuk mengganti foto</div>
            </div>

            {{-- Basic Info --}}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="full_name">Nama Lengkap</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="{{ Auth::user()->full_name ?? 'Alexa Rawles' }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nick_name">Nomor Induk</label>
                  <input type="text" class="form-control" id="nick_name" name="nick_name" value="{{ Auth::user()->nick_name ?? '123456789' }}">
                </div>
              </div>
            </div>

              
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="full_name">Alamat</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="{{ Auth::user()->full_name ?? 'Bandung' }}">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="dob">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="dob" name="dob" value="{{ Auth::user()->dob ?? '1995-06-01' }}">
                </div>
              </div>
            </div>


            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">No Hp</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone ?? '+62 812-3456-7890' }}">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select class="form-control" id="gender" name="gender">
                    <option value="Male" {{ Auth::user()->gender === 'Male' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Female" {{ Auth::user()->gender === 'Female' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>
              </div>
  
  
            <hr class="my-4">

            {{-- Role-based Email --}}
            <h6 class="heading-small text-muted mb-4">Email Address</h6>
            <div class="form-group">
              <label for="email">Primary Email</label>
              <input type="email" class="form-control" id="email" disabled
                value="
                @if(Auth::user()->role === 'admin')
                  admin@example.com
                @elseif(Auth::user()->role === 'teacher')
                  teacher@example.com
                @elseif(Auth::user()->role === 'student')
                  student@example.com
                @else
                  {{ Auth::user()->email }}
                @endif
              ">
            </div>
  
            <div class="text-right mt-4">
              <button class="btn btn-primary px-4" type="submit">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- JS: Preview Avatar --}}
<script>
  function previewPhoto(event) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function(){
      const preview = document.getElementById('profile-preview');
      preview.src = reader.result;
    };

    if (input.files[0]) {
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
