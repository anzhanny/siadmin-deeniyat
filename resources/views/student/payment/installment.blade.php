@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-12">

    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6 class="mb-0">Riwayat Cicilan Pendaftaran</h6>
      </div>

      <div class="card-body">
        <div class="table-responsive">

          @if($payments->isEmpty())
          <div class="p-4 text-center text-muted">Belum ada data cicilan.</div>
          @else
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead class="bg-light">
                <tr>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Kode</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Cicilan</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nominal</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Jatuh Tempo</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tanggal Bayar</th>
                  <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $payment)
                @foreach($payment->installments as $inst)
                <tr>
                  <td class="align-middle text-center text-sm">{{ $payment->code }}</td>
                  <td class="align-middle text-center text-sm">Cicilan {{ $inst->installments_to }}</td>
                  <td class="align-middle text-center text-sm">Rp {{ number_format($inst->nominal,0,',','.') }}</td>
                  <td class="align-middle text-center text-sm">{{ $inst->due_date?->format('d-m-Y') ?? '-' }}</td>
                  <td class="align-middle text-center text-sm">
                    @if($inst->paid_at)
                    <span class="badge bg-success">Paid</span>
                    @else
                    <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                  </td>
                  <td class="align-middle text-center text-sm">{{ $inst->paid_at?->format('d-m-Y') ?? '-' }}</td>
                  <td class="align-middle text-center text-sm">
                    @if(!$inst->paid_at)
                    <button type="button"
                      class="btn btn-sm btn-success btn-pay"
                      data-id="{{ $inst->id }}"
                      data-code="{{ $payment->code }} - Cicilan {{ $inst->installments_to }}"
                      data-amount="{{ $inst->nominal }}"
                      data-bs-toggle="modal"
                      data-bs-target="#payModal">
                      Bayar
                    </button>
                    @else
                    <button class="btn btn-sm btn-secondary" disabled>Sudah Dibayar</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                @endforeach
              </tbody>

            </table>
          </div>
          @endif


        </div>
      </div>
      <!-- Modal Pilih Tipe Pembayaran -->
      <div class="modal fade" id="payModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="payForm" method="POST">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">Pilih Tipe Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p id="payInfo" class="mb-3 text-muted"></p>
                <select name="payment_type" id="paymentType" class="form-select" required>
                  <option value="">-- Pilih --</option>
                  <option value="tunai">Tunai (Bayar via WhatsApp)</option>
                  <option value="non-tunai">Non-Tunai (Midtrans)</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Lanjut Bayar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- End Modal Pilih Tipe Pembayaran -->
    </div>

  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let payForm = document.getElementById("payForm");
    let payInfo = document.getElementById("payInfo");
    let paymentType = document.getElementById("paymentType");
    let installmentId = null;

    document.querySelectorAll(".btn-pay").forEach(btn => {
      btn.addEventListener("click", function() {
        installmentId = this.dataset.id;
        let code = this.dataset.code;
        let amount = this.dataset.amount;

        payInfo.textContent = `Pembayaran ${code} sebesar Rp ${parseInt(amount).toLocaleString()}`;
      });
    });

    payForm.addEventListener("submit", function(e) {
      e.preventDefault();

      let type = paymentType.value;
      if (!type) {
        alert("Pilih tipe pembayaran terlebih dahulu!");
        return;
      }

      if (type === "tunai") {
        // redirect ke halaman WA redirect (GET)
        window.location.href = "/student/installment/wa-redirect/" + installmentId;
      } else {
        // submit normal ke Midtrans (POST)
        payForm.action = "/student/installment/pay/" + installmentId;
        payForm.submit();
      }
    });
  });
</script>



@endsection