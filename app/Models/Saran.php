<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;

    protected $table = 'saran';

    
    protected $fillable = [
    'isi',
    'file',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
