<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\InfomasiController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PPDBController;

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
    return view('welcome');
})->middleware('auth')->name('welcome');

Route::get('/auth/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/auth/login', [LoginController::class, 'login'])->name('loginSukses');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('auth.logout');
//Lupa pw
Route::get('auth/forgotPW/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('auth/forgotPW/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('auth/forgotPW/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('auth/forgotPW/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
//api-login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//pengguna SIS-APP
Route::middleware(['auth','check.status','role:admin'])->group(function () {
Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/hapus/{id}', [UserController::class, 'destroy'])->name('user.hapus');
//manajement-guru
Route::get('/manajement/guru/index', [GuruController::class, 'index'])->name('guru.index');
Route::get('/manajement/guru/create', [GuruController::class, 'create'])->name('guru.create');
Route::post('/manajement/guru/create', [GuruController::class, 'store'])->name('guru.store');
Route::get('/manajement/guru/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
Route::post('/manajement/guru/edit/{id}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('/manajement/guru/hapus/{id}', [GuruController::class, 'destroy'])->name('guru.hapus');
Route::get('/exportGuru', [GuruController::class, 'export'])->name('guru.export');
//admin-status
Route::delete('/PPDB/online/destroy/{id}', [PPDBController::class, 'destroy'])->name('PPDBonline.destroy');
Route::get('/PPDB/status/index-admin', [PPDBController::class,'adminIndex'])->name('admin.ppdb.index');
Route::post('/PPDB/status/index-admin/{id}/update-status', [PPDBController::class,'updateStatus'])->name('admin.ppdb.update');
});


Route::middleware(['auth','check.status','role:admin,guru'])->group(function(){
//manajement-ortu
Route::get('/manajement/ortu/index', [OrangTuaController::class, 'index'])->name('ortu.index');
Route::get('/manajement/ortu/create', [OrangTuaController::class, 'create'])->name('ortu.create');
Route::post('/manajement/ortu/create', [OrangTuaController::class, 'store'])->name('ortu.store');
Route::get('/manajement/ortu/edit/{id}', [OrangTuaController::class, 'edit'])->name('ortu.edit');
Route::post('/manajement/ortu/edit/{id}', [OrangTuaController::class, 'update'])->name('ortu.update');
Route::delete('/manajement/ortu/destroy/{id}', [OrangTuaController::class, 'destroy'])->name('ortu.hapus');
Route::get('/exportOrangTua', [OrangTuaController::class,'export'])->name('ortu.export');
Route::post('/importOrangTua', [OrangTuaController::class, 'import'])->name('ortu.import');
//manajement-siswa
Route::get('/manajement/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/manajement/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/manajement/siswa/create', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/manajement/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::post('/manajement/siswa/edit/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/manajement/siswa/destroy/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
Route::post('/importSiswa', [SiswaController::class, 'import'])->name('siswa.import');
Route::get('/exportSiswa', [SiswaController::class, 'export'])->name('siswa.import');
//absensi-SIS
Route::get('/absensi/input/list', [AbsensiController::class, 'list'])->name('absensi.list');
Route::get('/absensi/input/create', [AbsensiController::class, 'create'])->name('absensi-input.create');
Route::post('/absensi/input/create', [AbsensiController::class, 'store'])->name('absensi-input.store');
Route::get('/absensi/input/cari', [AbsensiController::class, 'cariSiswa']);
//scan
Route::get('/absensi/scan/index-scan', [AbsensiController::class, 'indexScan'])->name('index-scan');
Route::post('/absensi/scan/index-scan', [AbsensiController::class, 'generateQr'])->name('generate-qr.code');
Route::get('/absensi/scan/scan-kamera', [AbsensiController::class, 'scanKamera'])->name('scan-kamera');
//informasi & penggumuman 
//Email
Route::get('/email/create', [MessageController::class, 'create'])->name('email.create');
Route::post('/email/create', [MessageController::class, 'store'])->name('email.store');
//khusus
Route::get('/informasi/create', [InfomasiController::class, 'create'])->name('informasi.create');
Route::post('/informasi/create', [InfomasiController::class, 'store'])->name('informasi.store');
});


Route::middleware(['auth','check.status','role:admin,guru,murid'])->group(function(){
//contact untuk hubugin bang costaaja .. wop tapi belum jadi
Route::get('/contact_to_speatseed/index-spreatseed', [ContactController::class, 'index'])->name('contact-to-speedseat.index');
Route::post('/contact_to_speatseed/index-spreatseed', [ContactController::class, 'store'])->name('contact-to-speedseat.store');
//surat
Route::get('/surat-izin/index', [SuratController::class, 'index'])->name('surat.index');
Route::get('/surat-izin/keluar-kelas/create', [SuratController::class, 'createKeluarKelas'])->name('keluar-kelas.create');
Route::post('/surat-izin/keluar-kelas/create', [SuratController::class, 'storeKeluarKelas'])->name('keluar-kelas.store');
Route::get('/surat-izin/keluar-kelas/surat/{id}', [SuratController::class, 'showKeluarKelas'])->name('keluar-kelas.surat');
Route::get('/surat-izin/keluar-sekolah/create', [SuratController::class, 'createKeluarSekolah'])->name('keluar-sekolah.create');
Route::post('/surat-izin/keluar-sekolah/create', [SuratController::class, 'storeKeluarSekolah'])->name('keluar-sekolah.store');
Route::get('/surat-izin/keluar-sekolah/surat/{id}', [SuratController::class, 'showKeluarSekolah'])->name('keluar-sekolah.surat');
Route::get('/surat-izin/kelab/create', [SuratController::class, 'createKeLab'])->name('kelab-create');
Route::post('/surat-izin/kelab/create', [SuratController::class, 'storeKeLab'])->name('kelab-store');
Route::get('/surat-izin/kelab/surat/{id}',[SuratController::class, 'showKeLab'])->name('surat-kelab');
//informasi khusus
Route::get('/informasi/index', [InfomasiController::class, 'index'])->name('informasi.index');
//profile SIS-APP
Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
//ini downloadnya bisa semua role
Route::get('/download/{filename}', [MessageController::class, 'download'])->name('download.file');
//manajement-akademik
Route::get('/akademik/index', [AkademikController::class, 'index'])->name('akademik.index');
//kontak-guru
Route::get('/kontak-guru/index', [GuruController::class, 'kontakGuru'])->name('kontak-guru'); 
//manajement-kelas
Route::get('/manajement/kelas/index', [KelasController::class,'index'])->name('kelas.index');
Route::get('/manajement/kelas/create', [KelasController::class,'create'])->name('kelas.create');
Route::post('/manajement/kelas/create', [KelasController::class,'store'])->name('kelas.store');
Route::get('/manajement/kelas/edit/{id}', [KelasController::class,'edit'])->name('kelas.edit');
Route::post('/manajement/kelas/edit/{id}', [KelasController::class,'update'])->name('kelas.update');
Route::delete('/manajement/kelas/destroy/{id}', [KelasController::class,'destroy'])->name('kelas.destroy');
Route::get('/exportKelas', [KelasController::class,'export'])->name('kelas.export');  
//PPDB
Route::get('/PPDB/online/index', [PPDBController::class, 'index'])->name('PPDBonline.index');
Route::get('/PPDB/online/create', [PPDBController::class, 'create'])->name('PPDBonline.create');
Route::post('/PPDB/online/store', [PPDBController::class, 'store'])->name('PPDBonline.store');
});
