<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'indonesia_provinces';
    
    protected $guarded = [];

    public function kabupatenKota()
    {
        return $this->hasMany(KotaKabupaten::class, 'id_provinsi');
    }
}

