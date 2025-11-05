<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

---

# Cara Instalasi Aplikasi Laravel (Dengan Ngrok & Midtrans)

1. Extract file ZIP project ke folder yang kamu inginkan.
2. Buat database baru di phpMyAdmin atau MySQL dengan nama : siadmin_deeniyat
3. Import file SQL yang ada di folder root (misal: `database.sql`) ke database `siadmin_deeniyat`.
4. Atur koneksi database di file `.env` seperti berikut:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=siadmin_deeniyat
   DB_USERNAME=root
   DB_PASSWORD=

5. Tambahkan konfigurasi Midtrans di file `.env`:

   MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxx
   MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxx
   MIDTRANS_IS_PRODUCTION=false
   MIDTRANS_BASE_URL=https://api.sandbox.midtrans.com/v2
   MIDTRANS_CALLBACK_URL=https://levi-unstable-nonstably.ngrok-free.dev/payment/notification

6. Jalankan server lokal di terminal: php artisan serve
7. Jalankan Ngrok di terminal lain untuk menghubungkan server lokal ke internet: ngrok http 8000
8. Setelah dijalankan, Ngrok akan menampilkan beberapa URL. Gunakan link berikut (atau link khusus jika sudah diset) untuk Midtrans  
   callback: https://levi-unstable-nonstably.ngrok-free.dev
8. Tempel URL Ngrok tersebut di file `.env` jika berbeda dari link di atas:
   MIDTRANS_CALLBACK_URL=https://levi-unstable-nonstably.ngrok-free.dev/payment/notification
9. Buka aplikasi di browser dengan link yang muncul di terminal (`127.0.0.1:8000`) atau link Ngrok 
   (`https://levi-unstable-nonstably.ngrok-free.dev`).
10. Tes transaksi Midtrans untuk memastikan callback berjalan dengan benar.
✅ Selesai! Aplikasi Laravel kamu sudah bisa dijalankan dan terhubung dengan Midtrans menggunakan Ngrok.
