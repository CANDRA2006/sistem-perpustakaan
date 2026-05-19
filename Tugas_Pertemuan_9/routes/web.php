<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
Route::get('/about', [PerpustakaanController::class, 'about']);

// Anggota Routes
Route::get('/anggota', function () {
    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'telepon' => '081234567890',
            'alamat' => 'Jakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-002',
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@email.com',
            'telepon' => '082345678901',
            'alamat' => 'Bandung',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-003',
            'nama' => 'Ahmad Rahman',
            'email' => 'ahmad@email.com',
            'telepon' => '083456789012',
            'alamat' => 'Surabaya',
            'status' => 'Aktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-004',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@email.com',
            'telepon' => '084567890123',
            'alamat' => 'Yogyakarta',
            'status' => 'Nonaktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-005',
            'nama' => 'Roni Wijaya',
            'email' => 'roni@email.com',
            'telepon' => '085678901234',
            'alamat' => 'Medan',
            'status' => 'Aktif'
        ]
    ];

    return view('anggota.index', compact('anggota_list'));
})->name('anggota.index');

Route::get('/anggota/{id}', function ($id) {
    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'telepon' => '081234567890',
            'alamat' => 'Jakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-002',
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@email.com',
            'telepon' => '082345678901',
            'alamat' => 'Bandung',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-003',
            'nama' => 'Ahmad Firdaus',
            'email' => 'ahmad@email.com',
            'telepon' => '083456290012',
            'alamat' => 'Semarang',
            'status' => 'Aktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-004',
            'nama' => 'Dewi Puspa',
            'email' => 'dewi@email.com',
            'telepon' => '084902890123',
            'alamat' => 'Solo',
            'status' => 'Nonaktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-005',
            'nama' => 'Roni Kusuma',
            'email' => 'roni@email.com',
            'telepon' => '085670971234',
            'alamat' => 'Balikpapan',
            'status' => 'Aktif'
        ]
    ];

    $anggota = null;
    foreach ($anggota_list as $member) {
        if ($member['id'] == $id) {
            $anggota = $member;
            break;
        }
    }

    if (!$anggota) {
        abort(404, 'Anggota tidak ditemukan');
    }

    return view('anggota.show', compact('anggota', 'anggota_list'));
})->name('anggota.show');

// Kategori Routes
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword?}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])
    ->whereNumber('id')
    ->name('kategori.show');
