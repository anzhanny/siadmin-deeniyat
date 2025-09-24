@extends('layouts.layout')

@section('content')
<div class="container text-center mt-5">
    <h4>Pembayaran</h4>
    <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay("{{ $snapToken }}", {
            onSuccess: function(result){ location.href="{{ route('student.payment.spp') }}"; },
            onPending: function(result){ location.href="{{ route('student.payment.spp') }}"; },
            onError: function(result){ alert("Pembayaran gagal"); },
            onClose: function(){ alert("Kamu belum menyelesaikan pembayaran"); }
        });
    });
</script>
@endsection
