@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6 class="mb-0 text-dark">Pembayaran SPP</h6>
      </div>

      {{-- Error Handling --}}
      @if(session('error'))
        <div class="alert alert-danger text-white">
          {{ session('error') }}
        </div>
      @endif

      {{-- Table --}}
      <div class="table-responsive p-3">
        <table class="table table-hover text-center align-items-center mb-0">
          <thead class="bg-light">
            <tr>
              <th class="text-uppercase text-xs font-weight-bolder text-dark">#</th>
              <th class="text-uppercase text-xs font-weight-bolder text-dark">Bulan</th>
              <th class="text-uppercase text-xs font-weight-bolder text-dark">Status</th>
              <th class="text-uppercase text-xs font-weight-bolder text-dark">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($months as $month)
              @php
                $status = is_object($payments[$month] ?? null)
                    ? $payments[$month]->status
                    : (isset($payments[$month]) ? 'paid' : null);
              @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $month }}</td>
                <td>
                  @switch($status)
                    @case('paid')
                      <span class="badge bg-success">Lunas</span>
                      @break
                    @case('pending')
                      <span class="badge bg-warning text-dark">Pending</span>
                      @break
                    @default
                      <span class="badge bg-secondary">Belum Dibayar</span>
                  @endswitch
                </td>
                <td>
                  @if($status !== 'paid')
                    <button 
                      type="button" 
                      class="btn btn-primary btn-sm pay-btn"
                      data-month="{{ $month }}">
                      Bayar
                    </button>
                  @else
                    <button class="btn btn-sm btn-secondary" disabled>
                      Sudah Dibayar
                    </button>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

{{-- Midtrans Snap.js --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  /** ================================
   * 🔹 Helper Functions
   * ================================ */

  const monthMap = {
    'januari': 'January', 'februari': 'February', 'maret': 'March', 'april': 'April',
    'mei': 'May', 'juni': 'June', 'juli': 'July', 'agustus': 'August',
    'september': 'September', 'oktober': 'October', 'november': 'November', 'desember': 'December'
  };

  const capitalize = s => s ? s.charAt(0).toUpperCase() + s.slice(1).toLowerCase() : s;

  function parseMonthYear(raw) {
    const match = raw.match(/([A-Za-zÀ-ÿ]+)[\s\-\/]+(\d{4})/);
    return match ? { monthName: match[1], year: match[2] } : null;
  }

  function normalizeMonth(raw) {
    const parsed = parseMonthYear(raw);
    if (!parsed) return raw.trim();
    const eng = monthMap[parsed.monthName.toLowerCase()] || capitalize(parsed.monthName);
    return `${eng}-${parsed.year}`;
  }

  function findButton(normalizedMonth) {
    return [...document.querySelectorAll('.pay-btn')].find(btn =>
      normalizeMonth(btn.dataset.month.trim()) === normalizedMonth
    );
  }

  function markAsPaid(months) {
    months.forEach(month => {
      const normalized = normalizeMonth(month);
      const btn = findButton(normalized);
      if (!btn) return;

      const td = btn.closest('td');
      td.innerHTML = `<button class="btn btn-sm btn-secondary" disabled>Sudah Dibayar</button>`;

      const statusCell = td.previousElementSibling;
      if (statusCell) statusCell.innerHTML = `<span class="badge bg-success">Lunas</span>`;
    });
  }

  /** ================================
   * 🔹 Payment Button Logic
   * ================================ */

  document.querySelectorAll('.pay-btn').forEach(button => {
    button.addEventListener('click', async () => {
      const month = button.dataset.month;

      try {
        // 1️⃣ Periksa tunggakan
        const checkRes = await fetch(`/student/payment/spp/check-arrears/${encodeURIComponent(month)}`, {
          headers: { 'Accept': 'application/json' }
        });
        if (!checkRes.ok) throw new Error('Gagal memeriksa tunggakan');
        const arrear = await checkRes.json();

        // 2️⃣ Jika ada tunggakan
        if (arrear.hasArrears && arrear.arrearsList?.length) {
          const confirmMsg = `
Anda memiliki tunggakan:
${arrear.arrearsList.join(', ')}

Total yang harus dibayar: Rp${(arrear.totalAmount || 0).toLocaleString('id-ID')}
Lanjutkan pembayaran semua tunggakan?`;

          if (!confirm(confirmMsg)) return;

          const payAllRes = await fetch(`/student/spp/pay-all`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ months: arrear.arrearsList })
          });

          const payAll = await payAllRes.json();
          if (!payAll.snapToken) throw new Error('Gagal membuat transaksi Midtrans.');

          window.snap.pay(payAll.snapToken, {
            onSuccess: () => {
              markAsPaid(arrear.arrearsList);
              alert('✅ Pembayaran tunggakan berhasil!');
            },
            onPending: () => alert('⏳ Pembayaran sedang diproses.'),
            onError: () => alert('❌ Pembayaran gagal.')
          });

          return;
        }

        // 3️⃣ Kalau tidak ada tunggakan → bayar bulan ini
        const payRes = await fetch(`/student/spp/pay/${encodeURIComponent(month)}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        });

        const pay = await payRes.json();
        if (!pay.snapToken) throw new Error('Gagal membuat transaksi Midtrans.');

        window.snap.pay(pay.snapToken, {
          onSuccess: () => {
            markAsPaid([month]);
            alert('✅ Pembayaran berhasil!');
          },
          onPending: () => alert('⏳ Pembayaran sedang diproses.'),
          onError: () => alert('❌ Pembayaran gagal.')
        });

      } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat memproses pembayaran.');
      }
    });
  });

});
</script>
@endsection
