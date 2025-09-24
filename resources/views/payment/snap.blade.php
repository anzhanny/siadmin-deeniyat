@extends('layouts.layout')
@section('content')
<div class="container mt-5 text-center">
  <h4>Pembayaran Cicilan ke-{{ $installment->installments_to }}</h4>
  <p>Total: Rp {{ number_format($installment->nominal,0,',','.') }}</p>

  <button id="pay-button" class="btn btn-success">Bayar dengan Midtrans</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
  document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        window.location.href = "{{ route('student.history') }}?status=success";
      },
      onPending: function(result){
        window.location.href = "{{ route('student.history') }}?status=pending";
      },
      onError: function(result){
        alert("Pembayaran gagal, coba lagi!");
      },
      onClose: function(){
        alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
      }
    });
  };
</script>
@endsection
