<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksis';
    
    protected $fillable = [
        'transaksi_id', 'paket_id', 'qty', 'harga_satuan', 'subtotal'
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }
}