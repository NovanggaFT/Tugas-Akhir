<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'sku',
        'hpp_per_porsi',
        'harga_jual_per_porsi',
        'laba_per_porsi',
        'target_harian',
        'stok_awal',
        'threshold_belanja',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function masterData(): HasMany
    {
        return $this->hasMany(MasterData::class);
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