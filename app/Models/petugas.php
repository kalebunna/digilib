<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    use HasFactory;

    protected $fillable = [
        "alamat",
        "no_tlp",
        "gambar",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
