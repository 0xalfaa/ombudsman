<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = ['id_kota_kabupaten', 'nama_kecamatan'];

    public function kotaKabupaten()
    {
        return $this->belongsTo(KotaKabupaten::class, 'id_kota_kabupaten');
    }
}

