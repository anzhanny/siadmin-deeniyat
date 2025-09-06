<td class="align-middle">

  <!-- Tombol Bayar langsung ubah status ke paid -->
  <form action="{{ route('admin.payment.updateStatus', $value->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" value="paid">
    <button type="submit" 
            class="btn btn-success btn-icon btn-sm p-1" 
            style="width: 30px; height: 30px;" 
            title="Tandai Sudah Dibayar"
            onclick="return confirm('Yakin ingin menandai pembayaran ini sebagai Lunas?')">
      <i class="fa fa-credit-card pt-1" aria-hidden="true"></i>
    </button>
  </form>

  <!-- Dropdown Ubah Status -->
  <form action="{{ route('admin.payment.updateStatus', $value->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('PUT')
    <div class="dropdown d-inline">
      <button class="btn btn-sm 
        @if($value->status == 'paid') btn-success 
        @elseif($value->status == 'pending') btn-warning 
        @elseif($value->status == 'failed') btn-danger 
        @else btn-secondary @endif
        dropdown-toggle"
        type="button" id="dropdownMenuButton{{ $value->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        {{ ucfirst($value->status) }}
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $value->id }}">
        <li><button type="submit" name="status" value="pending" class="dropdown-item">Menunggu</button></li>
        <li><button type="submit" name="status" value="paid" class="dropdown-item">Lunas</button></li>
        <li><button type="submit" name="status" value="failed" class="dropdown-item">Dibatalkan</button></li>
      </ul>
    </div>
  </form>

</td>
