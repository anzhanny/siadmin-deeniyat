@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
          
          <div class="card mb-4">
          
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between mb-0">
                  <button class="btn btn-primary">
                    <i class="ni ni-fat-add" ></i> Tambah Data
                  </button>
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
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Siswa</th>
                      <th id="sortNis" onclick="sortTable(2)" style="cursor:pointer;" class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">NIS ↑↓</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">No Telp</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Email</th>
                      <th  class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jenis Kelamin</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="align-middle text-center text-sm">Ahmad Fadhil</td>
                      <td class="align-middle text-center text-sm">102301</td>
                      <td class="align-middle text-center text-sm">081234567890</td>
                      <td class="align-middle text-center text-sm">ahmad.fadhil@siswa.madrasah.sch.id</td>
                      <td class="align-middle text-center text-sm">Laki-laki</td>
                      
                    </tr>

                    <tr>
                      <td class="align-middle text-center text-sm">Siti Maulida</td>
                      <td class="align-middle text-center text-sm">102302</td>
                      <td class="align-middle text-center text-sm">082198765432</td>
                      <td class="align-middle text-center text-sm">siti.maulida@siswa.madrasah.sch.id</td>
                      <td class="align-middle text-center text-sm">Perempuan</td>
                      
                    </tr>

                    <tr>
                      <td class="align-middle text-center text-sm">Rizky Ramadhan</td>
                      <td class="align-middle text-center text-sm">102303</td>
                      <td class="align-middle text-center text-sm">085321234567</td>
                      <td class="align-middle text-center text-sm">rizky.ramadhan@siswa.madrasah.sch.id</td>
                      <td class="align-middle text-center text-sm">Laki-laki</td>
                      
                    </tr>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        let sortDirection = {};

        function sortTable(columnIndex) {
          const table = document.querySelector("table");
          const rows = Array.from(table.querySelectorAll("tbody tr"));

          // Toggle sort direction
          sortDirection[columnIndex] = !sortDirection[columnIndex];
          const direction = sortDirection[columnIndex] ? 1 : -1;

          rows.sort((a, b) => {
            const cellA = a.children[columnIndex].textContent.trim().toLowerCase();
            const cellB = b.children[columnIndex].textContent.trim().toLowerCase();

            return cellA.localeCompare(cellB) * direction;
          });

          // Hapus dan masukkan ulang baris yang sudah diurut
          const tbody = table.querySelector("tbody");
          tbody.innerHTML = "";
          rows.forEach(row => tbody.appendChild(row));
        }
      </script>

      @endsection