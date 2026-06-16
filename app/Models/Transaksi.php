<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id', 
        'kode_transaksi', 
        'total_harga', 
        'status', 
        'catatan', 
        'tanggal_transaksi'
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'tanggal_transaksi' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function getTotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'menunggu' => '<span class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-xs font-medium">Menunggu</span>',
            'diproses' => '<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">Diproses</span>',
            'selesai' => '<span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full text-xs font-medium">Selesai</span>',
            'dibatalkan' => '<span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Dibatalkan</span>',
        ];
        return $badges[$this->status] ?? $badges['menunggu'];
    }
}