<?php
use Illuminate\Support\Facades\Storage;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Mahasiswa</title>
    <style>

        .header-img {
        width: 100px;
        height: auto;
        margin-left: 30px;
        margin-top: -75px; /* Mengatur posisi logo lebih ke atas */
        }

        .header-text {
            text-align: center;
            flex: 1;
            line-height: 1.2;
        }
        .header-text h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .header-text p {
            margin: 0;
            font-size: 12px;
        }
        .header-text .website {
            font-size: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .header img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            object-fit: cover;
        }
        .header div {
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
            text-align: left;
        }
        th, td {
            padding: 8px;
        }
        .text-center {
            text-align: center;
        }
        .image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-text">
        <h2>PERWAKILAN OMBUDSMAN REPUBLIK INDONESIA</h2>
        <p>PROVINSI KALIMANTAN SELATAN</p>
        <p>Jl. Jend. S. Parman No. 57, Banjarmasin, Kalimantan Selatan</p>
        <p class="website">Website: www.ombudsman.go.id</p>
    </div>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/ombudsman.png'))) }}" alt="Logo Ombudsman"  class="header-img">
    <!-- Bagian Header dengan Foto dan Nama Mahasiswa -->
    <div class="header">
        <?php
        $fotoMahasiswa = $user->getFirstMediaPath('avatars');
    
        // Jika tidak ada avatar, gunakan default dari public/images/no-image.jpg
        if (!$fotoMahasiswa || !file_exists($fotoMahasiswa)) {
            $fotoMahasiswa = public_path('images/no-image.jpg');
        }
    ?>
    <img src="file://{{ $fotoMahasiswa }}" alt="Foto Mahasiswa">
    
        <div>
            <strong>Nama Mahasiswa:</strong> {{ $user->FullName }} <br>
        </div>
    </div>

    <!-- Tabel Presensi -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Foto</th>
                <th>Jam Pulang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $index => $data)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('H:i:s') : '-' }}</td>
                    <td class="text-center">
                        @if ($data->gambar)
                            <img src="{{ Storage::path($data->gambar) }}" class="image">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $data->waktu_keluar ?? 'Belum Absen' }}</td>
                    <td>{{ $data->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
