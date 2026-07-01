<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Products
        $products = [
            [
                'id' => Str::uuid(),
                'name' => 'Makanan 1',
                'sku' => 'MKN-001',
                'description' => 'Makanan utama varian 1',
                'hpp_per_porsi' => 13000,
                'harga_jual_per_porsi' => 15000,
                'laba_per_porsi' => 2000,
                'target_harian' => 200,
                'stok_awal' => 500,
                'threshold_belanja' => 200,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Makanan 2',
                'sku' => 'MKN-002',
                'description' => 'Makanan utama varian 2',
                'hpp_per_porsi' => 14000,
                'harga_jual_per_porsi' => 17000,
                'laba_per_porsi' => 3000,
                'target_harian' => 150,
                'stok_awal' => 400,
                'threshold_belanja' => 150,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Makanan 3',
                'sku' => 'MKN-003',
                'description' => 'Makanan utama varian 3',
                'hpp_per_porsi' => 12000,
                'harga_jual_per_porsi' => 14000,
                'laba_per_porsi' => 2000,
                'target_harian' => 100,
                'stok_awal' => 300,
                'threshold_belanja' => 100,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        // 2. Buat MasterData untuk setiap product
        $productsDb = \App\Models\Product::all();
        foreach ($productsDb as $product) {
            \App\Models\MasterData::create([
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
        }

        $this->command->info('✅ Seed data berhasil!');
    }
}