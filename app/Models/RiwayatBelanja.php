<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatBelanja extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'tanggal',
        'jumlah',
        'total',
        'jumlah_system',
        'total_system',
        'hpp_per_porsi',
        'keterangan',
        'master_data_id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
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