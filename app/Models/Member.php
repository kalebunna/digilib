<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        "nik",
        "nama",
        "kelas",
        "tempat_lahir",
        "tempat_tanggal_lahir",
        "gender",
        'nisn',
        'desa',
        'kecamatan',
        'nama_ayah',
        'nama_ibu',
    ];

    /**
     * Get all of the comments for the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    /**
     * Get all of the kunjungan for the Member
     *
     * @return \Illuminate\Eloquent\Relations\HasMany
     */
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }
}
