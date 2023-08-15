<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Imports\BukuImport;
use App\Models\Buku;
use App\Models\Kategori;
use App\View\Components\action;
use Illuminate\Http\Request;
use DataTables;
use Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Buku::with('kategori')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kategori', function ($row) {
                    return $row->kategori->name;
                })
                ->addColumn('action', function ($row) {
                    $com = new action($row->id, array(
                        [
                            "nama" => "judul",
                            "nilai" => $row->judul
                        ],
                        [
                            "nama" => "no_barcode",
                            "nilai" => $row->no_barcode
                        ],
                        [
                            "nama" => "pengarang",
                            "nilai" => $row->pengarang
                        ],
                        [
                            "nama" => "penerbit",
                            "nilai" => $row->penerbit
                        ],
                        [
                            "nama" => "thn_terbit",
                            "nilai" => $row->thn_terbit
                        ],
                        [
                            "nama" => "eksemplar",
                            "nilai" => $row->eksemplar
                        ],
                        [
                            "nama" => "no_isbn",
                            "nilai" => $row->no_isbn
                        ],
                        [
                            "nama" => "kategori_id",
                            "nilai" => $row->kategori_id
                        ],
                    ));
                    return $com->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $kategoris = Kategori::get();
        return view("buku.index", compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBukuRequest $request)
    {
        if ($request->ajax()) {
            $barcode = $request->barcode;
            if ($request->barcode == "") {
                $barcode = rand(1000000000000, 9999999999999);
            }

            Buku::create([
                "judul" => $request->judul,
                "no_barcode" => $barcode,
                "pengarang" => $request->pengarang,
                "penerbit" => $request->penerbit,
                "thn_terbit" => $request->thn_terbit,
                "eksemplar" => $request->eksemplar,
                "no_isbn" => $request->no_isbn,
                "kategori_id" => $request->kategori_id,
            ]);
            return response()->json("success", 200);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBukuRequest $request, Buku $buku)
    {
        if ($request->ajax()) {
            $buku->update($request->all());
            return response()->json("success", 200);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return response()->json("success", 200);
    }

    public function getBukuByBarcode(Request $request)
    {
        if ($request->ajax()) {
            $book = Buku::where('no_barcode', $request->no_barcode)->first();
            if ($book) {
                return  response()->json(
                    $book,
                    200,
                );
            } else {
                return  response()->json("data tidak ditemukan", 404);
            }
        }
        abort(404);
    }

    public function import(Request $request)
    {
        Excel::import(new BukuImport, $request->file('file'));
    }

    function cetakBarcode(Request $request)
    {
        $bukus = Buku::get();
        return view('buku.cetakBarcode', compact('bukus'));
    }
}
