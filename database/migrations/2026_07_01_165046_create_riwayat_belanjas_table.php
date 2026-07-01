<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_belanja', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->timestamp('tanggal')->default(now());
            $table->integer('jumlah')->nullable();
            $table->integer('total')->nullable();
            $table->integer('jumlah_system')->nullable();
            $table->integer('total_system')->nullable();
            $table->integer('hpp_per_porsi');
            $table->string('keterangan')->nullable();
            $table->uuid('master_data_id');
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->foreign('master_data_id')
                  ->references('id')
                  ->on('master_data')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_belanja');
    }
};