<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'indonesia_districts';

    protected $guarded = [];

    public function kabupatenKota()
    {
        return $this->belongsTo(KotaKabupaten::class,'city_code', 'code');
    }
}

