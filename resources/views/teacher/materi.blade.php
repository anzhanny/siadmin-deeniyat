@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between mb-0">
                    <button class="btn btn-primary">
                        <i class="ni ni-fat-add"></i> Tambah Nilai
                    </button>
                    <button class="btn btn-danger">
                        <i class="ni ni-fat-remove"></i> Hapus data terpilih
                    </button>
                </div>
                <h6>Data Pengisian Rapor</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS/NISN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" colspan="3">Penilaian Harian</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" colspan="1">UTS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" colspan="1">UAS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Rerata</th>
                            </tr>
                            <tr>
                                <th></th><th></th><th></th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>12345678910</td>
                                <td>Mila Maulida</td>
                                <td class="text-center">85</td>
                                <td class="text-center">88</td>
                                <td class="text-center">90</td>
                                <td class="text-center">92</td>
                                <td class="text-center">91</td>
                                <td class="text-center">89.2</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>12345678910</td>
                                <td>Fulan bin Fulan</td>
                                <td class="text-center">80</td>
                                <td class="text-center">82</td>
                                <td class="text-center">79</td>
                                <td class="text-center">85</td>
                                <td class="text-center">84</td>
                                <td class="text-center">82</td>
                            </tr>
                            <!-- Tambahkan baris lainnya sesuai data -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
