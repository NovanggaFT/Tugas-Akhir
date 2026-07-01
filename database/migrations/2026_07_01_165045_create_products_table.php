<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('sku')->unique();
            $table->integer('hpp_per_porsi')->default(13000);
            $table->integer('harga_jual_per_porsi')->default(15000);
            $table->integer('laba_per_porsi')->default(2000);
            $table->integer('target_harian')->default(200);
            $table->integer('stok_awal')->default(500);
            $table->integer('threshold_belanja')->default(200);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};