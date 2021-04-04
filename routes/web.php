<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\PresensiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrasi', [logincontroller::class,'registrasi'])->name('registrasi');
Route::post('/simpanregistrasi', [logincontroller::class,'simpanregistrasi'])->name('simpanregistrasi');
Route::get('/login', function () {
    return view('login.loginaplikasi');
})->name('login');
Route::post('/postlogin', [logincontroller::class,'postlogin'])->name('postlogin');
Route::get('/logout', [logincontroller::class,'logout'])->name('logout');


route::group(['middleware' => ['auth', 'ceklevel:admin,siswa']], function(){
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::get('/a', function () {
        return view('portofolio.portofolio');
    })->name('a');
});
    
route::group(['middleware' => ['auth', 'ceklevel:siswa']], function(){
    Route::post('/simpan-masuk', [PresensiController::class,'store'])->name('simpan-masuk');
    Route::get('/presensi-masuk', [PresensiController::class,'index'])->name('presensi-masuk');
    Route::get('/presensi-keluar', [PresensiController::class,'keluar'])->name('presensi-keluar');
    Route::post('/ubah-presensi', [PresensiController::class,'presensipulang'])->name('ubah-presensi');
    Route::get('filter-data', [PresensiController::class,'halamanrekap'])->name('filter-data');
    Route::get('filter-data/{tglawal}/{tglakhir}', [PresensiController::class,'tampildatakeseluruhan'])->name('filter-data-keseluruhan');
});
