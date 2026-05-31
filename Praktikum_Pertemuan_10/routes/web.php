<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;
use App\Models\Buku;
use App\Models\Anggota;

// Halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('buku', function () {
    return view('buku');
})->name('buku.index');

Route::get('anggota', function () {
    return view('anggota');
})->name('anggota.index');

