<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "email" => "petugas@gmail.com",
            "password" => bcrypt("12345678"),
            "name" => "Syauqan Wafiqi"
        ]);
        $user->petugas()->create([
            "no_tlp" => "082244045564",
            "alamat" => "gapura Timur Gapura Sumenep",
            "gambar" => "ikon.jpg",
        ]);

        $user->assignRole('petugas');
    }
}
