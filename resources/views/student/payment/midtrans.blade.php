@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12 text-center">
        <h5>Proses Pembayaran SPP</h5>
        <p>Jumlah: Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('student.payment.spp.success', $payment->id) }}";
            },
            onPending: function(result){
                alert("Pembayaran menunggu konfirmasi");
                window.location.href = "{{ route('student.payment.spp') }}";
            },
            onError: function(result){
                alert("Terjadi kesalahan pada pembayaran: " + result.status_message);
                window.location.href = "{{ route('student.payment.spp') }}";
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>
@endsection
