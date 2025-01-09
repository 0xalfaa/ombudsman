<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Penerimaan Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 20px;
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            margin-bottom: 10px;
        }
        .header h2, .header p {
            margin: 0;
        }
        .content {
            width: 100%;
            border-collapse: collapse;
        }
        .content td {
            padding: 5px;
            vertical-align: top;
        }
        .checkbox {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
            line-height: 13px;
            margin-right: 5px;
        }
        .checked {
            background-color: #000;
        }
        .line {
            border-bottom: 1px dotted #000;
            width: 100%;
            display: inline-block;
        }
        .number {
            width: 25px;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.png" alt="Logo Ombudsman">
        <h2>PERWAKILAN OMBUDSMAN REPUBLIK INDONESIA</h2>
        <p>PROVINSI KALIMANTAN SELATAN</p>
        <p>Jl. Jend. S. Parman No. 57, Banjarmasin, Kalimantan Selatan</p>
        <p>Website: www.ombudsman.go.id</p>
    </div>

    <h3 style="text-align: center; text-decoration: underline;">FORMULIR PENERIMAAN LAPORAN</h3>

    <table class="content">
        <tr>
            <td class="number">1.</td>
            <td>Nama Pelapor</td>
            <td>: <span class="line">{!! $record->nama_pelapor !!}
            </span></td>
        </tr>
        <tr>
            <td class="number">2.</td>
            <td>Nomor Telepon</td>
            <td>: <span class="line">{{ $record->nomor_telepon }}</span></td>
        </tr>
        <tr>
            <td class="number">3.</td>
            <td>Nomor Identitas (KTP)</td>
            <td>: <span class="line">{{ $record->nomor_identitas }}</span></td>
        </tr>
        <tr>
            <td class="number">4.</td>
            <td>Tempat Tgl. Lahir</td>
            <td>: <span class="line">{{ $record->tempat_lahir }}, {{ $record->tanggal_lahir }}</span></td>
        </tr>
        <tr>
            <td class="number">5.</td>
            <td>Alamat</td>
            <td>: <span class="line">{{ $record->alamat_lengkap }}</span></td>
        </tr>
        <tr>
            <td class="number">6.</td>
            <td>E-Mail</td>
            <td>: <span class="line">{{ $record->email }}</span></td>
        </tr>
        <tr>
            <td class="number">7.</td>
            <td>Pekerjaan</td>
            <td>: <span class="line">{{ $record->pekerjaan }}</span></td>
        </tr>
        <tr>
            <td class="number">8.</td>
            <td>Status Pernikahan</td>
            <td>: 
                <div class="checkbox {{ $record->status_perkawinan == 'Belum Menikah' ? 'checked' : '' }}"></div> Belum Menikah 
                <div class="checkbox {{ $record->status_perkawinan == 'Menikah' ? 'checked' : '' }}"></div> Menikah 
                <div class="checkbox {{ $record->status_perkawinan == 'Cerai Mati' ? 'checked' : '' }}"></div> Cerai Mati 
                <div class="checkbox {{ $record->status_perkawinan == 'Cerai Hidup' ? 'checked' : '' }}"></div> Cerai Hidup
            </td>
        </tr>
        <!-- Tambahkan elemen lain sesuai kebutuhan -->
    </table>

    <div class="footer">
        <p>Banjarmasin, {{ now()->format('d F Y') }}</p>
        <p>Penerima Laporan,</p>
        <p><strong>Maulana Achmadi</strong></p>
    </div>
</body>
</html>
