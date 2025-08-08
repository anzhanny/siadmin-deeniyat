@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">

      <div class="card-header pb-0">
        <div class="d-flex justify-content-between mb-0">
          <!-- tambah data -->
          <a href="{{ route('admin.student.create') }}">
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

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Email</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Birtdate</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Gender</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">NIS ↑↓</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">No Telp</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Alamat</th>

                <th id="sortNis" onclick="sortTable(4)" style="cursor:pointer;" class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Ayah</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Pekerjaan Ayah</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Ibu</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Pekerjaan Ibu</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Foto</th>

                <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
              </tr>
              <?php $no = 1; ?>
            </thead>

            <tbody>
              @foreach ($data as $value)
              <tr>
                <td>{{ $data->firstItem() + $no - 1 }}</td>
                <!-- <td class="align-middle text-center text-sm">{{ $no++ }}</td> -->

                <td class="align-middle text-center text-sm">{{ $value->name }}</td>

                <td class="align-middle text-center text-sm">{{ $value->nis }}</td>

                <td class="align-middle text-center text-sm">{{ $value->email }}</td>

                <td class="align-middle text-center text-sm">{{ $value->birthplace}}</td>

                <td class="align-middle text-center text-sm">{{ $value->birthdate }}</td>

                <td class="align-middle text-center text-sm">{{ $value->gender }}</td>

                <td class="align-middle text-center text-sm">{{ $value->formal_education}}</td>

                <td class="align-middle text-center text-sm">{{ $value->address }}</td>

                <td class="align-middle text-center text-sm">{{ $value->phone }}</td>

                <td class="align-middle text-center text-sm">{{ $value->class_id }}</td>

                @if($value->is_active == 1)
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">aktif</span>
                </td>
                @else
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-danger">tidak aktif</span>
                </td>
                @endif

                <td class="align-middle text-center text-sm">{{ $value->father_name }}</td>

                <td class="align-middle text-center text-sm">{{ $value->father_job }}</td>

                <td class="align-middle text-center text-sm">{{ $value->mother_name }}</td>

                <td class="align-middle text-center text-sm">{{ $value->mother_job }}</td>

                <td class="align-middle text-center text-sm">
                  @if($value->photo && Storage::disk('public')->exists($value->photo))
                  <img src="{{ asset('storage/' . $value->photo) }}"
                    alt="photo" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                  @else
                  <p>Gambar tidak ditemukan.</p>
                  @endif
                </td>

                <td class="align-middle">
                  <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Siswa">
                    <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                    </a>
                  </button>
                  <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Siswa">
                    <a href="javascript:;" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-trash pt-1" aria-hidden="true"></i>
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