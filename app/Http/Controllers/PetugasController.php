<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepetugasRequest;
use App\Http\Requests\UpdatepetugasRequest;
use App\Models\petugas;
use App\Models\User;
use App\View\Components\action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use File;
use Illuminate\Support\Facades\Storage;


class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Petugas::with('user')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('nama', function ($row) {
                    return  '<div class="d-flex align-items-center">
                              <div class="me-2 pe-1">
                                <img src="' . asset("images/" . $row->gambar) . '" class="rounded-circle" width="40" height="40" alt="" />
                              </div>
                              <div>
                                <h6 class="fw-semibold mb-1;">ss</h6>
                                <p class="fs-2 mb-0 text-muted">Web Designer</p>
                              </div>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    $com = new action($row->id, array(
                        [
                            "nama" => "name",
                            "nilai" => $row->user->name
                        ],
                        [
                            "nama" => "email",
                            "nilai" => $row->user->email
                        ],
                        [
                            "nama" => "alamat",
                            "nilai" => $row->alamat
                        ],
                        [
                            "nama" => "no_tlp",
                            "nilai" => $row->no_tlp
                        ],
                    ));
                    return $com->render();
                })
                ->rawColumns(['action', 'nama'])
                ->make(true);
        }

        return view('petugas.index');
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
    public function store(StorepetugasRequest $request)
    {
        $name = Carbon::now() . rand(0, 9999) . $request->file('gambar')->getClientOriginalName();
        $path = $request->file('gambar')->storeAs('public/images', $name);
        $user = User::create([
            "name" => $request->name,
            "password" => bcrypt($request->password),
            "email" => $request->email
        ]);
        $user->petugas()->create([
            "no_tlp" => $request->no_tlp,
            "alamat" => $request->alamat,
            "gambar" => $name
        ]);
        return response()->json("success", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(petugas $petugas)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepetugasRequest $request, petugas $petugas)
    {
        if ($request->ajax()) {
            // dd($request->all());
            if ($request->file('gambar')) {
                $path = storage_path('app/public/images/' . $petugas->gambar);
                $temp = File::delete($path);
                $name = Carbon::now() . rand(0, 9999) . $request->file('gambar')->getClientOriginalName();
                $request->file('gambar')->storeAs('public/images', $name);
                $petugas->update([
                    "alamat" => $request->alamat,
                    "no_tlp" => $request->no_tlp,
                    "gambar" => $name
                ]);
                $petugas->user->update($request->except([
                    "alamat", "no_tlp"
                ]));
            } else {
                $petugas->update([
                    "alamat" => $request->alamat,
                    "no_tlp" => $request->no_tlp,
                ]);
                $petugas->user->update($request->except([
                    "alamat", "no_tlp"
                ]));
            }
            return response()->json("success", 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(petugas $petugas)
    {
        $path = storage_path('app/public/images/' . $petugas->gambar);
        $temp = File::delete($path);
        $petugas->user->delete();
        return response()->json("success", 200);
    }
}
