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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id');
            $table->string('judul');
            $table->string('no_barcode');
            $table->string('pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('thn_terbit')->nullable();
            $table->string('eksemplar');
            $table->string('no_isbn')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
