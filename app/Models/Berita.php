<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'id',
        'judul',
        'deskripsi',
        'gambar',
        'tanggal',
    ];    

    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['search']) && $filters['search']) {
            $query->where('judul', 'like', '%' . $filters['search'] . '%')
                ->orWhere('deskripsi', 'like', '%' . $filters['search'] . '%');
        }
    }

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
