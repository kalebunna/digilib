<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_bukus', function (Blueprint $table) {
            $table->foreignId('transaksi_id');
            $table->foreignId('buku_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->restrictOnDelete();
            $table->foreign('buku_id')->references('id')->on('bukus')->restrictOnDelete();
            $table->primary(['transaksi_id', 'buku_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_buku');
    }
};
