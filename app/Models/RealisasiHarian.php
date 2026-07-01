<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealisasiHarian extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'tanggal',
        'terjual',
        'sisa',
        'stok_awal',
        'status',
        'perlu_belanja',
        'master_data_id',
        'hpp_per_porsi',
        'harga_jual_per_porsi',
        'laba_per_porsi',
        'target_harian',
        'threshold_belanja',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'perlu_belanja' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function masterData(): BelongsTo
    {
        return $this->belongsTo(MasterData::class);
    }
}