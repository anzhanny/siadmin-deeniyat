@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
          
          <div class="card mb-4">
          
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between mb-0">
              <!-- tambah data -->
              <a href="/">
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
                    <th id="sortKelas" onclick="sortTable(1)" style="cursor:pointer;" class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>
                    <th id="sortKelas" onclick="sortTable(1)" style="cursor:pointer;" class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas ↑↓</th>
                    <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
                  </tr>

                  <?php $no = 1; ?>
                </thead>

                <tbody>
                    @foreach ($data as $value)
                    <tr>
                        <td class="align-middle text-center text-sm">{{ $no++ }}</td>
                        <td class="align-middle text-center text-sm">{{ $value->class->class_name }}</td>
                        <td class="align-middle">
                            <a href="/admin/materialdata/update">
                                <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 60px; height: 30px;" title="Input Materi">
                                <a href="javascript:;" class="text-white font-weight-bold text-xs">
                                {{ $value->material_name }}
                                </a>
                                </button>
                            </a>
                        </td>
                    </tr>
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