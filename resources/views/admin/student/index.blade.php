@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">

      <div class="card-header pb-0">
  <div class="d-flex justify-content-between align-items-center mb-3 text-sm">
    <!-- Tombol tambah data di kiri -->
    <a href="{{ route('admin.student.create') }}">
      <button class="btn btn-primary">
        <i class="ni ni-fat-add"></i> Tambah Data
      </button>
    </a>

    <!-- Form search di kanan -->
    <form method="GET" action="{{ route('admin.student.index') }}" class="d-flex align-items-center gap-2">
      <div class="input-group" style="width: 220px;">
        <span class="input-group-text text-body"><i class="fas fa-search"></i></span>
        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari Nama Siswa...">
      </div>
      <button type="submit" class="btn btn-info mt-3">Cari</button>
    </form>
  </div>
</div>

      <div class="card-body px-0 pt-0 pb-2">
        
        <div class="table-responsive p-0">
          <table class="table text-center align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Foto</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">NIS</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Siswa</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas Deeniyat</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Email</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">No Telp</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Alamat</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>

                <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
              </tr>
              <?php $no = 1; ?>
            </thead>

            <tbody>
              @foreach ($data as $value)
              <tr>
                <td>{{ $data->firstItem() + $no - 1 }}</td>
                <!-- <td class="align-middle text-center text-sm">{{ $no++ }}</td> -->

                <td class="align-middle text-center text-sm">
                  @if($value->photo && Storage::disk('public')->exists($value->photo))
                  <img src="{{ asset('storage/' . $value->photo) }}"
                    alt="photo" width="40" height="40" style="object-fit: cover; border-radius: 5px;">
                  @else
                  <img src="{{ asset('assets/img/non-profile.png') }}"                     
                  alt="photo" width="40" height="40" style="object-fit: cover; border-radius: 5px;">
                  @endif
                </td>

                <td class="align-middle text-center text-sm">{{ $value->nis }}</td>

                <td class="align-middle text-center text-sm">{{ $value->name }}</td>

                <td class="align-middle text-center text-sm">{{ $value->class?->class_name ?? '-' }}</td>

                <td class="align-middle text-center text-sm">{{ $value->email }}</td>

                <td class="align-middle text-center text-sm">{{ $value->phone }}</td>

                <td class="align-middle text-center text-sm">{{ $value->address }}</td>

                @if($value->is_active == 1)
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">aktif</span>
                </td>
                @else
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-danger">tidak aktif</span>
                </td>
                @endif

                <td class="align-middle text-center">
                  <button type="button" class="btn btn-info btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Detail Siswa">
                    <a href="{{ route('admin.student.show', $value->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-eye pt-1" aria-hidden="true"></i>
                    </a>
                  </button>

                  <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Siswa">
                    <a href="{{ route('admin.student.edit', $value->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                    </a>
                  </button>


                  <form action="{{ route('admin.student.destroy', $value->id) }}" method="POST" style="display:inline-block;">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection