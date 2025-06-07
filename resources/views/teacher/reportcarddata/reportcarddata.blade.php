@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between mb-0">
              <!-- tambah data -->
              <a href="{{ route('reportcarddata.create') }}">
                <button class="btn btn-primary">
                  <i class="ni ni-fat-add"></i> Tambah Data
                </button>
              </a>
                </div>
                <h6>Data Pengisian Rapor</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama Siswa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NIS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Kehadiran</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nilai Siswa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
    <tr>
        <td class="text-center">1</td>
        <td class="text-center">Ahmad Fauzan</td>
        <td class="text-center">202301</td>
        <td class="text-center">
            <a href="kehadiran.php?nis=202301" class="btn btn-primary btn-sm">
                Isi Kehadiran
            </a>
        </td>

        <td class="text-center">
            <a href="nilai_harian.php?nis=202303" class="btn btn-success btn-sm">
                Isi Penilaian
            </a>
        </td>
        <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-success">Selesai</span>
            </td>

    </tr>
    <tr>
        <td class="text-center">2</td>
        <td class="text-center">Siti Rahmawati</td>
        <td class="text-center">202302</td>
        <td class="text-center">
            <a href="kehadiran.php?nis=202301" class="btn btn-primary btn-sm">
                Isi Kehadiran
            </a>
        </td>
        <td class="text-center">
            <a href="nilai_harian.php?nis=202303" class="btn btn-success btn-sm">
                Isi Penilaian
            </a>
        </td>
        <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-success">Selesai</span>
            </td>
            
    </tr>
    <tr>
        <td class="text-center">3</td>
        <td class="text-center">Muhammad Ilham</td>
        <td class="text-center">202303</td>
        <td class="text-center">
            <a href="kehadiran.php?nis=202301" class="btn btn-primary btn-sm">
                Isi Kehadiran
            </a>
        </td>
        <td class="text-center">
            <a href="nilai_harian.php?nis=202303" class="btn btn-success btn-sm">
                Isi Penilaian
            </a>
        </td>


        <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-warning">Proses</span>
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
