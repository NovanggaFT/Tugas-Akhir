<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MasterData;
use App\Models\RealisasiHarian;
use App\Models\RiwayatBelanja;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_active', true)->get();
        $activeProductId = $request->get('product_id', $products->first()?->id);

        $metrics = $this->calculateMetrics($activeProductId);

        return view('dashboard', compact('products', 'activeProductId', 'metrics'));
    }

    private function calculateMetrics($productId)
    {
        // Data dummy dulu
        return [
            'nilaiAset' => 'Rp 6.500.000',
            'sisaBahanBaku' => 500,
            'nilaiPenjualanHariIni' => 'Rp 3.000.000',
            'penjualanHariIni' => 200,
            'totalProfit' => 'Rp 2.400.000',
            'totalTerjual' => 1200,
            'persentaseEfisiensi' => 85.7,
            'totalSisa' => 200,
        ];
    }
}