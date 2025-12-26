<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminGuruController;
use App\Http\Controllers\admin\AdminSiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\guru\GuruCetakLaporanController;
use App\Http\Controllers\guru\GuruDashboardController;
use App\Http\Controllers\siswa\siswaDashboardController;
use App\Http\Controllers\siswa\SiswaLaporanController;
use App\Http\Controllers\guru\GuruLaporanController;
use App\Http\Controllers\guru\GuruNotifikasiController;
use App\Http\Controllers\guru\GuruProfileController;
use App\Http\Controllers\guru\GuruRiwayatController;
use App\Http\Controllers\siswa\SiswaNotifikasiController;
use App\Http\Controllers\siswa\SiswaProfileController;
use App\Http\Controllers\siswa\SiswaRiwayatController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/doRegister', [AuthController::class, 'doRegister']);
Route::post('/doLogin', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/notifikasi/read/{id}', [Controller::class, 'markAsRead']);
Route::post('/notifikasi/markAll', [Controller::class, 'markAll']);
Route::delete('/notifikasi/delete/{id}', [Controller::class, 'deleteNotif']);

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        //dashboard
        Route::get('/admin', [AdminDashboardController::class, 'index']);
        //siswa
        Route::get('/admin/kelola-siswa', [AdminSiswaController::class, 'index']);
        Route::get('/admin/kelola-siswa/create', [AdminSiswaController::class, 'create']);
        Route::post('/admin/kelola-siswa/store', [AdminSiswaController::class, 'store']);
        Route::get('/admin/kelola-siswa/edit/{id}', [AdminSiswaController::class, 'edit']);
        Route::put('/admin/kelola-siswa/update/{id}', [AdminSiswaController::class, 'update']);
        Route::delete('/admin/kelola-siswa/delete/{id}', [AdminSiswaController::class, 'delete']);
        //guru
        Route::get('/admin/kelola-guru', [AdminGuruController::class, 'index']);
        Route::get('/admin/kelola-guru/create', [AdminGuruController::class, 'create']);
        Route::post('/admin/kelola-guru/store', [AdminGuruController::class, 'store']);
        Route::get('/admin/kelola-guru/edit/{id}', [AdminGuruController::class, 'edit']);
        Route::put('/admin/kelola-guru/update/{id}', [AdminGuruController::class, 'update']);
        Route::delete('/admin/kelola-guru/delete/{id}', [AdminGuruController::class, 'delete']);
        //admin 
        Route::get('/admin/kelola-admin', [AdminController::class, 'index']);
        Route::get('/admin/kelola-admin/create', [AdminController::class, 'create']);
        Route::post('/admin/kelola-admin/store', [AdminController::class, 'store']);
        Route::get('/admin/kelola-admin/edit/{id}', [AdminController::class, 'edit']);
        Route::put('/admin/kelola-admin/update/{id}', [AdminController::class, 'update']);
        Route::delete('/admin/kelola-admin/delete/{id}', [AdminController::class, 'delete']);
    });
    Route::middleware(['role:siswa'])->group(function () {
        //dashboard
        Route::get('/siswa', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
        //laporan
        Route::get('/laporan', [SiswaLaporanController::class, 'index'])->name('siswa.laporan');
        Route::post('/laporan/send', [SiswaLaporanController::class, 'send']);
        //riwayat
        Route::get('/riwayat-laporan', [SiswaRiwayatController::class, 'index'])->name('siswa.riwayat');
        Route::get('/riwayat-laporan/detail/{id}', [SiswaRiwayatController::class, 'detail']);
        Route::post('/riwayat-laporan/send/{id}', [SiswaRiwayatController::class, 'send']);
        //profile
        Route::get('/siswa/profile', [SiswaProfileController::class, 'index']);
        Route::post('/siswa/profile/update/{id}', [SiswaProfileController::class, 'update']);
        //notifikasi
        Route::get('/siswa/notifikasi', [SiswaNotifikasiController::class, 'index']);
    });
    Route::middleware(['role:kepala-sekolah,waka-kesiswaan,waka-kurikulum,BK,tata-usaha'])->group(function () {
        //dashboard
        Route::get('/guru', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
        //tanggapan
        Route::get('/guru/tanggapan', [GuruLaporanController::class, 'index'])->name('guru.tanggapan');
        Route::post('/guru/tanggapan/send', [GuruLaporanController::class, 'send']);
        //riwayat
        Route::get('/guru/riwayat', [GuruRiwayatController::class, 'index'])->name('guru.riwayat');
        Route::get('/guru/riwayat/detail/{id}', [GuruRiwayatController::class, 'detail']);
        Route::post('/guru/riwayat/send/{id}', [GuruRiwayatController::class, 'send']);
        Route::get('/guru/riwayat/detail/selesai/{id}', [GuruRiwayatController::class, 'selesai']);
        //laporan
        Route::get('/guru/laporan', [GuruCetakLaporanController::class, 'index'])->name('guru.laporan');
        //profile
        Route::get('/guru/profile', [GuruProfileController::class, 'index']);
        Route::put('/guru/profile/update/{id}', [GuruProfileController::class, 'update']);
        //notifikasi
        Route::get('/guru/notifikasi', [GuruNotifikasiController::class, 'index']);
    });
});
