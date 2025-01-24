<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelapor extends Model
{
    use HasFactory;

    protected $table = 'data_pelapor';

    protected $fillable = [
        'id_provinsi',
        'id_kota_kabupaten',
        'id_kecamatan',
        'provinces_id',
        'city_id',
        'district_id',
        'nama_pelapor',
        'warga_negara',
        'jenis_identitas',
        'nomor_identitas',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan_terakhir',
        'alamat_lengkap',
        'nomor_telepon',
        'email',
        'rahasia_data',
    ];    

    public function kategoriPelapor()
            {
                return $this->belongsTo(KategoriPelapor::class, 'id_kategori_pelapor');
            }

            public function provinsi()
            {
                return $this->belongsTo(Provinsi::class, 'provinces_id', 'id');
            }

            public function kecamatan()
            {
                return $this->belongsTo(Kecamatan::class, 'city_id', 'id');
            }

            public function kabupatenKota()
                    {
                        return $this->belongsTo(KotaKabupaten::class, 'provinces_id', 'id');
                    }

    public function jenisPelapor()
            {
                return $this->belongsTo(JenisPelapor::class, 'id_jenis_pelapor');
            }


    public function terlapor()
            {
                return $this->belongsTo(DataTerlapor::class, 'id_terlapor');
            }

    public function pengaduan()
            {
                return $this->hasOne(Pengaduan::class, 'id_pelapor');
            }
            
    

}