@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Buat Jadwal Cicilan (3x)</h6>
      </div>
      <div class="card-body px-4 pt-4 pb-2">

        <form action="{{ route('admin.installment.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="payment_id" class="form-label">Pilih Siswa / Kode Pembayaran</label>
            <select class="form-select @error('payment_id') is-invalid @enderror" id="payment_id" name="payment_id" required>
              <option value="">-- Pilih Pembayaran --</option>
              @foreach($payments as $payment)
                <option value="{{ $payment->id }}">
                  {{ $payment->user->name }} - {{ $payment->code }} (Rp {{ number_format($payment->amount, 0, ',', '.') }})
                </option>
              @endforeach
            </select>
            @error('payment_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">Buat Cicilan 3x</button>
          <a href="{{ route('admin.installment.index') }}" class="btn btn-secondary">Batal</a>
        </form>

      </div>
    </div>

  </div>
</div>
@endsection
