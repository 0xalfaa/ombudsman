<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use Filament\Actions;
use App\Models\Pengaduan;
use App\Models\DataPelapor;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PengaduanResource;


class CreatePengaduan extends CreateRecord
{
    protected static string $resource = PengaduanResource::class;

    
// protected function handleRecordCreation(array $data): Pengaduan
// {
//     // Simpan data Pelapor terlebih dahulu
//     $pelapor = DataPelapor::create([
//         'nama_pelapor' => $data['nama_pelapor'],
//         'jenis_identitas' => $data['jenis_identitas'],
//         'nomor_identitas' => $data['nomor_identitas'],
//         'email' => $data['email'],
//         'nomor_telepon' => $data['nomor_telepon'],
//         'alamat_lengkap' => $data['alamat_lengkap'],
//         'tempat_lahir' => $data['tempat_lahir'],
//         'tanggal_lahir' => $data['tanggal_lahir'],
//         'jenis_kelamin' => $data['jenis_kelamin'],
//         'status_perkawinan' => $data['status_perkawinan'],
//         'pekerjaan' => $data['pekerjaan'],
//         'pendidikan_terakhir' => $data['pendidikan_terakhir'],
//         'warga_negara' => $data['warga_negara'],
//         'id_provinsi' => $data['id_provinsi'],
//         'id_kota_kabupaten' => $data['id_kota_kabupaten'],
//         'id_kecamatan' => $data['id_kecamatan'],
//         'id_kategori'  => $data['id_kategori_pelapor'],
//         'id_jenis'  => $data['id_jenis_pelapor'],
//         'rahasia_data' => $data['rahasia_data'],
//     ]);

//     // Simpan data Pengaduan dengan `id_pelapor`
//     return Pengaduan::create([
//         'id_pelapor' => $pelapor->id, // Relasi ke pelapor
//         'perihal' => $data['perihal'],
//         'tanggal_upaya' => $data['tanggal_upaya'],
//         'file_bukti' => $data['file_bukti'],
//         'file_identitas' => $data['file_identitas'],
//         'file_uraian' => $data['file_uraian'],
//         'bukti_upaya' => $data['bukti_upaya'],
//         'harapan_pelapor' => $data['harapan_pelapor'],
        
//     ]);
// }


}