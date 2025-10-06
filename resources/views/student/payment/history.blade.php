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

                            {{-- tampilkan cicilan --}}
                            @foreach ($installments as $installment)
                            @foreach ($installment->payments as $payment)
                            <tr>
                                <td>{{ $rowNumber++ }}</td>
                                <td>{{ $payment->code }}</td>
                                <td>{{ $payment->payment_for }}<br>
                                    <small class="text-muted">Cicilan ke-{{ $installment->installments_to }}</small>
                                </td>
                                <td><span class="text-primary">Cicilan</span></td>
                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($payment->status === 'paid')
                                    <span class="badge bg-success">Sukses</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td>{{ $payment->paid_at ? $payment->paid_at->format('d-m-Y') : '-' }}</td>
                            </tr>
                            @endforeach
                            @endforeach

                            {{-- tampilkan pembayaran langsung --}}
                            @foreach ($directPayments as $payment)
                            <tr>
                                <td>{{ $rowNumber++ }}</td>
                                <td>{{ $payment->code }}</td>
                                <td>{{ $payment->payment_for }}</td>
                                <td>{{ ucfirst($payment->payment_category) }}</td>
                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($payment->status === 'paid')
                                    <span class="badge bg-success">Sukses</span>
                                    @elseif($payment->status === 'failed')
                                    <span class="badge bg-danger">Gagal</span>
                                    @else
                                    <span class="badge bg-warning">Menunggu</span>
                                    @endif
                                </td>
                                <td>{{ $payment->paid_at ? $payment->paid_at->format('d-m-Y') : '-' }}</td>
                            </tr>
                            @endforeach

                            @if($installments->isEmpty() && $directPayments->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Belum ada riwayat pembayaran</td>
                            </tr>
                            @endif


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection