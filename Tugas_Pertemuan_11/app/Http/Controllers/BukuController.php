<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::latest()->get();

        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();

        $kategoris = Buku::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $tahuns = Buku::select('tahun_terbit')
            ->distinct()
            ->orderBy('tahun_terbit', 'desc')
            ->pluck('tahun_terbit');

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }

    public function kategori($kategori)
    {
        $bukus = Buku::where('kategori', $kategori)
            ->latest()
            ->get();

        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();

        $kategoris = Buku::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $tahuns = Buku::select('tahun_terbit')
            ->distinct()
            ->orderBy('tahun_terbit', 'desc')
            ->pluck('tahun_terbit');

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }

    public function search(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('pengarang', 'like', "%{$keyword}%")
                  ->orWhere('penerbit', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        if ($request->filled('stok')) {
            if ($request->stok == 'tersedia') {
                $query->where('stok', '>', 0);
            }

            if ($request->stok == 'habis') {
                $query->where('stok', 0);
            }
        }

        $bukus = $query->latest()->get();

        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();

        $kategoris = Buku::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $tahuns = Buku::select('tahun_terbit')
            ->distinct()
            ->orderBy('tahun_terbit', 'desc')
            ->pluck('tahun_terbit');

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
