<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Penerimaan Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.0;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 20px 40px;
            border-bottom: none;
        }

        .header-container {
        display: flex;
        flex-direction: column; /* Untuk menata gambar dan teks secara vertikal */
        align-items: center; /* Agar gambar dan teks berada di tengah */
        }

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
        .title {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            margin-top: 30px;
        }
        .content {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .content td {
            padding: 8px;
            vertical-align: top;
            font-size: 12px;
        }
        .content .label {
            width: 180px;
        }
        .content .value {
            border-bottom: 0.3px dashed #000;
        }
        .content .checkboxes {
            display: flex; /* Menggunakan flex untuk menata checkbox secara horizontal */
            align-items: center;
            gap: 10px; /* Menambahkan jarak antar checkbox */
        }

        .checked {
            background-color: #000;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
        .footer p {
            margin: 0;
        }

        .footer-text {
            margin-top: 20px; /* Menambahkan margin antara teks */
            margin-bottom: 10px; /* Menambahkan margin bawah */
        }

        .dots {
            margin-right: 5px;
        }

        .kronologi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .kronologi-table th, .kronologi-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
        }

        .catatan-keterangan {
            padding: 8px;
            text-align: center;
            border: 1px solid #000;
        }
        /* .kronologi-table th {
            background-color: #f0f0f0;
        } */
        .kronologi-table td {
            vertical-align: top;
        }
        .kronologi-table td, .kronologi-table th {
            word-wrap: break-word; /* Agar teks panjang dibungkus */
        }
        /* Set untuk kolom dua kolom yang lebih lebar */
        .kronologi-table .deskripsi-kronologi,
        .kronologi-table .tanggal-kronologi,
        .kronologi-table .catatan-bukti {
            width: 100%; /* Setiap kolom mengambil sepertiga lebar */
        }
    </style>
</head>
<body>
    <div class="header-container">
    <div class="header-text">
        <h2>PERWAKILAN OMBUDSMAN REPUBLIK INDONESIA</h2>
        <p>PROVINSI KALIMANTAN SELATAN</p>
        <p>Jl. Jend. S. Parman No. 57, Banjarmasin, Kalimantan Selatan</p>
        <p class="website">Website: www.ombudsman.go.id</p>
    </div>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/ombudsman.png'))) }}" alt="Logo Ombudsman"  class="header-img">
</div>

    <div class="title">FORMULIR PENERIMAAN LAPORAN</div>

    <table class="content">
        <!-- Data Pelapor -->
        <tr>
            <td class="label">1. Nama Pelapor</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->nama_pelapor }}</td>
        </tr>
        <tr>
            <td class="label">2. Nomor Telepon</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->nomor_telepon }}</td>
        </tr>
        <tr>
            <td class="label">3. Nomor Identitas (KTP)</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->nomor_identitas }}</td>
        </tr>
        <tr>
            <td class="label">4. Tempat Tgl. Lahir</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->tempat_lahir }}, {{ $record->pelapor->tanggal_lahir }}</td>
        </tr>
        <tr>
            <td class="label">5. Alamat</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->alamat_lengkap }}</td>
        </tr>
        <tr>
            <td class="label">6. E-Mail</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->email }}</td>
        </tr>
        <tr>
            <td class="label">7. Pekerjaan</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->pekerjaan }}</td>
        </tr>
        <tr>
            <td class="label">8. Status Pernikahan</td>
            <td class="value"><span class="dots">:</span>{{ $record->pelapor->status_perkawinan }}</td>
        </tr>

        <!-- Data Terlapor -->
        <tr>
            <td class="label">9. Identitas Dirahasiakan</td>
            <td class="value"><span class="dots">:</span> {{ $record->pelapor->rahasia_data }}</td>
        </tr>
        <tr>
            <td class="label">10. Terlapor</td>
            <td class="value"><span class="dots">:</span> {{ $record->terlapor->instansi_terlapor }}</td>
        </tr>
        <tr>
            <td class="label">11. Perihal</td>
            <td class="value"><span class="dots">:</span> {{ $record->perihal }}</td>
        </tr>
        <tr>
            <td class="label">12. Apakah Laporan sedang dalam proses pemeriksaan di Pengadilan?</td>
            <td class="value">
                <span class="dots">:</span>
                <input type="checkbox" class="checkbox" id="pengadilan_proses">
                <label for="pengadilan_proses">Ya</label>
                <input type="checkbox" class="checkbox" id="pengadilan_tidak_proses">
                <label for="pengadilan_tidak_proses">Tidak</label>
            </td>
        </tr>
        <tr>
            <td class="label">13. Apakah Laporan yang sama pernah dilaporkan ke Ombudsman Pusat / Perwakilan?</td>
            <td class="value">
                <span class="dots">:</span>
                <input type="checkbox" class="checkbox" id="laporan_ombudsman">
                <label for="laporan_ombudsman">Ya</label>
                <input type="checkbox" class="checkbox" id="laporan_tidak_ombudsman">
                <label for="laporan_tidak_ombudsman">Tidak</label>
            </td>
        </tr>

        <!-- Tabel Kronologi Kejadian -->
        <tr>
            <td class="label">14. Kronologi Kejadian:</td>
        </tr>

        <!-- Looping untuk kronologi kejadian -->
        <table class="kronologi-table" style="width:700px">
            <thead>
                <tr>
                    <th class="tanggal-kronologi">Tanggal Kejadian</th>
                    <th class="deskripsi-kronologi">Deskripsi Kronologi</th>
                    <th class="tanggal-kronologi">Catatan Bukti</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping untuk kronologi kejadian -->
                @foreach ($record->kronologi as $index => $kronologi)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($kronologi->tanggal_kronologi)->format('d F Y') }}</td>
                        <td text-align=left>{{ $kronologi->deskripsi_kronologi }}</td>
                        <td>{{ $kronologi->catatan_bukti }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <tr>
            <td class="label">15. Harapan Pelapor:</td>
        </tr>
        <tr>
            <td class="value" rows="3" cols="3" style="resize: both; width: 20%;">{{ $record->harapan_pelapor }}</td>
        </tr>
    </table>
    <table class="catatan-keterangan" style="width:700px">
        <tr>
            <th>Catatan / Keterangan</th>
          </tr>
          <tr>
            <td style="padding: 20px;"></td>
          </tr>
    </table>
    <div class="footer">
        <p>Banjarmasin, {{ now()->format('d F Y') }}</p>
        <p class="footer-text">Penerima Laporan,</p>
        <p class="footer-text">Maulana Achmadi</p>
    </div>
</body>
</html>
