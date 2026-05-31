@extends('layouts.app')

@section('title', $anggota->nama)

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}">Anggota</a></li>
                <li class="breadcrumb-item active">{{ $anggota->nama }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="bi bi-person"></i>
                    Detail Anggota
                </h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    @if ($anggota->jenis_kelamin == 'Laki-laki')
                        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                    @else
                        <i class="bi bi-person-circle text-danger" style="font-size: 5rem;"></i>
                    @endif
                    <h3 class="mt-2">{{ $anggota->nama }}</h3>
                    @if ($anggota->status == 'Aktif')
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle"></i> Anggota Aktif
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            <i class="bi bi-x-circle"></i> Nonaktif
                        </span>
                    @endif
                </div>

                <table class="table table-borderless">
                    <tr>
                        <td width="200" class="fw-bold">
                            <i class="bi bi-upc text-success"></i> Kode Anggota
                        </td>
                        <td>: <code>{{ $anggota->kode_anggota }}</code></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-envelope text-success"></i> Email
                        </td>
                        <td>: {{ $anggota->email }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-telephone text-success"></i> Telepon
                        </td>
                        <td>: {{ $anggota->telepon }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-geo-alt text-success"></i> Alamat
                        </td>
                        <td>: {{ $anggota->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-calendar text-success"></i> Tanggal Lahir
                        </td>
                        <td>: {{ $anggota->tanggal_lahir->format('d m y') }} ({{ $anggota->umur }} tahun)</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-gender-ambiguous text-success"></i> Jenis Kelamin
                        </td>
                        <td>: {{ $anggota->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-briefcase text-success"></i> Pekerjaan
                        </td>
                        <td>: {{ $anggota->pekerjaan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            <i class="bi bi-calendar-check text-success"></i> Tanggal Daftar
                        </td>
                        <td>: {{ $anggota->tanggal_daftar->format('d F Y') }} ({{ $anggota->lama_anggota }} hari)</td>
                    </tr>
                </table>

                <hr>
                <div class="row text-muted small">
                    <div class="col-md-6">
                        <i class="bi bi-clock"></i>
                        Ditambahkan: {{ $anggota->created_at->format('d M Y H:i') }}
                    </div>
                    <div class="col-md-6 text-end">
                        <i class="bi bi-clock-history"></i>
                        Terakhir Update: {{ $anggota->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0">
                    <i class="bi bi-gear"></i> Aksi
                </h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Anggota
                </a>
                <a href="{{ route('anggota.index') }}" class="btn btn-outline-success">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
