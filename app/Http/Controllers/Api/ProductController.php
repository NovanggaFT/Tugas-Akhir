<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\MasterData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with('masterData')
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => '✅ Berhasil!',
            'data' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:products',
        ]);

        $hpp = $request->hpp_per_porsi ?? 13000;
        $hargaJual = $request->harga_jual_per_porsi ?? 15000;

        $product = Product::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'sku' => $request->sku,
            'hpp_per_porsi' => $hpp,
            'harga_jual_per_porsi' => $hargaJual,
            'laba_per_porsi' => $hargaJual - $hpp,
            'target_harian' => $request->target_harian ?? 200,
            'stok_awal' => $request->stok_awal ?? 500,
            'threshold_belanja' => $request->threshold_belanja ?? 200,
            'is_active' => true,
        ]);

        MasterData::create([
            'id' => Str::uuid(),
            'product_id' => $product->id,
            'tanggal_berlaku' => now(),
            'hpp_per_porsi' => $product->hpp_per_porsi,
            'harga_jual_per_porsi' => $product->harga_jual_per_porsi,
            'laba_per_porsi' => $product->laba_per_porsi,
            'target_harian' => $product->target_harian,
            'stok_awal' => $product->stok_awal,
            'threshold_belanja' => $product->threshold_belanja,
        ]);

        return response()->json([
            'status' => '✅ Berhasil!',
            'data' => $product,
        ]);
    }
}