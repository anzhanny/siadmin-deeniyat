@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Edit Profile</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Photo Upload --}}
            <div class="row mb-4">
              <div class="col-md-4 text-center">
                <img src="{{ Auth::user()->profile_photo_url ?? asset('default-profile.png') }}" 
                     alt="Profile Photo" 
                     class="rounded-circle img-fluid" 
                     style="width: 120px; height: 120px; object-fit: cover;" 
                     id="profile-preview">
              </div>
              <div class="col-md-8 d-flex flex-column justify-content-center">
                <label for="profile_photo">Change Profile Photo</label>
                <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewPhoto(event)">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="{{ Auth::user()->full_name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nick_name">Nick Name</label>
                  <input type="text" class="form-control" id="nick_name" name="nick_name" value="{{ Auth::user()->nick_name }}">
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select class="form-control" id="gender" name="gender">
                    <option value="Male" {{ Auth::user()->gender === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ Auth::user()->gender === 'Female' ? 'selected' : '' }}>Female</option>
                  </select>
                </div>
              </div>
  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" value="{{ Auth::user()->dob }}">
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <select class="form-control" id="country" name="country">
                    <option value="United States" {{ Auth::user()->country === 'United States' ? 'selected' : '' }}>United States</option>
                    <option value="Indonesia" {{ Auth::user()->country === 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                    <option value="Singapore" {{ Auth::user()->country === 'Singapore' ? 'selected' : '' }}>Singapore</option>
                  </select>
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="language">Language</label>
                  <select class="form-control" id="language" name="language">
                    <option value="English" {{ Auth::user()->language === 'English' ? 'selected' : '' }}>English</option>
                    <option value="Bahasa Indonesia" {{ Auth::user()->language === 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    <option value="Spanish" {{ Auth::user()->language === 'Spanish' ? 'selected' : '' }}>Spanish</option>
                  </select>
                </div>
              </div>
  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="timezone">Time Zone</label>
                  <select class="form-control" id="timezone" name="timezone">
                    <option value="GMT -5" {{ Auth::user()->timezone === 'GMT -5' ? 'selected' : '' }}>GMT -5</option>
                    <option value="GMT +7" {{ Auth::user()->timezone === 'GMT +7' ? 'selected' : '' }}>GMT +7</option>
                    <option value="GMT +8" {{ Auth::user()->timezone === 'GMT +8' ? 'selected' : '' }}>GMT +8</option>
                  </select>
                </div>
              </div>
            </div>
  
            <hr class="my-4">
  
            <h6 class="heading-small text-muted mb-4">Email Address</h6>
            <div class="form-group">
              <label for="email">Primary Email</label>
              <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled>
            </div>
  
            <div class="text-right">
              <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Image Preview Script --}}
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
