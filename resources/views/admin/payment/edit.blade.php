@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-header">
        <h6 class="mb-0">Edit Data Pembayaran</h6>
      </div>

      <div class="card-body">
        <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="user_id" class="form-label">Nama Siswa</label>
            <select name="user_id" id="user_id" class="form-select" required>
              @foreach(\App\Models\User::where('role_id',2)->get() as $u)
                <option value="{{ $u->id }}" {{ $payment->user_id == $u->id ? 'selected' : '' }}>
                  {{ $u->name }} ({{ $u->class->class_name ?? '-' }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="payment_for" class="form-label">Jenis Pembayaran</label>
            <input type="text" name="payment_for" id="payment_for" class="form-control"
                   value="{{ old('payment_for',$payment->payment_for) }}" required>
          </div>

          <div class="mb-3">
            <label for="payment_type" class="form-label">Tipe</label>
            <select name="payment_type" id="payment_type" class="form-select" required>
              <option value="spp" {{ $payment->payment_type == 'spp' ? 'selected' : '' }}>SPP</option>
              <option value="uang gedung" {{ $payment->payment_type == 'uang gedung' ? 'selected' : '' }}>Uang Gedung</option>
              <option value="lainnya" {{ $payment->payment_type == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="payment_category" class="form-label">Kategori</label>
            <select name="payment_category" id="payment_category" class="form-select" required>
              <option value="lunas" {{ $payment->payment_category == 'lunas' ? 'selected' : '' }}>Lunas</option>
              <option value="cicilan" {{ $payment->payment_category == 'cicilan' ? 'selected' : '' }}>Cicilan</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="amount" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="amount" id="amount" class="form-control"
                   value="{{ old('amount',$payment->amount) }}" required>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
              <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Lunas</option>
              <option value="unpaid" {{ $payment->status == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
            </select>
          </div>

          <div class="d-flex justify-content-end">
            <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>
@endsection
