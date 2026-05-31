@extends('layouts.app')

@section('title', 'Hasil Pencarian Kategori')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kategori.index') }}"><i class="bi bi-list"></i> Kategori Buku</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
    </ol>
</nav>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>
                    <i class="bi bi-search"></i> Hasil Pencarian untuk: 
                    <mark>{{ $keyword }}</mark>
                </h4>
                <p class="text-muted">
                    Ditemukan <strong>{{ count($hasil_pencarian) }}</strong> kategori yang sesuai dengan pencarian Anda.
                </p>
            </div>
        </div>
    </div>
</div>

@if (count($hasil_pencarian) > 0)
    <div class="row">
        @foreach ($hasil_pencarian as $kategori)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-bookmark"></i> 
                            {!! str_ireplace($keyword, '<mark style="background-color: #fff3cd; color: #000;">' . $keyword . '</mark>', $kategori['nama']) !!}
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">
                            {!! str_ireplace($keyword, '<mark style="background-color: #fff3cd; color: #000;">' . $keyword . '</mark>', $kategori['deskripsi']) !!}
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
        @endforeach
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kategori
            </a>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">
                    <i class="bi bi-exclamation-triangle"></i> Tidak ada hasil
                </h4>
                <p>
                    Kata kunci "<strong>{{ $keyword }}</strong>" tidak ditemukan dalam kategori buku. 
                    Silakan coba dengan kata kunci yang berbeda.
                </p>
                <hr>
                <a href="{{ route('kategori.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
