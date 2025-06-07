@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Data Rapor Siswa</h6>
        <button class="btn btn-success" onclick="downloadReport()">
          <i class="ni ni-cloud-download-95"></i> Download File
        </button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table class="table text-center align-items-center mb-0"> 
        <thead>
          <tr>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Bulan</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status Pembayaran</th>
            <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Upload Bukti Pembayaran</th>
            <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Keterangan</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td class="align-middle text-center text-sm">Juli 2024</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-success">Selesai</span>
            </td>
            <td class="align-middle text-center text-sm">
              <a href="bukti_pembayaran/juli.jpg" target="_blank" class="text-primary text-decoration-none">Lihat Bukti</a>
            </td>
            <td class="align-middle">
                <button type="button" class="btn btn-success btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                    <a href="javascript:;" class="text-white font-weight-bold text-xs">
                        <i class="fa fa-check pt-1" aria-hidden="true"></i>
                    </a>
                </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Agustus 2024</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-success">Selesai</span>
            </td>
            <td class="align-middle text-center text-sm">
              <a href="bukti_pembayaran/agustus.jpg" target="_blank" class="text-primary text-decoration-none">Lihat Bukti</a>
            </td>
            <td class="align-middle">
                <button type="button" class="btn btn-success btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                    <a href="javascript:;" class="text-white font-weight-bold text-xs">
                        <i class="fa fa-check pt-1" aria-hidden="true"></i>
                    </a>
                </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">September 2024</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-warning">Menunggu Konfirmasi</span>
            </td>
            <td class="align-middle text-center text-sm">
              <a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none">Lihat Bukti</a>
            </td>
            <td class="align-middle">
              <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-clock pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <!-- Bulan-bulan berikutnya belum bayar -->
          <tr>
            <td class="align-middle text-center text-sm">Oktober 2024</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>
            
            <td class="align-middle text-center text-sm">
          <a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">November 2024</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Desember 2024</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
              <a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>
            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Januari 2025</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Februari 2025</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Maret 2025</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">April 2025</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Mei 2025</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
            </td>
          </tr>

          <tr>
            <td class="align-middle text-center text-sm">Juni 2025</td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-secondary">Belum Bayar</span>
            </td>

            <td class="align-middle text-center text-sm">
<a href="bukti_pembayaran/september.jpg" target="_blank" class="text-primary text-decoration-none" style="width: 30px; height: 30px;" >Upload Pembayaran</a>            </td>
          <td class="align-middle">
              <button type="button" class="btn btn-secondary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Belum Bayar">
                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-times pt-1" aria-hidden="true"></i>
                  </a>
              </button>
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