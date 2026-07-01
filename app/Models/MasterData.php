<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterData extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'tanggal_berlaku',
        'hpp_per_porsi',
        'harga_jual_per_porsi',
        'laba_per_porsi',
        'target_harian',
        'stok_awal',
        'threshold_belanja',
    ];

    protected $casts = [
        'tanggal_berlaku' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function realisasi(): HasMany
    {
        return $this->hasMany(RealisasiHarian::class);
    }

    public function riwayatBelanja(): HasMany
    {
        return $this->hasMany(RiwayatBelanja::class);
    }
}