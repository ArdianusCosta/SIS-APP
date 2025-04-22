<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
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
    return view('welcome');
})->middleware('auth')->name('welcome');

Route::get('/auth/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/auth/login', [LoginController::class, 'login'])->name('loginSukses');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

//pengguna SIS-APP
Route::middleware(['auth','role:admin'])->group(function () {
Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/hapus/{id}', [UserController::class, 'destroy'])->name('user.hapus');
});

//Absensi SIS-APP
Route::middleware(['auth','role:admin,guru'])->group(function (){
Route::get('/absensi/index', [AbsensiController::class, 'index'])->name('absensi.index');
});

//informasi & penggumuman 
//Email
Route::middleware(['auth','role:admin,guru'])->group(function (){
Route::get('/email/create', [MessageController::class, 'create'])->name('email.create');
Route::post('/email/create', [MessageController::class, 'store'])->name('email.store');
});

//ini downloadnya bisa semua role
Route::middleware(['auth','role:admin,guru,murid'])->group(function(){
Route::get('/download/{filename}', [MessageController::class, 'download'])->name('download.file');
});

//profile SIS-APP
Route::middleware(['auth','role:admin,guru,murid'])->group(function (){
Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

//guru 
Route::middleware(['auth','role:admin,guru'])->group(function (){
Route::get('/manajement/guru/index', [GuruController::class, 'index'])->name('guru.index');
Route::get('/manajement/guru/create', [GuruController::class, 'create'])->name('guru.create');
Route::post('/manajement/guru/create', [GuruController::class, 'store'])->name('guru.store');
Route::get('/manajement/guru/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
Route::post('/manajement/guru/edit/{id}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('/manajement/guru/hapus/{id}', [GuruController::class, 'destroy'])->name('guru.hapus');
});

//ortu
Route::middleware(['auth','role:admin,guru'])->group(function (){
Route::get('/manajement/ortu/index', [OrangTuaController::class, 'index'])->name('ortu.index');
Route::get('/manajement/ortu/create', [OrangTuaController::class, 'create'])->name('ortu.create');
Route::post('/manajement/ortu/create', [OrangTuaController::class, 'store'])->name('ortu.store');
Route::get('/manajement/ortu/edit/{id}', [OrangTuaController::class, 'edit'])->name('ortu.edit');
Route::post('/manajement/ortu/edit/{id}', [OrangTuaController::class, 'update'])->name('ortu.update');
Route::delete('/manajement/ortu/destroy/{id}', [OrangTuaController::class, 'destroy'])->name('ortu.hapus');
});

//siswa
Route::middleware(['auth','role:admin,guru'])->group(function(){
Route::get('/manajement/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/manajement/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
});

//Kelas
Route::middleware(['auth','role:admin,guru,murid'])->group(function(){
Route::get('/manajement/kelas/index', [KelasController::class,'index'])->name('kelas.index');
Route::get('/manajement/kelas/create', [KelasController::class,'create'])->name('kelas.create');
Route::post('/manajement/kelas/create', [KelasController::class,'store'])->name('kelas.store');
Route::get('/manajement/kelas/edit/{id}', [KelasController::class,'edit'])->name('kelas.edit');
Route::post('/manajement/kelas/edit/{id}', [KelasController::class,'update'])->name('kelas.update');
Route::delete('/manajement/kelas/destroy/{id}', [KelasController::class,'destroy'])->name('kelas.destroy');
});