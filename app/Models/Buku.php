<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        "judul",
        "no_barcode",
        "pengarang",
        "penerbit",
        "thn_terbit",
        "eksemplar",
        "no_isbn",
        "kategori_id",
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
    {
        return $this->belongsToMany(Transaksi::class, 'transaksi_bukus');
    }
}
