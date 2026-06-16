<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paket extends Model
{
    protected $table = 'pakets';
    
    protected $fillable = [
        'kategori_id', 'nama', 'slug', 'deskripsi', 
        'harga', 'durasi', 'fitur', 'gambar', 'aktif'
    ];

    protected $casts = [
        'fitur' => 'array',
        'harga' => 'decimal:2',
        'aktif' => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getHargaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}