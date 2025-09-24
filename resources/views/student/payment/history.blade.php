@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 ">
            <div class="card-header pb-0">
                <h6>Riwayat Pembayaran</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table text-center align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">#</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kode</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Pembayaran</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kategori</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jumlah</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
    @php $rowNumber = 1; @endphp
    @forelse ($payments as $payment)
        @if($payment->payment_category === 'cicilan')
            {{-- tampilkan installment per cicilan --}}
            @foreach($payment->installments as $installment)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $rowNumber++ }}</td>
                    <td class="align-middle text-center text-sm">{{ $payment->code }}</td>
                    <td class="align-middle text-center text-sm">
                        {{ $payment->payment_for }}<br>
                        <small class="text-muted">Cicilan ke-{{ $installment->installments_to }}</small>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="text-primary">Cicilan</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        Rp {{ number_format($installment->nominal, 0, ',', '.') }}
                    </td>
                    <td class="align-middle text-center text-sm">
                        @if($installment->status === 'paid')
                            <span class="badge bg-success text-white">Paid</span>
                        @elseif($installment->status === 'overdue')
                            <span class="badge bg-danger text-white">Overdue</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
                    <td class="align-middle text-center text-sm">
                        {{ $installment->paid_at ? $installment->paid_at->format('d-m-Y') : '-' }}
                    </td>
                </tr>
            @endforeach
        @else
            {{-- tampilkan pembayaran normal (register lunas/tunai, atau spp lunas) --}}
            <tr>
                <td class="align-middle text-center text-sm">{{ $rowNumber++ }}</td>
                <td class="align-middle text-center text-sm">{{ $payment->code }}</td>
                <td class="align-middle text-center text-sm">{{ $payment->payment_for }}</td>
                <td class="align-middle text-center text-sm">
                    {{ ucfirst($payment->payment_category) }}
                </td>
                <td class="align-middle text-center text-sm">
                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                </td>
                <td class="align-middle text-center text-sm">
                    @if($payment->status === 'paid')
                        <span class="badge bg-success text-white">Paid</span>
                    @else
                        <span class="badge bg-danger text-white">Pending</span>
                    @endif
                </td>
                <td class="align-middle text-center text-sm">
                    {{ $payment->paid_at ? $payment->paid_at->format('d-m-Y') : '-' }}
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada riwayat pembayaran</td>
        </tr>
    @endforelse
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
