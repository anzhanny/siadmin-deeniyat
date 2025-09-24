<x-mail::message>
# Tagihan SPP untuk {{ $payment->user->name ?? 'Orang Tua' }}

Halo {{ $payment->user->name ?? '' }},  

Berikut informasi tagihan SPP bulan ini:

- **Kode Pembayaran:** {{ $payment->code }}
- **Nama Siswa:** {{ $payment->user->name ?? '-' }}
- **Kelas:** {{ $payment->user->class->class_name ?? '-' }}
- **Bulan/Tahun:** {{ $payment->month }} {{ $payment->year }}
- **Jumlah:** Rp {{ number_format($payment->amount,0,',','.') }}
- **Status:** {{ ucfirst($payment->status) }}

Silakan lakukan pembayaran sesuai instruksi Deeniyat Al Hidayah. Terima kasih.

<x-mail::button :url="url('/')" color="primary">
Cek Pembayaran
</x-mail::button>

Hormat kami,  
**{{ config('app.name') }}**
</x-mail::message>
