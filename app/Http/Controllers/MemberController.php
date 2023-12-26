<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\View\Components\action;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $com = new action($row->id, array(
                        [
                            "nama" => "nama",
                            "nilai" => $row->nama
                        ],
                        [
                            "nama" => "kelas",
                            "nilai" => $row->kelas
                        ],
                        [
                            "nama" => "tempat_lahir",
                            "nilai" => $row->tempat_lahir
                        ],
                        [
                            "nama" => "tanggal_lahir",
                            "nilai" => $row->tanggal_lahir
                        ],
                        [
                            "nama" => "gender",
                            "nilai" => $row->gender
                        ],
                    ));
                    return $com->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('member.index');
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
    public function store(StoreMemberRequest $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                if (Member::where('nik', $request->nik)->exists()) {
                    return response()->json([
                        "res" => "fail",
                        "nama" => $request->nama,
                        "message" => "NIK telah Terdaftar",
                        "err_detail" => ""
                    ], 200);
                } else {

                    Member::create($request->all());
                    DB::commit();
                    return response()->json([
                        "res" => "success",
                        "nama" => $request->nama,
                        "message" => "success",
                        "err_detail" => ""
                    ], 200);
                }
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    "res" => "success",
                    "nama" => $request->nama,
                    "message" => "Terjadi Kesalahan Server",
                    "err_detail" => $th->getMessage()
                ], 500);
            }
        }
        Member::create($request->all());
        return response()->json("success", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Member $member)
    {
        if ($request->ajax()) {
            return response()->json($member, 200);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        if ($request->ajax()) {
            $member->update($request->all());
            return response()->json($request->all(), 200);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
    }
}
