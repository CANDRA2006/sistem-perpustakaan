@extends('layouts.app')

@section('title', 'Daftar Kategori Buku')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-list"></i> Daftar Kategori Buku
            </h2>
            <form class="d-flex" action="{{ route('kategori.search') }}" method="GET">
                <input class="form-control me-2" type="search" name="keyword" placeholder="Cari kategori..." aria-label="Search">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
        </div>
    </div>
</div>

<div class="row">
    @forelse ($kategori_list as $kategori)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-bookmark"></i> {{ $kategori['nama'] }}
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted">
                        {{ $kategori['deskripsi'] }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-info text-dark" style="font-size: 1rem;">
                            <i class="bi bi-book"></i>
                            {{ $kategori['jumlah_buku'] }} Buku
                        </span>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('kategori.show', $kategori['id']) }}" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-arrow-right"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle"></i> Tidak ada kategori yang tersedia.
            </div>
        </div>
    @endforelse
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card bg-light">
            <div class="card-body">
                <h6>
                    <i class="bi bi-bar-chart"></i> Statistik
                </h6>
                <p class="mb-0">
                    <strong>Total Kategori:</strong> {{ count($kategori_list) }} |
                    <strong>Total Buku:</strong> {{ array_sum(array_column($kategori_list, 'jumlah_buku')) }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
