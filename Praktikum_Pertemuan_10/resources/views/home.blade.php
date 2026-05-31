@extends('layouts.app')
 
@section('title', 'Home')
 
@section('content')
<div class="text-center py-5">
    <h1 class="display-4">
        <i class="bi bi-book-fill text-primary"></i>
        Selamat Datang di Sistem Perpustakaan
    </h1>
    <p class="lead text-muted">
        Sistem manajemen perpustakaan modern menggunakan Laravel 12
    </p>
    
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <i class="bi bi-book display-1 text-primary"></i>
                    <h5 class="card-title mt-3">Kelola Buku</h5>
                    <p class="card-text">Manajemen koleksi buku perpustakaan</p>
                    <a href="{{ route('buku.index') }}" class="btn btn-primary">
                        Lihat Buku <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="bi bi-people display-1 text-success"></i>
                    <h5 class="card-title mt-3">Kelola Anggota</h5>
                    <p class="card-text">Manajemen data anggota perpustakaan</p>
                    <a href="{{ route('anggota.index') }}" class="btn btn-success">
                        Lihat Anggota <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-left-right display-1 text-info"></i>
                    <h5 class="card-title mt-3">Transaksi</h5>
                    <p class="card-text">Peminjaman dan pengembalian buku</p>
                    <a href="#" class="btn btn-info text-white">
                        Transaksi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection