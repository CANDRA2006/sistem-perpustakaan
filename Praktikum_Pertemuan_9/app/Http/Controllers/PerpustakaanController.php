<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    // Halaman utama perpustakaan
    public function index()
    {
        $nama_sistem = "Sistem Perpustakaan Laravel";
        $versi = "1.2.x";

        $total_buku = 5;

        $buku_list = [
            [
                'id' => 1,
                'judul' => 'Pemrograman PHP',
                'pengarang' => 'Budi Raharjo',
                'harga' => 75000,
                'stok' => 10
            ],
            [
                'id' => 2,
                'judul' => 'Laravel Framework',
                'pengarang' => 'Andi Nugroho',
                'harga' => 125000,
                'stok' => 5
            ],
            [
                'id' => 3,
                'judul' => 'MySQL Database',
                'pengarang' => 'Siti Aminah',
                'harga' => 95000,
                'stok' => 0
            ]
        ];

        return view('perpustakaan.index', compact(
            'nama_sistem',
            'versi',
            'total_buku',
            'buku_list'
        ));
    }

    // Detail buku
    public function show($id)
    {
        $buku_list = [
            1 => [
                'id' => 1,
                'judul' => 'Pemrograman PHP',
                'pengarang' => 'Budi Raharjo',
                'penerbit' => 'Informatika',
                'tahun' => 2023,
                'harga' => 75000,
                'stok' => 10,
                'deskripsi' => 'Buku panduan PHP lengkap'
            ],

            2 => [
                'id' => 2,
                'judul' => 'Laravel Framework',
                'pengarang' => 'Andi Nugroho',
                'penerbit' => 'Graha Ilmu',
                'tahun' => 2024,
                'harga' => 125000,
                'stok' => 5,
                'deskripsi' => 'Belajar Laravel modern'
            ]
        ];

        if (!isset($buku_list[$id])) {
            abort(404, 'Buku tidak ditemukan');
        }

        $buku = $buku_list[$id];

        return view('perpustakaan.show', compact('buku'));
    }

    // Halaman about
    public function about()
    {
        $info = [
            'nama' => 'Sistem Perpustakaan Laravel',
            'versi' => '1.0.0',
            'developer' => 'Mahasiswa'
        ];

        return view('perpustakaan.about', compact('info'));
    }
}