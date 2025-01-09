<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KlasifikasiInstansi extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi_instansi';

    protected $fillable = [
        'id_kelompok_instansi',
        'nama_klasifikasi_instansi'
    ];

    public function kelompokInstansi()
    {
        return $this->belongsTo(KelompokInstansi::class, 'id_kelompok_instansi');
    }

}
