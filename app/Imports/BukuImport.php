<?php

namespace App\Imports;

use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

use function PHPUnit\Framework\isNull;

class BukuImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $kategori = Kategori::firstOrCreate([
                "name" => $row[0]
            ]);

            $kategori->buku()->create([
                "judul" => $row[1],
                "no_barcode" => isNull($row[2])  ?   rand(1000000, 9999999) . Carbon::now()->format('his') : $row[2],
                "pengarang" => $row[4],
                "penerbit" => $row[5],
                "thn_terbit" => $row[6],
                "eksemplar" => $row[7],
                "no_isbn" => $row[3],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
