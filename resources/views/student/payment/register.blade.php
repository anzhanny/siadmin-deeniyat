@extends('layouts.layout')

@section('content')
    <h3 class="mb-4">Pembayaran Pendaftaran</h3>

    {{-- ✅ Sudah lunas --}}
    @if($payment && $payment->status == 'paid' && $payment->payment_category == 'lunas')
        <div class="alert alert-success text-center">
            ✅ Anda sudah melunasi biaya pendaftaran.
        </div>

    {{-- ⚠️ Cicilan --}}
    @elseif($payment && $payment->payment_category == 'cicilan')
        <div class="alert alert-warning">
            Anda memilih pembayaran dengan cicilan (3x).
        </div>

        <h5>Detail Cicilan</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Cicilan</th>
                    <th>Jumlah</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payment->installments as $i)
                    <tr>
                        <td>Cicilan ke-{{ $i->installment_no }}</td>
                        <td>Rp {{ number_format($i->amount, 0, ',', '.') }}</td>
                        <td>{{ $i->due_end->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $i->status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($i->status) }}
                            </span>
                        </td>
                        <td>
                            @if($i->status != 'paid')
                                <a href="{{ route('student.payment.installment.pay', $i->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    Bayar Sekarang
                                </a>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{-- ⏳ Masih pending (belum lunas & bukan cicilan) --}}
    @elseif($payment && $payment->status == 'pending')
        <div class="alert alert-info text-center">
            ⏳ Pembayaran Anda sedang menunggu konfirmasi.
        </div>

        @if($payment->payment_type == 'tunai')
            <p class="text-center">Silakan konfirmasi pembayaran ke admin via WhatsApp.</p>
            <a href="{{ route('payment.waRedirect', $payment->id) }}" class="btn btn-success w-100">
                Konfirmasi via WhatsApp
            </a>
        @elseif($payment->payment_type == 'non-tunai')
            <p class="text-center">Lanjutkan pembayaran melalui Midtrans.</p>
            <a href="{{ route('payment.midtrans', $payment->id) }}" class="btn btn-primary w-100">
                Bayar via Midtrans
            </a>
        @endif
    @endif
@endsection
