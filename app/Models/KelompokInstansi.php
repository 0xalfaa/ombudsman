<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelompokInstansi extends Model
{
    use HasFactory;

    protected $table = 'kelompok_instansi';

    protected $fillable = ['nama_kelompok_instansi'];

    public function klasifikasiInstansi()
    {
        return $this->hasMany(KlasifikasiInstansi::class, 'id_kelompok_instansi');
    }


    
}
