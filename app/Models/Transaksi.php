<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "member_id",
        "tgl_pinjam",
        "tgl_pengembalian",
        "status",
        'kodeTransaksi'
    ];

    public function buku()
    {
        return $this->belongsToMany(buku::class, 'transaksi_bukus');
    }


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the pengembalian associate    the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pengembalian()
    {
        return $this->hasOne(pengembalian::class);
    }
}
