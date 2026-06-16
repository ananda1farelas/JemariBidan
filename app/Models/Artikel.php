<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = [
        'judul', 'slug', 'excerpt', 'konten', 
        'gambar', 'kategori', 'dibaca', 'publish'
    ];

    protected $casts = [
        'publish' => 'boolean',
    ];

    public function getExcerptAttribute($value): string
    {
        return $value ?? strip_tags(substr($this->konten, 0, 150)) . '...';
    }
}