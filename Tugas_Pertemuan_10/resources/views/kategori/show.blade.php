@extends('layouts.app')

@section('title', 'Detail Kategori - ' . $kategori['nama'])

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
        <li class="breadcrumb-item active" aria-current="page">{{ $kategori['nama'] }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-bookmark"></i> {{ $kategori['nama'] }}
                </h4>
            </div>
            <div class="card-body">
                <p class="lead">{{ $kategori['deskripsi'] }}</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Kategori ID</h6>
                        <p class="h5">#{{ $kategori['id'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Total Buku</h6>
                        <p class="h5">
                            <span class="badge bg-warning text-dark" style="font-size: 1rem;">
                                {{ $kategori['jumlah_buku'] }} Buku
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-book"></i> Daftar Buku dalam Kategori
                </h5>
            </div>
            <div class="card-body">
                @if (count($buku_list) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th class="text-center">Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku_list as $index => $buku)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $buku['judul'] }}</strong>
                                        </td>
                                        <td>{{ $buku['penulis'] }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary">{{ $buku['tahun'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle"></i> Tidak ada buku dalam kategori ini.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Informasi Kategori
                </h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-6">Kategori:</dt>
                    <dd class="col-sm-6">{{ $kategori['nama'] }}</dd>

                    <dt class="col-sm-6">ID:</dt>
                    <dd class="col-sm-6">#{{ $kategori['id'] }}</dd>

                    <dt class="col-sm-6">Total Buku:</dt>
                    <dd class="col-sm-6">
                        <span class="badge bg-primary">{{ $kategori['jumlah_buku'] }}</span>
                    </dd>

                    <dt class="col-sm-6">Buku Aktif:</dt>
                    <dd class="col-sm-6">
                        <span class="badge bg-success">{{ count($buku_list) }}</span>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="bi bi-bar-chart"></i> Statistik
                </h5>
            </div>
            <div class="card-body">
                <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" style="width: {{ (count($buku_list) / $kategori['jumlah_buku'] * 100) }}%" aria-valuenow="{{ count($buku_list) }}" aria-valuemin="0" aria-valuemax="{{ $kategori['jumlah_buku'] }}">
                        {{ count($buku_list) }} / {{ $kategori['jumlah_buku'] }}
                    </div>
                </div>
                <small class="text-muted">Buku yang tersedia</small>
            </div>
        </div>

        <a href="{{ route('kategori.index') }}" class="btn btn-secondary btn-lg w-100">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
