@extends('layouts.layout')
@section('content')
      <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Siswa</p>
                  <h5 class="font-weight-bolder mt-2">30</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                  <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Nama Kelas</p>
                  <h5 class="font-weight-bolder mt-2">6 A</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="ni ni-building text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Raport Input</p>
                  <h5 class="font-weight-bolder mt-2">10/20</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        
        
      </div>
      
      <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
  <div class="card">
    <div class="card-header pb-0 p-3">
      <div class="d-flex justify-content-between">
        <h6 class="mb-2">Data Rapor yang Sudah Diinput</h6>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table align-items-center">
        <thead>
          <tr>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kehadiran</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">1</td>
            <td class="text-center">Ahmad Fauzan</td>
            <td class="text-center">202301</td>
            <td class="text-center">95%</td>
            <td class="text-center">88</td>
            <td class="text-center">
              <span class="badge badge-sm bg-gradient-success">Selesai</span>
            </td>
          </tr>
          <tr>
            <td class="text-center">2</td>
            <td class="text-center">Siti Rahmawati</td>
            <td class="text-center">202302</td>
            <td class="text-center">97%</td>
            <td class="text-center">91</td>
            <td class="text-center">
              <span class="badge badge-sm bg-gradient-success">Selesai</span>
            </td>
          </tr>
          <tr>
            <td class="text-center">3</td>
            <td class="text-center">Muhammad Ilham</td>
            <td class="text-center">202303</td>
            <td class="text-center">89%</td>
            <td class="text-center">76</td>
            <td class="text-center">
              <span class="badge badge-sm bg-gradient-warning">Proses</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="col-lg-5">
  <div class="card mb-4">
    <div class="card-header pb-0">
      <h6>Data Siswa</h6>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jenis Kelamin</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Kelas</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="align-middle text-sm">10234567</td>
              <td>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">Muhammad Ali</h6>
                  <p class="text-xs text-secondary mb-0">ali@example.com</p>
                </div>
              </td>
              <td class="text-center text-sm">L</td>
              <td class="text-center text-sm">1A</td>
              <td class="text-center text-sm">
                <span class="badge badge-sm bg-gradient-success">Aktif</span>
              </td>
            </tr>
            <tr>
              <td class="align-middle text-sm">10234568</td>
              <td>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">Nazwa Putri</h6>
                  <p class="text-xs text-secondary mb-0">nazwaputri@example.com</p>
                </div>
              </td>
              <td class="text-center text-sm">P</td>
              <td class="text-center text-sm">2B</td>
              <td class="text-center text-sm">
                <span class="badge badge-sm bg-gradient-warning">Inactive</span>
              </td>
            </tr>
            <tr>
              <td class="align-middle text-sm">10234569</td>
              <td>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">Budi Santoso</h6>
                  <p class="text-xs text-secondary mb-0">budi@example.com</p>
                </div>
              </td>
              <td class="text-center text-sm">L</td>
              <td class="text-center text-sm">3C</td>
              <td class="text-center text-sm">
                <span class="badge badge-sm bg-gradient-success">Aktif</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

      </div>

      @endsection