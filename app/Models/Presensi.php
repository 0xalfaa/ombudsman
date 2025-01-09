<?php

namespace App\Models;

use App\Models\User;;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'keterangan',
        'gambar',
        ];

        public function NamaMagang()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
}





