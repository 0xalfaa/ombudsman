<?php

return [
    'general_settings' => [
        'title' => 'Pengaturan Umum',
        'heading' => 'Pengaturan Umum',
        'subheading' => 'Kelola pengaturan situs umum di sini.',
        'navigationLabel' => 'Umum',
        'sections' => [
            'site' => [
                'title' => 'Lokasi',
                'description' => 'Kelola pengaturan dasar.',
            ],
            'theme' => [
                'title' => 'Tema',
                'description' => 'Ubah tema default.',
            ],
        ],
        'fields' => [
            'brand_name' => 'Nama Merek',
            'site_active' => 'Status Situs',
            'brand_logoHeight' => 'Tinggi Logo Merek',
            'brand_logo' => 'Logo Merek',
            'site_favicon' => 'Situs Favicon',
            'primary' => 'Utama',
            'secondary' => 'Sekunder',
            'gray' => 'Abu-abu',
            'success' => 'Kesuksesan',
            'danger' => 'Bahaya',
            'info' => 'Informasi',
            'warning' => 'Peringatan',
        ],
    ],
    'mail_settings' => [
        'title' => 'Pengaturan Surat',
        'heading' => 'Pengaturan Surat',
        'subheading' => 'Kelola konfigurasi email.',
        'navigationLabel' => 'Surat',
        'sections' => [
            'config' => [
                'title' => 'Konfigurasi',
                'description' => 'keterangan',
            ],
            'sender' => [
                'title' => 'Dari (Pengirim)',
                'description' => 'keterangan',
            ],
            'mail_to' => [
                'title' => 'Kirim ke',
                'description' => 'keterangan',
            ],
        ],
        'fields' => [
            'placeholder' => [
                'receiver_email' => 'Email penerima..',
            ],
            'driver' => 'Pengemudi',
            'host' => 'Tuan rumah',
            'port' => 'Pelabuhan',
            'encryption' => 'Enkripsi',
            'timeout' => 'Batas waktu',
            'username' => 'Nama belakang',
            'password' => 'Kata sandi',
            'email' => 'E-mail',
            'name' => 'Nama',
            'mail_to' => 'Kirim ke',
        ],
        'actions' => [
            'send_test_mail' => 'Kirim Surat Uji',
        ],
    ]
    ];
