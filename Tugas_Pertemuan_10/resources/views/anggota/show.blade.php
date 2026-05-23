@extends('layouts.app')

@section('title', 'Detail Anggota - ' . $anggota['nama'])

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('anggota.index') }}"><i class="bi bi-people"></i> Anggota</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Detail Anggota</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-person-circle"></i> Detail Anggota
                </h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Kode Anggota</h6>
                        <p class="h5">
                            <span class="badge bg-info text-dark">{{ $anggota['kode'] }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Status</h6>
                        <p>
                            @if ($anggota['status'] == 'Aktif')
                                <span class="badge bg-success" style="font-size: 1rem;">
                                    <i class="bi bi-check-circle"></i> {{ $anggota['status'] }}
                                </span>
                            @else
                                <span class="badge bg-danger" style="font-size: 1rem;">
                                    <i class="bi bi-x-circle"></i> {{ $anggota['status'] }}
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">
                            <i class="bi bi-person"></i> Nama Lengkap
                        </h6>
                        <p class="h5">{{ $anggota['nama'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">
                            <i class="bi bi-envelope"></i> Email
                        </h6>
                        <p class="h5">
                            <a href="mailto:{{ $anggota['email'] }}">{{ $anggota['email'] }}</a>
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">
                            <i class="bi bi-telephone"></i> Telepon
                        </h6>
                        <p class="h5">
                            <a href="tel:{{ $anggota['telepon'] }}">{{ $anggota['telepon'] }}</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">
                            <i class="bi bi-geo-alt"></i> Alamat
                        </h6>
                        <p class="h5">{{ $anggota['alamat'] }}</p>
                    </div>
                </div>

                <hr>

                <div class="d-grid gap-2 d-sm-flex">
                    <a href="{{ route('anggota.index') }}" class="btn btn-lg btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Informasi Tambahan
                </h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-5">ID Anggota:</dt>
                    <dd class="col-sm-7">#{{ $anggota['id'] }}</dd>

                    <dt class="col-sm-5 text-truncate">Kode:</dt>
                    <dd class="col-sm-7">
                        {{ $anggota['kode'] }}
                    </dd>

                    <dt class="col-sm-5">Total Anggota:</dt>
                    <dd class="col-sm-7">{{ count($anggota_list) }}</dd>
                </dl>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="bi bi-bookmark"></i> Akses Cepat
                </h5>
            </div>
            <div class="card-body">
                <a href="mailto:{{ $anggota['email'] }}" class="btn btn-info btn-sm w-100 mb-2">
                    <i class="bi bi-envelope"></i> Kirim Email
                </a>
                <a href="tel:{{ $anggota['telepon'] }}" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-telephone"></i> Hubungi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
