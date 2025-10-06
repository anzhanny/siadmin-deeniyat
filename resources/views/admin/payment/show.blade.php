@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Detail Pembayaran "{{ $payment->user->name ?? '-' }}"</h6>
      </div>
      <div class="card-body px-4 py-3">

        {{-- Info utama --}}
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>Nama Siswa</th>
              <td>{{ $payment->user->name ?? '-' }}</td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td>{{ $payment->user->class->class_name ?? '-' }}</td>
            </tr>
            <tr>
              <th>Kategori Pembayaran</th>
              <td>{{ ucfirst($payment->payment_category) }}</td>
            </tr>
            <tr>
              <th>Jumlah</th>
              <td>Rp {{ number_format($payment->amount ?? 0,0,',','.') }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                @if($payment->status === 'paid')
                  <span class="badge bg-success">Lunas</span>
                @elseif($payment->status === 'pending')
                  <span class="badge bg-warning text-dark">Menunggu</span>
                @elseif($payment->status === 'failed')
                  <span class="badge bg-danger">Batal</span>
                @else
                  <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                @endif
              </td>
            </tr>
            <tr>
              <th>Waktu Bayar</th>
              <td>{{ $payment->paid_at?->format('d-m-Y H:i') ?? '-' }}</td>
            </tr>
          </table>
        </div>

        {{-- Jika cicilan --}}
        @if($payment->payment_category === 'cicilan' && $payment->installment)
        <div class="mt-4">
          <h6>Rincian Cicilan</h6>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead class="bg-dark text-white">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Cicilan Ke</th>
                  <th class="text-center">Nominal</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Jatuh Tempo</th>
                  <th class="text-center">Tanggal Bayar</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payment->installment->payments as $i => $p)
                <tr class="text-center">
                  <td>{{ $i+1 }}</td>
                  <td>{{ $p->installment_to }}</td>
                  <td>Rp {{ number_format($p->amount ?? 0,0,',','.') }}</td>
                  <td>
                    @if($p->status === 'paid')
                      <span class="badge bg-success">Lunas</span>
                    @elseif($p->status === 'pending')
                      <span class="badge bg-warning text-dark">Menunggu</span>
                    @elseif($p->status === 'failed')
                      <span class="badge bg-danger">Batal</span>
                    @else
                      <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                    @endif
                  </td>
                  <td>{{ $p->due_date?->format('d-m-Y') ?? '-' }}</td>
                  <td>{{ $p->paid_at?->format('d-m-Y H:i') ?? '-' }}</td>
                  <td>
                    {{-- Update status --}}
                    <form action="{{ route('admin.payment.updateStatus', $p->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('PUT')
                      @if($p->status === 'pending')
                        <button type="submit" name="status" value="paid" class="btn btn-sm btn-success" onclick="return confirm('Tandai LUNAS?');">✔</button>
                        <button type="submit" name="status" value="failed" class="btn btn-sm btn-secondary" onclick="return confirm('Tandai BATAL?');">✖</button>
                      @elseif($p->status === 'paid')
                        <button type="submit" name="status" value="pending" class="btn btn-sm btn-warning" onclick="return confirm('Kembalikan ke MENUNGGU?');">↺</button>
                      @elseif($p->status === 'failed')
                        <button type="submit" name="status" value="paid" class="btn btn-sm btn-success" onclick="return confirm('Tandai LUNAS?');">✔</button>
                        <button type="submit" name="status" value="pending" class="btn btn-sm btn-warning" onclick="return confirm('Kembalikan ke MENUNGGU?');">↺</button>
                      @endif
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif

        <div class="text-end mt-3">
          <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
