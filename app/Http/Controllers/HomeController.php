<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Member;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countMember = Member::count();
        $countBuku = Buku::count();
        for ($i = 6; $i >= 0; $i--) {
            $dates[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }
        $data = Transaksi::whereIn('tgl_pinjam', $dates)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(tgl_pinjam) as date'),
                DB::raw('COUNT(*) as "count"')
            ))
            ->keyBy('date');

        $dataPeminjam = Transaksi::with('member')->whereDate('tgl_pinjam', Carbon::now())->limit(7)->orderByDesc('created_at')->get();
        return view('home', compact('countMember', 'countBuku', 'dates', 'data', 'dataPeminjam'));
    }
}
