@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Data Pembayaran</h6>
                <div>
                    <!-- Tombol buka modal generate SPP -->
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#generateSppModal">
                        <i class="fa fa-envelope"></i> Generate & Kirim Tagihan SPP
                    </button>
                </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">

                <div class="table-responsive p-0">
                    <form method="GET" action="{{ route('admin.report.index') }}" class="row g-2 align-items-end">

                        {{-- Filter Order ID --}}
                        <div class="col-md-3">
                            <label class="form-label">Order ID</label>
                            <input type="text" name="order_id" class="form-control"
                                value="{{ request('order_id') }}" placeholder="Cari Order ID...">
                        </div>

                        {{-- Filter Status --}}
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua</option>
                                <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Paid</option>
                                <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                                <option value="failed" {{ request('status')=='failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                        {{-- Filter Date Range --}}
                        <div class="col-md-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" name="date_range" id="date_range" class="form-control"
                                value="{{ request('date_range') }}" placeholder="Pilih rentang tanggal">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Apply</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.report.index') }}" class="btn btn-secondary w-100">Clear</a>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="export" value="excel" class="btn btn-success w-100">Export Excel</button>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="export" value="pdf" class="btn btn-danger w-100">Export PDF</button>
                        </div>

                    </form>

                    <table class="table text-center align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kode Pembayaran</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Siswa</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jenis</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tipe</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kategori</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jumlah</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Progress</th>
                                <th class="text-center text-dark text-uppercase text-xs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($data) && $data->isNotEmpty())
                            @foreach($data as $index => $value)
                            {{-- Parent row: ringkasan payment --}}
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    {{ $loop->iteration + (method_exists($data,'firstItem') ? $data->firstItem() - 1 : 0) }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge bg-dark">{{ $value->code }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $value->user->name ?? '-' }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $value->user->class->class_name ?? '-' }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $value->payment_for ?? '-' }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ ucfirst($value->payment_type ?? '-') }}
                                </td>
                                {{-- Kolom kategori --}}
                                <td class="align-middle text-center text-sm">
                                    @if($value->payment_category === 'cicilan')
                                    <span class="badge bg-info text-dark">Secara Cicilan</span>
                                    @elseif($value->payment_category === 'lunas')
                                    <span class="badge bg-primary">Secara Lunas</span>
                                    @else
                                    <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>


                                <!-- {{-- Kolom status --}}
<td class="align-middle text-center text-sm">
  @if($value->payment_category === 'cicilan')
      @php
          $paidCount = $value->installments->where('status','paid')->count();
          $totalCount = $value->installments->count();
      @endphp
      @if($totalCount > 0 && $paidCount === $totalCount)
          <span class="badge bg-success">Paid</span>
      @else
          <span class="badge bg-warning">Pending</span>
      @endif
  @else
      @if($value->status === 'paid')
          <span class="badge bg-success">Paid</span>
      @elseif($value->status === 'pending')
          <span class="badge bg-warning">Pending</span>
      @else
          <span class="badge bg-danger">{{ ucfirst($value->status) }}</span>
      @endif
  @endif
</td> -->


                                <td class="align-middle text-center text-sm">
                                    Rp {{ number_format($value->amount ?? 0,0,',','.') }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($value->payment_category === 'cicilan')
                                    @php
                                    $paidCount = $value->installments->where('status','paid')->count();
                                    $totalCount = $value->installments->count();
                                    @endphp

                                    @if($totalCount > 0 && $paidCount === $totalCount)
                                    <span class="badge bg-success">Paid</span>
                                    @else
                                    <span class="badge bg-warning">Pending</span>
                                    @endif
                                    @else
                                    @if($value->status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                    @elseif($value->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @else
                                    <span class="badge bg-danger">{{ ucfirst($value->status) }}</span>
                                    @endif
                                    @endif
                                </td>

                                <td class="align-middle text-center text-sm">
                                    @if($value->payment_category === 'cicilan')
                                    @php
                                    $paidCount = $value->installments->where('status','paid')->count();
                                    $totalCount = $value->installments->count();
                                    $percent = $totalCount > 0 ? (int) round(($paidCount / $totalCount) * 100) : 0;
                                    @endphp

                                    <div class="d-flex flex-column align-items-center">
                                        <div style="width:140px;">
                                            <div class="progress" style="height:14px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $percent }}%;"
                                                    aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted mt-1">{{ $paidCount }} / {{ $totalCount }} cicilan ({{ $percent }}%)</small>
                                    </div>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{-- tombol collapse detail jika cicilan --}}
                                    @if($value->payment_category === 'cicilan')
                                    <button class="btn btn-sm btn-secondary  btn-icon btn-sm p-1" style="width: 30px; height: 30px;" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#cicilan-{{ $value->id }}">
                                        <i class="fa fa-chevron-down"></i>
                                    </button>
                                    @endif

                                    {{-- tombol detail --}}
                                    <a href="{{ route('admin.payment.show', $value->id) }}"
                                        class="btn btn-sm btn-info  btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    {{-- tombol toggle status --}}
                                    <form action="{{ route('admin.payment.updateStatus', $value->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ubah status pembayaran ini?');">
                                        @csrf
                                        @method('PUT')
                                        @if($value->status === 'paid')
                                        <button type="submit" class="btn btn-sm btn-warning  btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Batalkan Pembayaran">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-sm btn-success  btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Tandai Sebagai Lunas">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>


                            {{-- Jika kategori cicilan -> tampilkan tiap installment --}}
                            @if($value->payment_category === 'cicilan' && $value->installments->count() > 0)
                            <tr class="collapse bg-light" id="cicilan-{{ $value->id }}">
                                <td colspan="11">
                                    <div class="p-2">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead>
                                                <tr class="bg-light text-white">
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7"> </th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kode Pembayaran</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama Siswa</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jenis</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tipe</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Cicilan Ke</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jumlah</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jatuh Tempo</th>
                                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($value->installments as $i => $installment)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">{{ $i + 1 }}</td>
                                                    <td class="align-middle text-center text-sm">{{ $value->code }}-{{ $installment->installments_to }}</td>
                                                    <td class="align-middle text-center text-sm">{{ $value->user->name ?? '-' }}</td>
                                                    <td class="align-middle text-center text-sm">{{ $value->user->class->class_name ?? '-' }}</td>
                                                    <td class="align-middle text-center text-sm">{{ $value->payment_for ?? '-' }}</td>
                                                    <td class="align-middle text-center text-sm">{{ ucfirst($value->payment_type ?? '-') }}</td>
                                                    <td class="align-middle text-center text-sm">Cicilan ke-{{ $installment->installments_to }}</td>
                                                    <td class="align-middle text-center text-sm">Rp {{ number_format($installment->nominal ?? 0,0,',','.') }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        @if($installment->status === 'paid')
                                                        <span class="badge bg-success">Paid</span>
                                                        @elseif($installment->status === 'overdue')
                                                        <span class="badge bg-danger">Overdue</span>
                                                        @else
                                                        <span class="badge bg-warning text-dark">No Transaction</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle text-center text-sm">{{ $installment->due_date?->format('d-m-Y') ?? '-' }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary btn-set-due btn-icon btn-sm p-1"
                                                            style="width: 30px; height: 30px;"
                                                            data-action="{{ route('admin.installment.updateDueDate', $installment->id) }}"
                                                            data-duedate="{{ optional($installment->due_date)->format('Y-m-d') }}"
                                                            data-code="{{ $value->code }} - Cicilan {{ $installment->installments_to }}"

                                                            title="Atur Jatuh Tempo">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>

                                                        {{-- tombol toggle status installment--}}
                                                        <form action="{{ route('admin.installment.updateStatus', $installment->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ubah status cicilan ini?');">
                                                            @csrf
                                                            @method('PUT')
                                                            @if($installment->status === 'paid')
                                                            <button type="submit" class="btn btn-sm btn-warning btn-icon p-1"
                                                                style="width: 30px; height: 30px;"
                                                                title="Batalkan Pembayaran Cicilan">
                                                                <i class="fa fa-undo"></i>
                                                            </button>
                                                            @else
                                                            <button type="submit" class="btn btn-sm btn-success btn-icon p-1"
                                                                style="width: 30px; height: 30px;"
                                                                title="Tandai Cicilan Lunas">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            @endif
                                                        </form>

                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endif

                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center text-muted">Belum ada data pembayaran</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <!-- Modal: Set Due Date -->
        <div class="modal fade" id="dueDateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form id="dueDateForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Atur Jatuh Tempo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required>
                            </div>
                            <div id="modal-info" class="text-sm text-muted"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal: Generate SPP -->
        <div class="modal fade" id="generateSppModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.payment.generateSPP') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Generate & Kirim Tagihan SPP</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="month" class="form-label">Bulan</label>
                                <input type="text" name="month" id="month" class="form-control" placeholder="Contoh: Juli" required>
                            </div>
                            <div class="mb-2">
                                <label for="year" class="form-label">Tahun</label>
                                <input type="number" name="year" id="year" class="form-control" value="{{ date('Y') }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="amount" class="form-label">Jumlah (Rp)</label>
                                <input type="number" name="amount" id="amount" class="form-control" value="50000" required>
                            </div>
                            <div class="mb-2">
                                <label for="class_id" class="form-label">Kelas (opsional)</label>
                                <select name="class_id" id="class_id" class="form-select">
                                    <option value="">Semua Kelas</option>
                                    @foreach(\App\Models\TbClass::all() as $c)
                                    <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="text-muted">Sistem akan melewatkan siswa yang sudah memiliki tagihan SPP untuk bulan/tahun yang sama.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success btn-sm">Generate & Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Set Due Date -->
        <div class="modal fade" id="modalSetDueDate" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="formSetDueDate" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Atur Jatuh Tempo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Cicilan</label>
                                <input type="text" id="dueCode" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jatuh Tempo</label>
                                <input type="date" id="dueDate" name="due_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

{{-- Script Sortir Table --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#date_range').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoUpdateInput: false,
        });

        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>

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

<!-- JS: handle set due date button -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-set-due').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                const dueDate = this.getAttribute('data-duedate') || '';
                const code = this.getAttribute('data-code') || '';

                const form = document.getElementById('dueDateForm');
                form.action = action;
                document.getElementById('due_date').value = dueDate;
                document.getElementById('modal-info').innerText = code;
                var modalEl = document.getElementById('dueDateModal');
                var modal = new bootstrap.Modal(modalEl);
                modal.show();
            });
        });
    });
</script>
@endsection