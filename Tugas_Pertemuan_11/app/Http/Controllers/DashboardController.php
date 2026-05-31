<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bukus = collect([
            (object)[
                'id' => 1,
                'judul' => 'Laravel 13',
                'pengarang' => 'Budi',
                'stok' => 10,
                'created_at' => now()
            ],
            (object)[
                'id' => 2,
                'judul' => 'PHP Modern',
                'pengarang' => 'Andi',
                'stok' => 0,
                'created_at' => now()->subDay()
            ],
        ]);

        $anggotas = collect([
            (object)[
                'id' => 1,
                'nama' => 'Budi Santoso',
                'status' => 'Aktif',
                'created_at' => now()
            ],
            (object)[
                'id' => 2,
                'nama' => 'Dewi Lestari',
                'status' => 'Nonaktif',
                'created_at' => now()->subDay()
            ],
        ]);

        return view('dashboard.dashboard', [
            'totalBuku' => $bukus->count(),
            'bukuTersedia' => $bukus->where('stok', '>', 0)->count(),
            'bukuHabis' => $bukus->where('stok', 0)->count(),

            'totalAnggota' => $anggotas->count(),
            'anggotaAktif' => $anggotas->where('status', 'Aktif')->count(),
            'anggotaNonaktif' => $anggotas->where('status', 'Nonaktif')->count(),

            'bukuTerbaru' => $bukus->take(5),
            'anggotaTerbaru' => $anggotas->take(5),
        ]);
    }
}
