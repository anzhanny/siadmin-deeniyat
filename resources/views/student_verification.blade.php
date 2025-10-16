<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Akun - Deeniyat Al Hidayah</title>
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background-color: #f7fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(87deg, #5e72e4, #825ee4);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .header img {
            width: 70px;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            color: #2d3748;
            margin-bottom: 10px;
        }

        .content p {
            margin-bottom: 15px;
            color: #4a5568;
        }

        .details {
            background-color: #f8fafc;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            border: 1px solid #e2e8f0;
        }

        .details li {
            margin: 8px 0;
            list-style: none;
        }

        .details li strong {
            color: #2d3748;
        }

        .button {
            display: inline-block;
            background: linear-gradient(87deg, #5e72e4, #825ee4);
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 25px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #718096;
            padding: 20px;
        }

        .footer a {
            color: #5e72e4;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Verifikasi Akun Deeniyat Al Hidayah Anda!</h2>
        </div>

        <div class="content">
            <h2>Assalamu'alaikum, Halo {{ $user->name }} 👋</h2>
            <p>Alhamdulillah, pembayaran Anda telah berhasil diverifikasi. Berikut adalah informasi akun Anda untuk mengakses sistem <strong>Deeniyat Al Hidayah</strong>:</p>

            <ul>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Password:</strong> {{ $plain_password }}</li>
            </ul>
            <p>Silakan gunakan email dan password di atas untuk login atau langsung klik tombol berikut!</p>
            <p style="text-align: center; color:white;">
                <a href="{{ url('/login') }}" class="button">Login Sekarang</a>
            </p>

            <p>Jika ada pertanyaan, hubungi admin kami di <a href="https://wa.me/6285864921179" target="_blank">085864921179 (WhatsApp)</a>.</p>
            <p>Jazakumullahu khairan😇</p>
        </div>

        <div class="footer">
            © {{ date('Y') }} Deeniyat Al Hidayah. All rights reserved.<br>
            Dibuat dengan 💙 untuk pendidikan Islam.
        </div>
    </div>
</body>

</html>