@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">

      <div class="card-header pb-0">
        <div class="d-flex justify-content-between mb-0">
          <!-- tambah data -->
          <a href="{{ route('admin.class.create') }}">
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
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jumlah Siswa</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Wali Kelas</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tahun Ajaran</th>
                <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
              </tr>

              <?php $no = 1; ?>
            </thead>

            <tbody>
              @foreach ($data as $value)
              <tr>
                 <td>{{ $data->firstItem() + $loop->index }}</td>
                <td class="align-middle text-center text-sm">{{$value->class_name}}</td>
                <td class="align-middle text-center text-sm">{{$value->amount}}</td>
                <td class="align-middle text-center text-sm">{{$value->teacher_name}}</td>
                <td class="align-middle text-center text-sm">{{$value->academic_year_first}}/{{$value->academic_year_last}}</td>
                <td class="align-middle">
                  <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Siswa">
                    <a href="{{ route('admin.class.edit', $value->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                    </a>
                  </button>


                  <form action="{{ route('admin.class.destroy', $value->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="btn btn-danger btn-icon btn-sm p-1"
                      style="width: 30px; height: 30px;"
                      title="Hapus Siswa"
                      onclick="return confirm('Yakin mau hapus siswa ini?')">
                      <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <nav aria-label="Page navigation example">
      <div class="d-flex justify-content-center mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
      </div>
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