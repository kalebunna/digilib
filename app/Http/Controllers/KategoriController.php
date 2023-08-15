<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use App\View\Components\action;
use DataTables;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $com = new action($row->id, array([
                        "nama" => "name",
                        "nilai" => $row->name
                    ]));
                    return $com->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kategori.index');
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
    public function store(StoreKategoriRequest $request)
    {
        if ($request->ajax()) {
            Kategori::create([
                "name" => $request->name
            ]);

            return response()->json("success", 200);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        if ($request->ajax()) {
            $kategori->update([
                "name" => $request->name
            ]);
            return response()->json("Data Berhasil Dirubah", 200);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Kategori $kategori)
    {
        if ($request->ajax()) {
            $kategori->delete();
            return response()->json("success", 200);
        }
        abort(404);
    }
}
