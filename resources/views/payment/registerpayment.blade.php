@extends('layouts.layoutregister')
@section('content')
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                      </div>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password" required>
                      </div>
                      <div class="form-group">
                          <label for="birthdate">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                      </div>
                      <div class="form-group">
                          <label for="gender">Jenis Kelamin</label>
                          <select class="form-control" id="gender" name="gender" required>
                              <option value="male">Laki-laki</option>
                              <option value="female">Perempuan</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="phone">Telepon</label>
                          <input type="text" class="form-control" id="phone" name="phone" required>
                      </div>
                      <div class="form-group">
                          <label for="address">Alamat</label>
                          <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="class_id">Kelas</label>
                        <input type="text" class="form-control" id="class_id" name="class_id" required>
                    </div>
                    <div class="form-group">
                        <label for="father_name">Nama Ayah</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" required>
                    </div>
                    <div class="form-group">
                        <label for="father_job">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" id="father_job" name="father_job" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mother_name">Nama Ibu</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                    </div>
                    <div class="form-group">
                        <label for="mother_job">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="mother_job" name="mother_job" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                </div>

            <div class="form-group text-center mt-4">
              <button type="submit" class="btn btn-primary btn-lg">Lanjutkan Pendaftaran</button>
              <p class="text-sm mt-2 mb-0">Pastikan data sudah diisi dengan benar untuk melanjutkan ke tahap berikutnya.</p>
            </div>

            <p class="text-sm text-center mt-3 mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Masuk</a></p>
@endsection
