<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Member;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Str;
use DataTables;

class TransaksiController extends Controller
{

    public function peminjaman_index()
    {
        $members = Member::get();
        $bukus = Buku::get();
        $today = Carbon::today()->format("d-m-Y");
        $dedlen = Carbon::now()->addDays(3)->format('D');
        if ($dedlen == "Fri") {
            $dedlen = Carbon::now()->addDays(4)->format('d-m-Y');
        } else {
            $dedlen = Carbon::now()->addDays(4)->format('d-m-Y');
        }
        return view("transaksi.peminjaman", compact('members', 'bukus', 'today', 'dedlen'));
    }

    public function peminajam_store(Request $request)
    {
        DB::beginTransaction();
        try {

            $dedlen = Carbon::now()->addDays(3)->format('D');
            if ($dedlen == "Fri") {
                $dedlen = Carbon::now()->addDays(4);
            } else {
                $dedlen = Carbon::now()->addDays(3);
            }

            $transaksi = Transaksi::create([
                'kodeTransaksi' => Str::random(2) . Carbon::now()->format('dmyHs') . rand(100, 999),
                'user_id' => auth()->user()->id,
                'member_id' => $request->member_id,
                'tgl_pinjam' => Carbon::now(),
                'tgl_pengembalian' => $dedlen,
                'status' => 'pinjam',
            ]);
            $items = $transaksi->buku()->attach($request->books);
            DB::commit();
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json($th, 503);
        }
    }

    function pengembalian_index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaksi::with('member')->where('status', 'pinjam')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    return $row->member->nama;
                })
                ->addColumn('kelas', function ($row) {
                    return $row->member->kelas;
                })
                ->addColumn('status', function ($row) {
                    if (Carbon::today() > $row->tgl_pengembalian) {
                        return '<span class="mb-1 badge font-medium bg-light-danger text-danger">LAMBAT</span>';
                    }
                    return ' <span class="mb-1 badge font-medium bg-light-success text-success">OK</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('transaksi.pengembalian ');
    }

    function getDataByKode(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaksi::where('kodeTransaksi', $request->kodeTransaksi)->with('member')->with('buku')->firstOrFail();
            $status = '';
            if (Carbon::today() > $data->tgl_pengembalian) {
                $terlambat = date_diff(date_create($data->tgl_pengembalian), date_create(Carbon::today()));
                $hari = $terlambat->format("%a");
                $status = '<span class="mb-1 badge font-medium bg-light-danger text-danger">Terlambat ' . $hari . ' Hari</span>';
            } else {
                $status = '<span class="mb-1 badge font-medium bg-light-success text-success">OK</span>';
            }
            $data['status'] = $status;
            return response()->json($data, 200);
        }
        abort(404);
    }

    public function pengembalian_store(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::where('kodeTransaksi', $request->kodeTransaksi)->firstOrFail();
            // dd($transaksi);
            $status = "ok";
            $denda = "0";
            if (Carbon::today() > $transaksi->tgl_pengembalian) {
                $terlambat = date_diff(date_create($transaksi->tgl_pengembalian), date_create(Carbon::today()));
                $hari = $terlambat->format("%a");
                $denda = $hari * 2000;
            }
            $transaksi->update([
                "status" => "kembali"
            ]);
            $transaksi->pengembalian()->create([
                "tgl_pengembalian" => Carbon::today(),
                "status" => $status,
                "denda" => $denda,
            ]);
            DB::commit();
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json("err", 503);
        }
    }
}
