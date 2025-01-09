<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataTerlapor extends Model
{
    use HasFactory;

    protected $table = 'data_terlapor';

    protected $fillable = [
        'id_kelompok_instansi',
        'id_klasifikasi_instansi',
        'id_provinsi',
        'id_kota_kabupaten',
        'id_kecamatan',
        'id_pelapor',
        'nama_terlapor',
        'jabatan_terlapor',
        'instansi_terlapor',
        'alamat_lengkap',
    ];

    public function kelompokInstansi()
    {
        return $this->belongsTo(KelompokInstansi::class, 'id_kelompok_instansi');
    }

    public function klasifikasiInstansi()
    {
        return $this->belongsTo(KlasifikasiInstansi::class, 'id_klasifikasi_instansi' );
    }

    public function pelapor()
    {
        return $this->belongsTo(DataPelapor::class, 'id_pelapor');
    }

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'data_terlapor_id');
    }

    public function provinsi()
            {
                return $this->belongsTo(Provinsi::class, 'id_provinsi');
            }

    public function kecamatan()
            {
                return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
            }

    public function kabupaten()
            {
                return $this->belongsTo(Kotakabupaten::class, 'id_kecamatan');
            }
}
