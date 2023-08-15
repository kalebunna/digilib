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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kodeTransaksi')->unique();
            $table->foreignId('user_id');
            $table->foreignId('member_id');
            $table->date('tgl_pinjam');
            $table->date('tgl_pengembalian');
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
