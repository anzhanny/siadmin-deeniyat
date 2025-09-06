@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">

      <div class="card-header pb-0">
        <div class="d-flex justify-content-between mb-0">
          <!-- tambah data -->
          <!-- <a href="{{ route('admin.payment.create')}}">
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

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tanggal</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Siswa</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tipe Pembayaran</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kategori Pembayaran</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Metode Pembayaran</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Bulan</th>


                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jumlah Pembayaran</th>

                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>


                <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
              </tr>

              <?php $no = 1; ?>
            </thead>

            <tbody>
              @foreach ($data as $value)
              <tr>
                <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>

                <td class="align-middle text-center text-sm">{{$value->paid_at }}</td>

                <td class="align-middle text-center text-sm">
                  {{ $value->user ? $value->user->name : '-' }}
                </td>

                <td class="align-middle text-center text-sm">
                  {{ $value->class ? $value->class->class_name : '-' }}
                </td>

                <td class="align-middle text-center text-sm">{{ $value->payment_type }}</td>
                <td class="align-middle text-center text-sm">{{ $value->payment_category }}</td>
                <td class="align-middle text-center text-sm">{{ $value->method }}</td>
                <td class="align-middle text-center text-sm">{{ $value->month }}</td>
                <!-- <td class="align-middle text-center text-sm">{{ $value->status }}</td> -->

                <td class="align-middle text-center text-sm">{{ number_format($value->amount, 0, ',', '.') }}</td>

                <td class="align-middle text-center text-sm">
                  <form action="{{ route('admin.payment.updateStatus', $value->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="dropdown">
                      <button class="btn btn-sm 
            @if($value->status == 'paid') btn-success 
            @elseif($value->status == 'pending') btn-warning 
            @elseif($value->status == 'failed') btn-danger 
            @else btn-secondary @endif
            dropdown-toggle"
                        type="button" id="dropdownMenuButton{{ $value->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ ucfirst($value->status) }}
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $value->id }}">
                        <li>
                          <button type="submit" name="status" value="pending" class="dropdown-item">Menunggu</button>
                        </li>
                        <li>
                          <button type="submit" name="status" value="paid" class="dropdown-item">Lunas</button>
                        </li>
                        <li>
                          <button type="submit" name="status" value="failed" class="dropdown-item">Dibatalkan</button>
                        </li>
                      </ul>
                    </div>
                  </form>
                </td>




                <td class="align-middle">
                <!-- detail -->
                  <button type="button" class="btn btn-info btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Detail Siswa">
                    <a href="{{ route('admin.payment.show', $value->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-eye pt-1" aria-hidden="true"></i>
                    </a>
                  </button>

                  <!-- bayar -->
                  <button type="button" class="btn btn-success btn-icon btn-sm p-1" style="width: 50px; height: 30px;" title="Bayar Siswa">
                    <a href="{{ route('admin.payment.create', $value->id) }}" class="text-white font-weight-bold text-xs">
                      Bayar
                      <!-- <i class="ni ni-credit-card pt-1" aria-hidden="true">bayar</i> -->
                    </a>
                  </button>

                  <!-- <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Siswa">
                    <a href="{{ route('admin.payment.edit', $value->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                    </a>
                  </button> -->


                  <form action="{{ route('admin.payment.destroy', $value->id) }}" method="POST" style="display:inline-block;">
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