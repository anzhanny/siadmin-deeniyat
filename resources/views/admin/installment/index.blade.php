@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">

      <div class="card-header pb-0">
        <div class="d-flex justify-content-between mb-0">
          <!-- tambah data -->
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
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Payment ID</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nominal</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Angsuran ke</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tanggal Bayar</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Sisa Saldo</th>
                <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
              </tr>
              <?php $no = 1; ?>
            </thead>

            <tbody>
              @foreach ($installment as $value)
              <tr>
                <td>{{ $installment->firstItem() + $loop->index }}</td>
                <td class="align-middle text-center text-sm">{{ $value->payment_id }}</td>
                <td class="align-middle text-center text-sm">{{ $value->nominal }}</td>
                <td class="align-middle text-center text-sm">{{ $value->installments_to }}</td>
                <td class="align-middle text-center text-sm">{{ $value->paid_at }}</td>
                <td class="align-middle text-center text-sm">{{ $value->remaining_balance }}</td>
                <td class="align-middle">
                  <button type="button" class="btn btn-primary btn-icon btn-sm p-1"
                          style="width: 30px; height: 30px;" title="Edit Data">
                    <a href="{{ route('admin.installment.edit', $value->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                    </a>
                  </button>

                  <form action="{{ route('admin.installment.destroy', $value->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-danger btn-icon btn-sm p-1"
                            style="width: 30px; height: 30px;"
                            title="Hapus Data"
                            onclick="return confirm('Yakin mau hapus data ini?')">
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
        {{ $installment->links('pagination::bootstrap-5') }}
      </div>
    </nav>

  </div>
</div>
@endsection
