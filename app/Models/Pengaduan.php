<?php

namespace App\Models;

use App\Models\Kronologi;
use App\Models\KategoriPelapor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'id_pelapor',
        'id_kategori_pelapor',
        'id_jenis_pelapor',
        'id_terlapor',
        'sudah_lapor',
        'file_identitas',
        'file_bukti',
        'file_uraian',
        'tanggal_upaya',
        'bukti_upaya',
        'perihal',
        'harapan_pelapor',
    ];

    

    public function pelapor()
    {
    return $this->belongsTo(DataPelapor::class, 'id_pelapor');
    }


    public function terlapor()
    {
        return $this->belongsTo(DataTerlapor::class, 'id_terlapor');
    }

    // public function klasifikasiInstansi()
    // {
    //     return $this->hasMany(KlasifikasiInstansi::class, 'id_kelompok_instansi');
    // }

    // public function kelompokInstansi()
    // {
    //     return $this->belongsTo(KelompokInstansi::class, 'id_kelompok_instansi');
    // }

    public function jenisPelapor()
            {
                return $this->belongsTo(JenisPelapor::class, 'id_jenis_pelapor');
            }

    public function kategoriPelapor()
            {
                return $this->belongsTo(KategoriPelapor::class, 'id_kategori_pelapor', 'id');
            }
            

    public function kronologi()
            {
                return $this->hasMany(Kronologi::class); // Relasi ke model Kronologi
            }


}
