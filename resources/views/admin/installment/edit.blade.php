@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">

      <div class="card-header pb-0">
        <h6>Edit Data Cicilan</h6>
      </div>

      <div class="card-body px-4 pt-4 pb-2">
        <form action="{{ route('admin.installment.update', $installment->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="payment_id" class="form-label">Payment ID</label>
            <input type="number" name="payment_id" id="payment_id" class="form-control" 
                   value="{{ $installment->payment_id }}" required>
          </div>

          <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input type="text" name="nominal" id="nominal" class="form-control" 
                   value="{{ $installment->nominal }}" required>
          </div>

          <div class="mb-3">
            <label for="installments_to" class="form-label">Angsuran ke</label>
            <input type="text" name="installments_to" id="installments_to" class="form-control" 
                   value="{{ $installment->installments_to }}" required>
          </div>

          <div class="mb-3">
            <label for="paid_at" class="form-label">Tanggal Bayar</label>
            <input type="date" name="paid_at" id="paid_at" class="form-control" 
                   value="{{ $installment->paid_at }}" required>
          </div>

          <div class="mb-3">
            <label for="remaining_balance" class="form-label">Sisa Saldo</label>
            <input type="text" name="remaining_balance" id="remaining_balance" class="form-control" 
                   value="{{ $installment->remaining_balance }}" required>
          </div>

          <div class="d-flex justify-content-end">
            <a href="{{ route('admin.installment.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
