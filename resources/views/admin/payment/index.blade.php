@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center text-xs ">
        <h6 class="mb-0"></h6>
        
        <div>
          <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#generateSppModal">
            <i class="fa fa-envelope"></i> Generate & Kirim Tagihan SPP
          </button>
          <a href="{{ route('admin.payment.export', request()->query()) }}" class="btn btn-success btn-sm">
            <i class="fa fa-file-excel"></i> Ekspor Laporan
          </a>
        </div>
      </div>
      <div class="card-body px-3 pt-3 pb-2 ">

       {{-- 🔍 Filter --}}
<form method="GET" action="{{ route('admin.payment.index') }}" 
      class="row g-2 align-items-end mb-3 text-sm">

  {{-- 🔍 Cari Siswa --}}
  <div class="col-md-2">
    <label class="form-label mb-1 text-xs">Cari Siswa</label>
    <div class="input-group input-group-sm">
      <span class="input-group-text text-body"><i class="fas fa-search"></i></span>
      <input type="text" class="form-control" name="search" 
             value="{{ request('search') }}" placeholder="Nama siswa...">
    </div>
  </div>

  {{-- 📘 Kelas --}}
  <div class="col-md-2">
    <label class="form-label mb-1 text-xs">Kelas</label>
    <select name="class_id" class="form-select form-select-sm">
      <option value="">-- Semua --</option>
      @foreach($classes as $class)
        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
          {{ $class->class_name }}
        </option>
      @endforeach
    </select>
  </div>

  {{-- 💳 Jenis Pembayaran --}}
  <div class="col-md-2">
    <label class="form-label mb-1 text-xs">Jenis</label>
    <select name="payment_for" class="form-select form-select-sm">
      <option value="">-- Semua --</option>
      <option value="spp" {{ request('payment_for') == 'spp' ? 'selected' : '' }}>SPP</option>
      <option value="register" {{ request('payment_for') == 'register' ? 'selected' : '' }}>Register</option>
    </select>
  </div>

  {{-- 🧾 Status --}}
  <div class="col-md-2">
    <label class="form-label mb-1 text-xs">Status</label>
    <select name="status" class="form-select form-select-sm">
      <option value="">-- Semua --</option>
      <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
      <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
      <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Batal</option>
    </select>
  </div>

  {{-- 💰 Kategori --}}
  <div class="col-md-2">
    <label class="form-label mb-1 text-xs">Kategori</label>
    <select name="payment_category" class="form-select form-select-sm">
      <option value="">-- Semua --</option>
      <option value="lunas" {{ request('payment_category') == 'lunas' ? 'selected' : '' }}>Bayar Lunas</option>
      <option value="cicilan" {{ request('payment_category') == 'cicilan' ? 'selected' : '' }}>Bayar Cicilan</option>
    </select>
  </div>

  {{-- 📅 Rentang Tanggal --}}
<div class="col-md-3 d-flex align-items-center gap-2">
  <div>
    <label class="text-xs mb-0">Tgl Mulai</label>
    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control form-control-sm">
  </div>
  <div>
    <label class="text-xs mb-0">Tgl Akhir</label>
    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control form-control-sm">
  </div>
</div>

  {{-- 🔘 Tombol --}}
  <div class="col-md-2 d-flex gap-2 justify-content-end" style="margin-left: 100px; margin-top: 20px; margin-bottom: -16px">
    <label for=""></label>
    <button type="submit" class="btn btn-primary btn-sm w-100">Cari</button>
    <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary btn-sm w-100">Reset</a>
  </div>

</form>
@if(request('start_date') || request('end_date'))
  <div class="alert alert-success text-sm text-white">
    <strong>Pemasukan pendapatan rentang tersebut:</strong> 
    Rp {{ number_format($totalIncome, 0, ',', '.') }}
  </div>
@endif
</div>




        {{-- 📊 Tabel Data --}}
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">No</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kode Pembayaran</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Siswa</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kelas</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jenis</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kategori</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nominal</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Keterangan</th>
                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = ($payments->currentPage() - 1) * $payments->perPage() + 1;
              $shownInstallments = [];
              @endphp

              @foreach($payments as $payment)
              {{-- Skip duplikat cicilan --}}
              @if($payment->payment_category === 'cicilan' && in_array($payment->installment_id, $shownInstallments))
              @continue
              @elseif($payment->payment_category === 'cicilan')
              @php $shownInstallments[] = $payment->installment_id; @endphp
              @endif

              <tr>
                <td class="align-middle text-center text-sm">{{ $no++ }}</td>
                <td class="align-middle text-center text-sm"><span class="badge bg-dark text-white">{{ $payment->code }}</span></td>
                <td class="align-middle text-center text-sm">{{ optional(optional($payment->installment)->user)->name ?? optional($payment->user)->name ?? '-' }}</td>
                <td class="align-middle text-center text-sm">{{ optional(optional(optional($payment->installment)->user)->class)->class_name ?? optional(optional($payment->user)->class)->class_name ?? '-' }}</td>
                <td class="align-middle text-center text-sm">
                  @if($payment->payment_for == 'register')
                  <span class="badge bg-info text-dark">Register</span>
                  @elseif($payment->payment_for == 'spp')
                  <span class="badge bg-primary text-white">SPP</span>
                  @endif
                </td>
                <td class="align-middle text-center text-sm">
                  @if($payment->payment_category == 'lunas')
                  <span class="badge bg-success text-white">Bayar Lunas</span>
                  @elseif($payment->payment_category == 'cicilan')
                  <span class="badge bg-info text-white">Bayar Cicilan</span>
                  @endif
                </td>
                <td class="align-middle text-center text-sm">
                  @if($payment->payment_category === 'lunas')
                  Rp {{ number_format($payment->amount, 0, ',', '.') }}
                  @elseif($payment->payment_category === 'cicilan' && $payment->installment)
                  Rp {{ number_format($payment->installment->nominal, 0, ',', '.') }}
                  @else
                  -
                  @endif
                </td>
                <td class="align-middle text-center text-sm">
                  @php
                  if($payment->payment_category === 'cicilan' && $payment->installment){
                  $status = $payment->installment->status;
                  } else {
                  $status = $payment->status;
                  }
                  @endphp

                  @if($status === 'paid')
                  <span class="badge bg-success">Lunas</span>
                  @elseif($status === 'partial')
                  <span class="badge bg-info">Sebagian</span>
                  @elseif($status === 'pending')
                  <span class="badge bg-warning">Menunggu</span>
                  @elseif($status === 'failed')
                  <span class="badge bg-danger">Batal</span>
                  @else
                  <span class="badge bg-dark">{{ ucfirst($status) }}</span>
                  @endif
                </td>
                <!-- <td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') : '-' }}</td> -->
                <td class="align-middle text-center text-xxs">
                  @if($payment->payment_category === 'cicilan')
                  @if($payment->installment?->due_date)
                  Jatuh tempo: <br> {{ \Carbon\Carbon::parse($payment->installment->due_date)->format('d M Y') }}
                  @else
                  Jatuh tempo: -
                  @endif
                  @else
                  @if($payment->paid_at)
                  Tgl bayar: <br> {{ \Carbon\Carbon::parse($payment->paid_at)->format('d M Y') }}
                  @else
                  Tgl bayar: -
                  @endif
                  @endif
                </td>


                <td>
                  {{-- Tombol Lunas --}}
                  @if($payment->payment_category === 'lunas')
                  <form action="{{ route('admin.payment.updateStatus', $payment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')

                    @if($payment->status === 'pending')
                    <button type="submit" name="status" value="paid" class="btn btn-sm btn-success btn-icon btn-sm p-1"
                      style="width: 30px; height: 30px;" title="Tandai Lunas" onclick="return confirm('Yakin tandai LUNAS?');">
                      <i class="fa fa-check"></i>
                    </button>

                    <button type="submit" name="status" value="failed" class="btn btn-sm btn-danger btn-icon p-1" style="width: 30px; height: 30px;" title="Tandai Batal" onclick="return confirm('Yakin tandai BATAL?');">
                      <i class="fa fa-times"></i>
                    </button>
                    @elseif($payment->status === 'paid')
                    <button type="submit" name="status" value="pending" class="btn btn-sm btn-danger btn-icon p-1" style="width: 30px; height: 30px;" title="Batalkan Pembayaran" onclick="return confirm('Yakin batalkan pembayaran ini?');">
                      <i class="fa fa-undo"></i>
                    </button>
                    @elseif($payment->status === 'failed')
                    <button type="submit" name="status" value="paid" class="btn btn-sm btn-success btn-icon p-1" style="width: 30px; height: 30px;" title="Tandai Lunas" onclick="return confirm('Yakin tandai LUNAS?');">
                      <i class="fa fa-check"></i>
                    </button>
                    <button type="submit" name="status" value="pending" class="btn btn-sm btn-warning btn-icon p-1" style="width: 30px; height: 30px;" title="Kembalikan ke Menunggu" onclick="return confirm('Kembalikan ke MENUNGGU?');">
                      <i class="fa fa-clock"></i>
                    </button>
                    @endif
                  </form>

                  @endif

                  {{-- Tombol collapse cicilan --}}
                  @if($payment->payment_category === 'cicilan' && $payment->installment_id)
                  <button class="btn btn-sm btn-secondary  btn-icon btn-sm p-1"
                    style="width: 30px; height: 30px;" type="button" data-bs-toggle="collapse" data-bs-target="#cicilan-{{ $payment->installment_id }}">
                    <i class="fa fa-list"></i>
                  </button>
                  @endif

                  {{-- Tombol detail --}}
                  <!-- <a href="{{ route('admin.payment.show', $payment->id) }}" class="btn btn-sm btn-primary  btn-icon btn-sm p-1"
                    style="width: 30px; height: 30px;">
                    <i class="fa fa-eye"></i>
                  </a> -->
                  <!-- <button type="button" class="btn btn-info btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Detail Pembayaran Siswa">
                    <a href="{{ route('admin.payment.show', $payment->id) }}" class="text-white font-weight-bold text-xs">
                      <i class="fa fa-eye pt-1" aria-hidden="true"></i>
                    </a>
                  </button> -->
                </td>
              </tr>

              {{-- Detail Cicilan --}}
              @if($payment->payment_category === 'cicilan' && $payment->installment && $payment->installment->payments->count() > 0)
              <tr>
                <td colspan="10" class="p-0">
                  <div class="collapse" id="cicilan-{{ $payment->installment_id }}">
                    <div class="p-2">
                      <table class="table table-sm table-bordered mb-0">
                        <thead class="bg-secondary text-white">
                          <tr>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">#</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Kode Pembayaran</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Nama Siswa</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Cicilan Ke</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Nominal</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Status</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Tanggal Bayar</th>
                            <th class="text-center text-uppercase text-white text-xs font-weight-bolder opacity-7">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($payment->installment->payments as $i => $cicilan)
                          <tr>
                            <td class="align-middle text-center text-sm">{{ $i+1 }}</td>
                            <td class="align-middle text-center text-sm"><span class="badge bg-light text-dark">{{ $cicilan->code }}</span></td>
                            <td class="align-middle text-center text-sm">{{ optional($cicilan->user)->name ?? '-' }}</td>
                            <td class="align-middle text-center text-sm">Cicilan ke-{{ $cicilan->installment_to }}</td>
                            <td class="align-middle text-center text-sm">Rp {{ number_format($cicilan->amount,0,',','.') }}</td>
                            <td class="align-middle text-center text-sm">
                              @if($cicilan->status === 'paid') <span class="badge bg-success">Lunas</span>
                              @elseif($cicilan->status === 'partial') <span class="badge bg-info">Sebagian</span>
                              @elseif($cicilan->status === 'pending') <span class="badge bg-warning">Menunggu</span>
                              @elseif($cicilan->status === 'failed') <span class="badge bg-danger">Batal</span>
                              @else <span class="badge bg-danger">{{ ucfirst($cicilan->status) }}</span>
                              @endif
                            </td>
                            <td class="align-middle text-center text-sm">
                              {{ $cicilan->due_date ? \Carbon\Carbon::parse($cicilan->due_date)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="align-middle text-center text-sm">
                              {{-- Cicilan LUNAS -> bisa kembalikan ke pending --}}
                              @if($cicilan->status === 'paid')
                              <form action="{{ route('admin.payment.updateStatus', $cicilan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ubah status cicilan ini?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="pending">
                                <button class="btn btn-sm btn-warning btn-icon p-1" style="width: 30px; height: 30px;" title="Batalkan Pembayaran">
                                  <i class="fa fa-undo"></i>
                                </button>
                              </form>
                              @endif

                              {{-- Cicilan PENDING -> bisa jadi paid atau failed --}}
                              @if($cicilan->status === 'pending')
                              <form action="{{ route('admin.payment.updateStatus', $cicilan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin tandai LUNAS?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="paid">
                                <button class="btn btn-sm btn-success btn-icon p-1" style="width: 30px; height: 30px;" title="Tandai Lunas">
                                  <i class="fa fa-check"></i>
                                </button>
                              </form>

                              <form action="{{ route('admin.payment.updateStatus', $cicilan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin batalkan cicilan ini?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="failed">
                                <button class="btn btn-sm btn-danger btn-icon p-1" style="width: 30px; height: 30px;" title="Tandai Batal">
                                  <i class="fa fa-times"></i>
                                </button>
                              </form>
                              @endif

                              {{-- Cicilan FAILED -> bisa jadi paid atau pending --}}
                              @if($cicilan->status === 'failed')
                              <form action="{{ route('admin.payment.updateStatus', $cicilan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin tandai LUNAS?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="paid">
                                <button class="btn btn-sm btn-success btn-icon p-1" style="width: 30px; height: 30px;" title="Tandai Lunas">
                                  <i class="fa fa-check"></i>
                                </button>
                              </form>

                              <form action="{{ route('admin.payment.updateStatus', $cicilan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin kembalikan ke MENUNGGU?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="pending">
                                <button class="btn btn-sm btn-warning btn-icon p-1" style="width: 30px; height: 30px;" title="Kembalikan Menunggu">
                                  <i class="fa fa-clock"></i>
                                </button>
                              </form>
                              @endif

                              {{-- Tombol atur jatuh tempo --}}
                              <!-- Tombol Set Due Date -->
                              <!-- <button type="button"
                                class="btn btn-sm btn-primary btn-icon p-1 btn-set-due"
                                style="width: 30px; height: 30px;"
                                title="Atur Jatuh Tempo"
                                data-bs-toggle="modal"
                                data-bs-target="#dueDateModal"
                                data-action="{{ route('admin.payment.updatePaymentDueDate', $payment->id) }}"
                                data-date="{{ $payment->due_date ? \Carbon\Carbon::parse($payment->due_date)->format('Y-m-d') : '' }}">
                                <i class="fas fa-calendar-alt"></i>
                              </button> -->

                            </td>

                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </td>
              </tr>
              @endif

              @endforeach
            </tbody>
          </table>
        </div>

        <div class="card-footer d-flex justify-content-center">
          {{ $payments->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>


  <!-- Modal: Atur Jatuh Tempo 
  <div class="modal fade" id="dueDateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form id="dueDateForm" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atur Jatuh Tempo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div> -->




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
  <select name="month" id="month" class="form-control" required>
    <option value="">-- Pilih Bulan --</option>
    <option value="Januari" {{ request('month') == 'Januari' ? 'selected' : '' }}>Januari</option>
    <option value="Februari" {{ request('month') == 'Februari' ? 'selected' : '' }}>Februari</option>
    <option value="Maret" {{ request('month') == 'Maret' ? 'selected' : '' }}>Maret</option>
    <option value="April" {{ request('month') == 'April' ? 'selected' : '' }}>April</option>
    <option value="Mei" {{ request('month') == 'Mei' ? 'selected' : '' }}>Mei</option>
    <option value="Juni" {{ request('month') == 'Juni' ? 'selected' : '' }}>Juni</option>
    <option value="Juli" {{ request('month') == 'Juli' ? 'selected' : '' }}>Juli</option>
    <option value="Agustus" {{ request('month') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
    <option value="September" {{ request('month') == 'September' ? 'selected' : '' }}>September</option>
    <option value="Oktober" {{ request('month') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
    <option value="November" {{ request('month') == 'November' ? 'November' : '' }}>November</option>
    <option value="Desember" {{ request('month') == 'Desember' ? 'selected' : '' }}>Desember</option>
  </select>
</div>

<div class="mb-2">
  <label for="year" class="form-label">Tahun</label>
  <select name="year" id="year" class="form-control" required>
    <option value="">-- Pilih Tahun --</option>
    @php
      $currentYear = date('Y');
      for ($i = $currentYear - 5; $i <= $currentYear + 10; $i++) {
          $selected = request('year') == $i ? 'selected' : '';
          echo "<option value='{$i}' {$selected}>{$i}</option>";
      }
    @endphp
  </select>
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
            <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
          </div>
        </div>
      </form>
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

    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";
    rows.forEach(row => tbody.appendChild(row));
  }
</script>

<!-- JS: handle set due date button -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var dueDateModal = document.getElementById('dueDateModal');

    dueDateModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var action = button.getAttribute('data-action');
      var due_date = button.getAttribute('data-date');

      var form = dueDateModal.querySelector('#dueDateForm');
      var dateInput = dueDateModal.querySelector('#due_date');

      form.setAttribute('action', action); // inject action route ke form
      dateInput.value = due_date; // inject tanggal lama
    });
  });
</script>


<!-- cdn bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection