<?php

namespace App\Http\Controllers\Api;

use App\Models\RealisasiHarian;
use App\Models\RiwayatBelanja;
use App\Models\MasterData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $realisasi = RealisasiHarian::where('product_id', $request->product_id)
            ->with('product')
            ->orderBy('tanggal', 'asc')
            ->get();

        return response()->json([
            'status' => '✅ Berhasil!',
            'data' => $realisasi,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'tanggal' => 'required|date',
            'terjual' => 'required|integer|min:0',
        ]);

        $tanggal = date('Y-m-d 00:00:00', strtotime($request->tanggal));

        $master = MasterData::where('product_id', $request->product_id)
            ->where('tanggal_berlaku', '<=', $tanggal)
            ->orderBy('tanggal_berlaku', 'desc')
            ->first();

        if (!$master) {
            return response()->json([
                'status' => '❌ GAGAL',
                'error' => 'Master data tidak ditemukan',
            ], 404);
        }

        // Hitung sisa
        $hariSebelumnya = RealisasiHarian::where('product_id', $request->product_id)
            ->where('tanggal', '<', $tanggal)
            ->orderBy('tanggal', 'desc')
            ->first();

        $stokAwal = $hariSebelumnya ? $hariSebelumnya->sisa : $master->stok_awal;

        $totalBelanja = RiwayatBelanja::where('product_id', $request->product_id)
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->sum(function ($item) {
                return $item->jumlah ?? $item->jumlah_system ?? 0;
            });

        $stokTersedia = $stokAwal + $totalBelanja;
        $sisa = max(0, $stokTersedia - $request->terjual);

        $status = 'aman';
        if ($sisa === 0) {
            $status = 'habis';
        } elseif ($sisa < $master->target_harian) {
            $status = 'waspada';
        }

        $realisasi = RealisasiHarian::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'tanggal' => $tanggal,
            ],
            [
                'terjual' => $request->terjual,
                'sisa' => $sisa,
                'stok_awal' => $stokAwal,
                'status' => $status,
                'perlu_belanja' => $sisa < $master->threshold_belanja,
                'master_data_id' => $master->id,
                'hpp_per_porsi' => $master->hpp_per_porsi,
                'harga_jual_per_porsi' => $master->harga_jual_per_porsi,
                'laba_per_porsi' => $master->laba_per_porsi,
                'target_harian' => $master->target_harian,
                'threshold_belanja' => $master->threshold_belanja,
            ]
        );

        return response()->json([
            'status' => '✅ Berhasil!',
            'data' => $realisasi,
        ]);
    }
}