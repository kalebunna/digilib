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
                "name" => $row[7]
            ]);

            $kategori->buku()->create([
                "judul" => $row[0],
                "no_barcode" => isNull($row[1])  ?   rand(1000000, 9999999) . Carbon::now()->format('his') : $row[2],
                "pengarang" => $row[3],
                "penerbit" => $row[4],
                "thn_terbit" => $row[5],
                "eksemplar" => $row[6],
                "no_isbn" => $row[2],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
