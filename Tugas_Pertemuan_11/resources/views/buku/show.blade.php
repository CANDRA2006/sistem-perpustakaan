@extends('layouts.app')

@section('title', $buku->judul)

@section('content')
<div class="row">
    {{-- Breadcrumb --}}
    <div class="col-12 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
                <li class="breadcrumb-item active">{{ $buku->judul }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    {{-- Kolom Kiri: Info Buku --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-book"></i>
                    Detail Buku
                </h4>
            </div>
            <div class="card-body">
                {{-- Judul --}}
                <h2 class="mb-3">{{ $buku->judul }}</h2>

                {{-- Badge Kategori --}}
                <div class="mb-3">
                    <span class="badge bg-{{ $buku->kategori == 'Programming' ? 'primary' : ($buku->kategori == 'Database' ? 'success' : ($buku->kategori == 'Web Design' ? 'info' : ($buku->kategori == 'Networking' ? 'warning' : 'danger'))) }} fs-6">
                        <i class="bi bi-tag"></i> {{ $buku->kategori }}
                    </span>
                </div>

                {{-- Informasi Detail --}}
                <table class="table table-borderless">
                    <tr>
                        <td width="200" class="fw-bold">
                            <i class="bi bi-upc text-primary"></i> Kode Buku
                        </td>
                        <td>: {{ $buku->kode_buku }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-person text-primary"></i> Pengarang
                        </td>
                        <td>: {{ $buku->pengarang }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-building text-primary"></i> Penerbit
                        </td>
                        <td>: {{ $buku->penerbit }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-calendar text-primary"></i> Tahun Terbit
                        </td>
                        <td>: {{ $buku->tahun_terbit }}</td>
                    </tr>
                    @if ($buku->isbn)
                        <tr>
                            <td class="fw-bold">
                                <i class="bi bi-hash text-primary"></i> ISBN
                            </td>
                            <td>: {{ $buku->isbn }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-translate text-primary"></i> Bahasa
                        </td>
                        <td>: {{ $buku->bahasa }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-cash text-primary"></i> Harga
                        </td>
                        <td>: <span class="text-success fs-5 fw-bold">{{ $buku->harga_format }}</span></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-boxes text-primary"></i> Stok
                        </td>
                        <td>
                            : <span class="fw-bold">{{ $buku->stok }}</span> buku
                            @if ($buku->stok > 0)
                                <span class="badge bg-success ms-2">
                                    <i class="bi bi-check-circle"></i> Tersedia
                                </span>
                            @else
                                <span class="badge bg-danger ms-2">
                                    <i class="bi bi-x-circle"></i> Habis
                                </span>
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- Deskripsi --}}
                @if ($buku->deskripsi)
                    <hr>
                    <h5><i class="bi bi-file-text text-primary"></i> Deskripsi</h5>
                    <p class="text-justify">{{ $buku->deskripsi }}</p>
                @else
                    <hr>
                    <p class="text-muted fst-italic">
                        <i class="bi bi-info-circle"></i> Tidak ada deskripsi untuk buku ini
                    </p>
                @endif

                {{-- Timestamps --}}
                <hr>
                <div class="row text-muted small">
                    <div class="col-md-6">
                        <i class="bi bi-clock"></i>
                        Ditambahkan: {{ $buku->created_at->format('d M Y H:i') }}
                    </div>
                    <div class="col-md-6 text-end">
                        <i class="bi bi-clock-history"></i>
                        Terakhir Update: {{ $buku->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Actions & Info Tambahan --}}
    <div class="col-md-4">
        {{-- Card Actions --}}
        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0">
                    <i class="bi bi-gear"></i> Aksi
                </h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Buku
                </a>

                @if ($buku->stok > 0)
                    <button class="btn btn-success">
                        <i class="bi bi-cart-plus"></i> Pinjam Buku
                    </button>
                @else
                    <button class="btn btn-secondary" disabled>
                        <i class="bi bi-x-circle"></i> Stok Habis
                    </button>
                @endif

                <a href="{{ route('buku.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <hr>

                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-trash"></i> Hapus Buku
                    </button>
                </form>
            </div>
        </div>

        {{-- Card Status Stok --}}
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">
                    <i class="bi bi-info-circle"></i> Status Stok
                </h6>
            </div>
            <div class="card-body">
                @if ($buku->stok == 0)
                    <div class="alert alert-danger mb-0">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Stok Habis!</strong><br />
                        Buku ini sedang tidak tersedia.
                    </div>
                @elseif ($buku->stok <= 5)
                    <div class="alert alert-warning mb-0">
                        <i class="bi bi-exclamation-circle"></i>
                        <strong>Stok Menipis!</strong><br />
                        Tersisa {{ $buku->stok }} buku.
                    </div>
                @else
                    <div class="alert alert-success mb-0">
                        <i class="bi bi-check-circle"></i>
                        <strong>Stok Aman!</strong><br />
                        Tersedia {{ $buku->stok }} buku.
                    </div>
                @endif
            </div>
        </div>

        {{-- Card Buku Serupa --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h6 class="mb-0">
                    <i class="bi bi-collection"></i> Buku Serupa
                </h6>
            </div>
            <div class="card-body">
                @php
                    $bukuSerupa = App\Models\Buku::where('kategori', $buku->kategori)
                                                  ->where('id', '!=', $buku->id)
                                                  ->take(3)
                                                  ->get();
                @endphp

                @forelse ($bukuSerupa as $item)
                    <div class="mb-3">
                        <a href="{{ route('buku.show', $item->id) }}" class="text-decoration-none">
                            <h6 class="mb-1">{{ Str::limit($item->judul, 40) }}</h6>
                        </a>
                        <small class="text-muted">{{ $item->pengarang }}</small>
                    </div>
                    @if (!$loop->last)
                        <hr>
                    @endif
                @empty
                    <p class="text-muted small mb-0">
                        <i class="bi bi-info-circle"></i>
                        Tidak ada buku serupa
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

