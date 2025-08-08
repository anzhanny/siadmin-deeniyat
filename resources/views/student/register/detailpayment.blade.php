@extends('layouts.layout')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Rincian Pembayaran Pendaftaran</h5>
    </div>
    <div class="card-body">

      <h6>Nama Calon Siswa: <strong>{{ $student->name }}</strong></h6>
      <p>Email Orang Tua: {{ $student->parent_email }}</p>

      <hr>

      <table class="table table-bordered">
        <thead class="bg-light">
          <tr>
            <th>Item</th>
            <th class="text-end">Biaya (Rp)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($biaya as $item)
            <tr>
              <td>{{ $item['item'] }}</td>
              <td class="text-end">{{ number_format($item['amount'], 0, ',', '.') }}</td>
            </tr>
          @endforeach
          <tr>
            <th>Total</th>
            <th class="text-end">{{ number_format($total, 0, ',', '.') }}</th>
          </tr>
        </tbody>
      </table>

      <div class="d-flex justify-content-end">
        <form action="{{ route('payment.method') }}" method="POST">
          @csrf
          <input type="hidden" name="student_id" value="{{ $student->id }}">
          <input type="hidden" name="total" value="{{ $total }}">
          <button type="submit" class="btn btn-success">Lanjut ke Pembayaran</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
