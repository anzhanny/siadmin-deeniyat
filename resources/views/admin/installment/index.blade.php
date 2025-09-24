@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between mb-0">
          <a href="{{ route('admin.installment.create') }}">
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
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Kode Pembayaran</th>
                <th>Cicilan ke</th>
                <th>Nominal</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($data as $value)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->payment->user->name ?? '-' }}</td>
                <td>{{ $value->payment->user->class->class_name ?? '-' }}</td>
                <td>{{ $value->payment->code }}</td>
                <td>{{ $value->installments_to }}</td>
                <td>Rp {{ number_format($value->nominal, 0, ',', '.') }}</td>
                <td>{{ $value->due_date?->format('d-m-Y') ?? '-' }}</td>

                <td>
                  @if ($value->status === 'paid')
                    <span class="badge bg-success">
                      Lunas ({{ $value->paid_at?->format('d-m-Y') }})
                    </span>
                  @elseif ($value->status === 'overdue')
                    <span class="badge bg-danger">Terlambat</span>
                  @else
                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                  @endif
                </td>

                <td>
                  {{ $value->payment->installments->where('status','paid')->count() }}
                  / {{ $value->payment->installments->count() }} cicilan
                </td>

                <td>
                  <a href="{{ route('admin.installment.show', $value->id) }}" 
                     class="btn btn-info btn-sm" title="Detail">
                    <i class="fa fa-eye"></i>
                  </a>
                  
                  <a href="{{ route('admin.installment.edit', $value->id) }}" 
                     class="btn btn-primary btn-sm" title="Edit">
                    <i class="fa fa-edit"></i>
                  </a>

                  <form action="{{ route('admin.installment.destroy', $value->id) }}"
                        method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                      onclick="return confirm('Yakin mau hapus data ini?')"
                      title="Hapus">
                      <i class="fa fa-trash"></i>
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
@endsection
