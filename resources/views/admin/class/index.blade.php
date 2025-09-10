@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between mb-0">
          <!-- tambah data -->
          <!-- <a href="{{ route('admin.class.create') }}">
            <button class="btn btn-primary">
              <i class="ni ni-fat-add"></i> Tambah Data
            </button>
          </a> -->
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
            </thead>

            <tbody>
              @foreach($data as $class)
              <tr @if($class->user->count() >= $class->amount) class="bg-danger text-white" @endif>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $class->class_name }}</td>
                <td>
                  <a href="#" data-class-id="{{ $class->id }}" class="toggle-students">
                    {{ $class->user->count() }} / {{ $class->amount }}
                  </a>
                </td>
                <td>{{ $class->teacher_name ?? '-' }}</td>
                <td>{{ $class->academic_year_first }}/{{ $class->academic_year_last }}</td>
                <td>
                   <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Class">
                    <a href="{{ route('admin.class.edit', $class->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                    </a>
                  </button>


                  <form action="{{ route('admin.class.destroy', $class->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="btn btn-danger btn-icon btn-sm p-1"
                      style="width: 30px; height: 30px;"
                      title="Hapus Kelas"
                      onclick="return confirm('Yakin mau hapus Kelas ini?')">
                      <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                    </button>
                  </form>
                </td>
              </tr>
              <tr id="students-{{ $class->id }}" style="display:none;">
                <td colspan="6">
                  <ul class="list-group">
                    @foreach($class->user as $student)
                    <li class="list-group-item text-start">{{ $student->name }}</li>
                    @endforeach
                  </ul>
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

{{-- Script Sortir Table --}}
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

    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";
    rows.forEach(row => tbody.appendChild(row));
  }
</script>

<script>
document.querySelectorAll('.toggle-students').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const classId = this.dataset.classId;
        const row = document.getElementById('students-' + classId);
        if(row) row.style.display = (row.style.display === 'none') ? '' : 'none';
    });
});
</script>
@endsection