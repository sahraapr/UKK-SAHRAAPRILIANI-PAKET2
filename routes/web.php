<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Petugas\AdministratorController;
use App\Http\Controllers\Petugas\AlasanController;
use App\Http\Controllers\Petugas\Auth\LoginController;
use App\Http\Controllers\Petugas\Auth\RegisterController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\KategoriController;
use App\Http\Controllers\Petugas\MasyarakatController;
use App\Http\Controllers\Petugas\PengaduanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Auth
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [BerandaController::class, 'index'])->name('dashboard');
Route::post('lapor', [BerandaController::class, 'lapor'])->name('lapor');

Route::middleware(['auth:masyarakat'])->group(function () {
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('laporan/detail/{id}', [LaporanController::class, 'detail'])->name('laporan.detail');
});

Route::prefix('_petugas')->group(function () {
    // Auth
    Route::get('login', [LoginController::class, 'login'])->name('_petugas.login')->middleware('guest:petugas');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('_petugas.authenticate');
    Route::get('logout', [LoginController::class, 'logout'])->name('_petugas.logout');
    Route::get('register', [RegisterController::class, 'index'])->name('_petugas.register')->middleware('guest:petugas');
    Route::post('register', [RegisterController::class, 'register'])->name('_petugas.registering');

    // petugas
    Route::middleware(['auth:petugas', 'checkLevel:petugas'])->name('petugas.')->group(function () {

        // Kategori
        // Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
        // Route::get('kategori/getKategori', [KategoriController::class, 'getKategori'])->name('kategori.getKategori');
        // Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        // Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        // Route::put('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        // Route::delete('kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

        // Alasan
        // Route::get('alasan', [AlasanController::class, 'index'])->name('alasan');
        // Route::get('alasan/getAlasan', [AlasanController::class, 'getAlasan'])->name('alasan.getAlasan');
        // Route::post('alasan/store', [AlasanController::class, 'store'])->name('alasan.store');
        // Route::get('alasan/edit/{id}', [AlasanController::class, 'edit'])->name('alasan.edit');
        // Route::put('alasan/update/{id}', [AlasanController::class, 'update'])->name('alasan.update');
        // Route::delete('alasan/delete/{id}', [AlasanController::class, 'destroy'])->name('alasan.delete');

        // Administrator
        Route::get('administrator', [AdministratorController::class, 'index'])->name('administrator');
        Route::get('administrator/getAdministrator', [AdministratorController::class, 'getAdministrator'])->name('administrator.getAdministrator');
        Route::post('administrator/store', [AdministratorController::class, 'store'])->name('administrator.store');
        Route::get('administrator/edit/{id}', [AdministratorController::class, 'edit'])->name('administrator.edit');
        Route::put('administrator/update/{id}', [AdministratorController::class, 'update'])->name('administrator.update');
        Route::post('administrator/changeStatus', [AdministratorController::class, 'changeStatus'])->name('administrator.changeStatus');
        Route::delete('administrator/delete/{id}', [AdministratorController::class, 'destroy'])->name('administrator.delete');

        // Masyarakat
        Route::get('masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat');
        Route::get('masyarakat/getMasyarakat', [MasyarakatController::class, 'getMasyarakat'])->name('masyarakat.getMasyarakat');
        Route::post('masyarakat/store', [MasyarakatController::class, 'store'])->name('masyarakat.store');
        Route::get('masyarakat/edit/{id}', [MasyarakatController::class, 'edit'])->name('masyarakat.edit');
        Route::put('masyarakat/update/{id}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
        Route::delete('masyarakat/delete/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.delete');
    });

    // admin
    // Route::middleware(['auth:petugas', 'checkLevel:administrator'])->name('admin.')->group(function () {
    //     Route::get('dashboard', function () {
    //         return view('_petugas.dashboard_admin');
    //     })->name('dashboard');
    // });

    // admin & petugas
    Route::middleware(['auth:petugas', 'checkLevel:administrator,petugas'])->name('_petugas.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pengaduan
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            // Belum Diproses
            Route::get('belum_diproses', [PengaduanController::class, 'belumDiproses'])->name('belumDiproses');
            Route::get('getBelum', [PengaduanController::class, 'getBelum'])->name('getBelum');
            Route::get('belum_diproses/detail/{id}', [PengaduanController::class, 'detailBelum'])->name('belum.detail');

            // Sedang Diproses
            Route::get('sedang_diproses', [PengaduanController::class, 'sedangDiproses'])->name('sedangDiproses');
            Route::get('getProses', [PengaduanController::class, 'getProses'])->name('getProses');
            Route::get('sedang_diproses/detail/{id}', [PengaduanController::class, 'detailProses'])->name('proses.detail');
            Route::post('sedang_diproses/tanggapan/{id}', [PengaduanController::class, 'tanggapan'])->name('proses.tanggapan');

            // Selesai Diproses
            Route::get('selesai_diproses', [PengaduanController::class, 'selesaiDiproses'])->name('selesaiDiproses');
            Route::get('getSelesai', [PengaduanController::class, 'getSelesai'])->name('getSelesai');
            Route::get('selesai_diproses/detail/{id}', [PengaduanController::class, 'detailSelesai'])->name('selesai.detail');

            // Ditolak
            Route::get('ditolak', [PengaduanController::class, 'ditolak'])->name('ditolak');
            Route::get('getDitolak', [PengaduanController::class, 'getDitolak'])->name('getDitolak');
            Route::get('ditolak/detail/{id}', [PengaduanController::class, 'detailDitolak'])->name('ditolak.detail');

            Route::post('terima/{id}', [PengaduanController::class, 'terima'])->name('terima');
            Route::get('tolak/{id}', [PengaduanController::class, 'halamanTolak'])->name('halTolak');
            Route::post('tolak/{id}', [PengaduanController::class, 'tolak'])->name('tolak');

            Route::get('print/{id}', [PengaduanController::class, 'prntDetail'])->name('print');
        });

        // Kategori
        Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::get('kategori/getKategori', [KategoriController::class, 'getKategori'])->name('kategori.getKategori');
        Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

        // Alasan
        Route::get('alasan', [AlasanController::class, 'index'])->name('alasan');
        Route::get('alasan/getAlasan', [AlasanController::class, 'getAlasan'])->name('alasan.getAlasan');
        Route::post('alasan/store', [AlasanController::class, 'store'])->name('alasan.store');
        Route::get('alasan/edit/{id}', [AlasanController::class, 'edit'])->name('alasan.edit');
        Route::put('alasan/update/{id}', [AlasanController::class, 'update'])->name('alasan.update');
        Route::delete('alasan/delete/{id}', [AlasanController::class, 'destroy'])->name('alasan.delete');
    });
});

Route::get('_petugas', function () {
    return redirect()->route('_petugas.dashboard');
});
