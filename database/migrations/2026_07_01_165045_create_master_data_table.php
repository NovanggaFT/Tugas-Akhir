<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->timestamp('tanggal_berlaku')->default(now());
            $table->integer('hpp_per_porsi')->default(13000);
            $table->integer('harga_jual_per_porsi')->default(15000);
            $table->integer('laba_per_porsi')->default(2000);
            $table->integer('target_harian')->default(200);
            $table->integer('stok_awal')->default(500);
            $table->integer('threshold_belanja')->default(200);
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->unique(['product_id', 'tanggal_berlaku']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_data');
    }
};