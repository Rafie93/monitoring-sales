<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Absensi\AbsensiCreate;
use App\Livewire\Absensi\AbsensiData;
use App\Livewire\Customer\CustomerCreate;
use App\Livewire\Customer\CustomerData;
use App\Livewire\DashboardController;
use App\Livewire\LaporanConroller;
use App\Livewire\Master\MobilController;
use App\Livewire\Master\SalesmanController;
use App\Livewire\Master\TipeController;
use App\Livewire\Pembayaran\PembayaranCreate;
use App\Livewire\Pembayaran\PembayaranData;
use App\Livewire\Pencapaian\PencapaianCreate;
use App\Livewire\Pencapaian\PencapaianData;
use App\Livewire\Pesanan\PesananCreate;
use App\Livewire\Pesanan\PesananData;
use App\Livewire\Setting\HarikerjaController;
use App\Livewire\UserController;
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

Route::get('/', [AuthController::class,'index'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('auth.login');
Route::get('/logout', [AuthController::class,'logout'])->name('auth.logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard',DashboardController::class)->name('dashboard');
    Route::get('/customer',CustomerData::class)->name('customer');

    Route::get('/pesanan',PesananData::class)->name('pesanan');
    Route::get('/pesanan/create',PesananCreate::class)->name('pesanan.create');
    Route::get('/pesanan/edit/{id_pesanan}',PesananCreate::class)->name('pesanan.edit');

    Route::get('/pesanan/pembayaran/{id_pesanan}',PembayaranData::class)->name('pesanan.pembayaran');
    Route::get('/pesanan/pembayaran/create/{id_pesanan}',PembayaranCreate::class)->name('pesanan.pembayaran.create');


    Route::get('/absensi',AbsensiData::class)->name('absensi');
    Route::get('/absensi/create',AbsensiCreate::class)->name('absensi.create');

    Route::get('/pencapaian',PencapaianData::class)->name('pencapaian');
    Route::get('/pencapaian/create',PencapaianCreate::class)->name('pencapaian.create');

    Route::get('/master/salesman',SalesmanController::class)->name('master.salesman');
    Route::get('/master/tipe',TipeController::class)->name('master.tipe');
    Route::get('/master/mobil',MobilController::class)->name('master.mobil');

    Route::get('/setting/user',UserController::class)->name('setting.user');
    Route::get('/setting/harikerja',HarikerjaController::class)->name('setting.harikerja');


    Route::get('/laporan/{jenis}',LaporanConroller::class)->name('laporan.form');
    Route::get('/laporan/laporan-pesanan/pdf',[LaporanConroller::class,'pdfPesanan'])->name('laporan.pesanan');
    Route::get('/laporan/laporan-pembayaran/pdf',[LaporanConroller::class,'pdfPembayaran'])->name('laporan.pembayaran');
    Route::get('/laporan/laporan-kehadiran/pdf',[LaporanConroller::class,'pdfKehadiran'])->name('laporan.kehadiran');
    Route::get('/laporan/laporan-pencapaian/pdf',[LaporanConroller::class,'pdfPencapaian'])->name('laporan.pencapaian');
    Route::get('/laporan/laporan-pencapaian-sales/pdf',[LaporanConroller::class,'pdfPencapaiansales'])->name('laporan.pencapaian-sales');

});