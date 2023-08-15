<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    use HasFactory;
    protected $fillable = [
        "transaksi_id",
        "tgl_pengembalian",
        "status",
        "denda"
    ];
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
    }
}
