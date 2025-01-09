<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelapor extends Model
{
    use HasFactory;

    protected $table = 'jenis_pelapor';

    protected $fillable = [
        'nama_jenis',
    ];

    public function kategoriPelapor()
    {
        return $this->belongsTo(KategoriPelapor::class, 'id_kategori_pelapor');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_jenis_pelapor');
    }
}
