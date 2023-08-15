<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama",
        "kelas",
        "tempat_lahir",
        "tanggal_lahir",
        "gender",
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
}
