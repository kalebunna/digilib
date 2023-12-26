<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $members = Member::orderBy('nama')->get();
        return view('kunjungan.index', compact('members'));
    }


    function get_member(Request $request, Member $member)
    {
        if ($request->ajax()) {
            return response()->json($member, 200);
        }
        abort(404);
    }

    function store(Request $request)
    {
        $member = Member::find($request->member_id);
        $hadirToday = Kehadiran::where('member_id', $request->member_id)->where('tanggal_hadir', Carbon::today())->exists();
        if ($hadirToday) {
            return response()->json([
                "res" => "fail",
                "message" => "Anda Telah Hadir Hari INi",
                "nama" => $member->nama,
                "detail_error" => ""
            ], 200);
        } else {
            $member->kehadiran()->create([
                "tanggal_hadir" => Carbon::today()
            ]);

            return response()->json([
                "res" => "success",
                "message" => "Kehadiran Anda Telah Tecatat",
                "nama" => $member->nama,
                "detail_error" => ""
            ], 200);
        }
    }

    function laporan(Request $request)
    {
        if ($request->ajax()) {
            if ($request->start == "" || $request->end == "") {
                return response()->json([
                    "res" => "fail",
                    "message" => "Pilih Tanggal Untuk Ditampilkan Dengan Benar",
                    "detail_error" => ""
                ], 200);
            } else {
                $data = Kehadiran::with('member')->where('tanggal_hadir', '>=', date_create($request->start))->where('tanggal_hadir', '<=', date_create($request->end))->groupBy('member_id')->selectRaw('count(*) as total, member_id')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
        $now = Carbon::now()->format('Y-m-d');
        return view('kunjungan.laporan', compact('now'));
    }
}
