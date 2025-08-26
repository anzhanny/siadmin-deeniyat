@php
    // Daftar nama halaman berdasarkan route name (semua role)
    $breadcrumbs = [
        // Admin
        'admin.dashboard' => 'Dashboard',
        
        'admin.student.index' => 'Data Siswa',
        'admin.student.create' => 'Tambah Data Siswa',
        'admin.student.edit' => 'Edit Data Siswa',
       
        'admin.class.index' => 'Data Kelas',
        'admin.class.create' => 'Tambah data Kelas',
        'admin.class.edit' => 'Edit Data Kelas',
       
        'admin.payment.index' => 'Data Pembayaran Lunas',
        'admin.payment.create' => 'Tambah Data Pembayaran Lunas',
        'admin.payment.edit' => 'Edit Data Pembayaran Lunas',

        'admin.installment.index' => 'Data Pembayaran Cicilan',
        'admin.installment.create' => 'Tambah Data Pembayaran Cicilan',
        'admin.installment.edit' => 'Edit Data Pembayaran Cicilan',

        'admin.report.index' => 'Laporan Pembayaran',
        'admin.report.create' => 'Tambah Laporan Pembayaran',
        'admin.report.edit' => 'Edit Laporan Pembayaran',



        // Student
        'student.dashboard' => 'Dashboard',
        'student.payment.index' => 'Data pembayaran',

        // Umum
        'student.profile.index' => 'Edit Profil Siswa'
    ];

    // Ambil nama route saat ini
    $currentRoute = Route::currentRouteName();

    // Ambil nama halaman berdasarkan daftar, fallback ke 'Page' jika tidak ditemukan
    $breadcrumbText = $breadcrumbs[$currentRoute] ?? 'Page';
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-white" href="javascript:;">Pages</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
            {{ $breadcrumbText }}
        </li>
    </ol>
    <h5 class="font-weight-bolder text-white mb-0">{{ $breadcrumbText }}</h5>
</nav>
