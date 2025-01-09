<?php

namespace App\Models;

use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kronologi extends Model
{
    use HasFactory;

    protected $table = 'kronologi';

    protected $fillable = ['pengaduan_id', 'deskripsi_kronologi', 'tanggal_kronologi', 'catatan_bukti'];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class); // Relasi ke model Pengaduan
    }
}
