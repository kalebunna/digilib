<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'role:petugas'])->group(
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('kategori', KategoriController::class)->except(['show', 'create', 'edit']);;
        Route::resource('buku', BukuController::class)->except(['show', 'create', 'edit']);
        Route::post('buku/import', [BukuController::class, 'import'])->name('buku.import');
        Route::get('buku/export', [BukuController::class, 'cetakBarcode'])->name('buku.export');
        Route::resource('member', MemberController::class)->except(['create', 'edit']);
        Route::resource('petugas', PetugasController::class)->except(['show', 'create', 'edit', 'destroy', 'update']);
        Route::get('kunjungan', [KehadiranController::class, 'index'])->name('kunjungan.index');
        // Route::get("petugas/{petugas}", [PetugasController::class, 'show']);
        Route::delete('petugas/{petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
        Route::put('petugas/{petugas}', [PetugasController::class, 'update'])->name('petugas.update');

        route::get('peminjaman', [TransaksiController::class, 'peminjaman_index'])->name("peminjaman");
        route::post('peminjaman', [TransaksiController::class, 'peminajam_store'])->name("transaksi.peminjaman");
        route::get('pengembalian', [TransaksiController::class, 'pengembalian_index'])->name('pengembalian');
        Route::post('pengambalian/cari', [TransaksiController::class, 'getDataByKode'])->name('pengambalian.cari');
        Route::post('pengembalian', [TransaksiController::class, 'pengembalian_store'])->name('transaksi.pengembalian');
        Route::post('buku/getByBarcode', [BukuController::class, 'getBukuByBarcode'])->name('buku.barcode');
        Route::post('export/buku', [ExportController::class, 'ExportBuku'])->name('export.buku');
        Route::post('kunjungan/getMember/{member}', [KehadiranController::class, 'get_member'])->name('kehadiran.getMember');
        Route::post('kunjungan', [KehadiranController::class, 'store'])->name('kehadiran.store');
        Route::get('kunjungan/laporan', [KehadiranController::class, 'laporan'])->name('kehadiran.laporan');
        Route::post('kunjungan/laporan', [KehadiranController::class, 'laporan'])->name('kehadiran.laporan.post');

        Route::get('download/{jenis}', function ($kategori) {
            switch ($kategori) {
                case 'buku':
                    $path = storage_path('app/download/templatesBukuDigilib.xlsx');
                    return response()->download($path);
                    break;
                case 'siswa':
                    # code...
                    break;
                default:
                    abort(404);
                    break;
            }
        })->name('download');
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    }
);
Auth::routes([
    'register'  => false,
    'verify'    => false
]);
