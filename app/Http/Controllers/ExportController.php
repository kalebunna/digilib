<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use DNS1D;
use Milon\Barcode\DNS1D as BarcodeDNS1D;

class ExportController extends Controller
{
    public function generateBarcodeImage($text)
    {
        $barcode = new BarcodeDNS1D();
        // $barcode->setStorPath(public_path('temp')); // Direktori sementara untuk menyimpan gambar barcode
        $barcode->setStorPath(sys_get_temp_dir());
        $barcode->getBarcodePNGPath($text, 'C128'); // 'C128' adalah jenis barcode, Anda dapat mengganti jenis sesuai kebutuhan (contoh: 'C39')
        $filename = $barcode->getBarcodePNGPath($text, 'C128');
        return $filename;
    }

    public function ExportBuku(Request $request)
    {
        // dd($request);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $datas = $this->rapikanData($request->datas);
        // dd($datas);
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);

        // 1. Basic table

        $rows = 10;
        $cols = 5;
        $section->addText(htmlspecialchars('Basic table'), $header);
        $barcodeText = '123456789';

        // Generate barcode image

        $table = $section->addTable();
        // for ($r = 1; $r <= sizeof($datas); $r++) {
        //     $table->addRow();
        //     for ($c = 1; $c <= 3; $c++) {
        //         $z = $table->addCell($c);
        //         if ($c == 2) {
        //             $z->addText("    |   ");
        //         } else {
        //             $barcodeImage = $this->generateBarcodeImage($barcodeText);
        //             $z->addImage($barcodeImage, [
        //                 'width' => 200, // Sesuaikan ukuran gambar sesuai kebutuhan
        //                 'height' => 100,
        //                 'alignment' => 'center',
        //             ]);
        //             $z->addText(" ");
        //         }
        //     }
        // }

        foreach ($datas as $data) {
            $table->addRow();
            $col = 1;
            foreach ($data as $e) {
                $z = $table->addCell($col);
                $col++;
                // dd($e);
                $barcodeImage = $this->generateBarcodeImage($e['barcode']);
                $z->addImage($barcodeImage, [
                    'width' => 200, // Sesuaikan ukuran gambar sesuai kebutuhan
                    'height' => 100,
                    'alignment' => 'center',
                ]);
                $z->addText($e['name']);
            }
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
            return response()->json($e, 200);
        }

        return response()->download(storage_path('helloWorld.docx'));
    }

    function rapikanData($books)
    {
        // Buat array baru untuk menampung hasil transformasi data
        $transformedData = [];
        $currentArray = [];
        foreach ($books as $book) {
            $barcode = $book["barcode"];
            $name = $book["name"];
            $printCount = intval($book['print']);

            // Lakukan perulangan sebanyak nilai "print" untuk buku saat ini
            for ($i = 0; $i < $printCount; $i++) {
                // Jika array saat ini sudah memiliki 2 entri, tambahkan ke array baru
                if (count($currentArray) === 2) {
                    $transformedData[] = $currentArray;
                    $currentArray = []; // Bersihkan array saat ini untuk entri selanjutnya
                }
                $currentArray[] = ["barcode" => $barcode, "name" => $name];
            }
        }

        // Tambahkan sisa data (jika ada) ke array hasil transformasi terakhir
        if (!empty($currentArray)) {
            $transformedData[] = $currentArray;
        }

        return $transformedData;
    }
}
