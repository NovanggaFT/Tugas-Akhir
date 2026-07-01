<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisasi_harian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->timestamp('tanggal')->default(now());
            $table->integer('terjual')->default(0);
            $table->integer('sisa')->default(0);
            $table->integer('stok_awal')->default(0);
            $table->enum('status', ['aman', 'waspada', 'habis', 'belum_terjadi'])->default('belum_terjadi');
            $table->boolean('perlu_belanja')->default(false);
            $table->uuid('master_data_id');
            $table->integer('hpp_per_porsi');
            $table->integer('harga_jual_per_porsi');
            $table->integer('laba_per_porsi');
            $table->integer('target_harian');
            $table->integer('threshold_belanja');
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->foreign('master_data_id')
                  ->references('id')
                  ->on('master_data')
                  ->onDelete('cascade');

            $table->unique(['product_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi_harian');
    }
};