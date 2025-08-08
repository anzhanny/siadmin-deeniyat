@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
          
          <div class="card mb-4">
          
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between mb-0">
              <!-- tambah data -->
              <a href="{{ route('admin.payment.create')}}">
                <button class="btn btn-primary">
                  <i class="ni ni-fat-add"></i> Tambah Data
                </button>
              </a>
                  <button class="btn btn-success">
                    <i class="ni ni-cloud-download-95"></i> Download File
                  </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table text-center align-items-center mb-0"> 
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Siswa</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tipe Pembayaran</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jumlah Pembayaran</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Metode Pembayaran</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Bulan</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tanggal</th>

                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Deskripsi</th>

                        <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
                    </tr>

                    <?php $no = 1; ?>
                  </thead>

                  <tbody>
                    @foreach ($data as $value)
                    <tr>
                      <td class="align-middle text-center text-sm">{{ $no++ }}</td>

                      <td class="align-middle text-center text-sm">{{$value->user->name}}</td>

                      <td class="align-middle text-center text-sm">{{$value->payment_type}}</td>

                      <td class="align-middle text-center text-sm">{{$value->amount}}</td>

                      <td class="align-middle text-center text-sm">{{$value->method}}</td>

                      <td class="align-middle text-center text-sm">{{$value->month}}</td>

                      <td class="align-middle text-center text-sm">{{$value->paid_at}}</td>

                      <td class="align-middle text-center text-sm">{{$value->description}}</td>

                      <td class="align-middle">
                        <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-clock pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
      </div>

      <!-- konfirmasi pembayaran -->
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const konfirmasiIcons = document.querySelectorAll(".konfirmasi-icon");

          konfirmasiIcons.forEach(td => {
            const status = td.dataset.status;

            if (status === "done") {
              td.innerHTML = '<i class="fa fa-check-circle text-success" title="Sudah Dikonfirmasi"></i>';
            } else {
              td.innerHTML = '<i class="fa fa-clock text-warning" title="Menunggu Konfirmasi"></i>';
            }
          });
        });
      </script>


      @endsection