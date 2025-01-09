<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPelapor extends Model
{
    use HasFactory;

    protected $table = 'kategori_pelapor';

    protected $fillable = [
        'nama_kategori',
    ];

    public function jenisPelapor()
    {
        return $this->hasMany(JenisPelapor::class, 'id_kategori_pelapor');
    }
}
