<?php

namespace App\Http\Controllers\Api;

use App\Models\RiwayatBelanja;
use App\Models\MasterData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $pembelian = RiwayatBelanja::where('product_id', $request->product_id)
            ->with('product')
            ->orderBy('tanggal', 'asc')
            ->get();

        return response()->json([
            'status' => '✅ Berhasil!',
            'data' => $pembelian,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'tanggal' => 'required|date',
            'jumlah' => 'nullable|integer|min:0',
            'total' => 'nullable|integer|min:0',
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

        $jumlah = $request->jumlah;
        $total = $request->total;
        $jumlahSystem = null;
        $totalSystem = null;

        if ($jumlah && !$total) {
            $totalSystem = $jumlah * $master->hpp_per_porsi;
        } elseif ($total && !$jumlah) {
            $jumlahSystem = floor($total / $master->hpp_per_porsi);
        }

        $pembelian = RiwayatBelanja::create([
            'id' => Str::uuid(),
            'product_id' => $request->product_id,
            'tanggal' => $tanggal,
            'jumlah' => $jumlah,
            'total' => $total,
            'jumlah_system' => $jumlahSystem,
            'total_system' => $totalSystem,
            'hpp_per_porsi' => $master->hpp_per_porsi,
            'keterangan' => $request->keterangan,
            'master_data_id' => $master->id,
        ]);

        return response()->json([
            'status' => '✅ Berhasil!',
            'data' => $pembelian,
        ]);
    }
}