@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">Dashboard Perpustakaan</h1>

    <div class="row">

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Buku</h5>
                    <h2>{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Buku Tersedia</h5>
                    <h2>{{ $bukuTersedia }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Buku Habis</h5>
                    <h2>{{ $bukuHabis }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Total Anggota</div>
                <div class="card-body">{{ $totalAnggota }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Aktif</div>
                <div class="card-body">{{ $anggotaAktif }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Nonaktif</div>
                <div class="card-body">{{ $anggotaNonaktif }}</div>
            </div>
        </div>

    </div>

    <div class="row mt-5">

        <div class="col-md-6">
            <h4>5 Buku Terbaru</h4>

            <ul class="list-group">
                @foreach($bukuTerbaru as $buku)
                    <li class="list-group-item">
                        {{ $buku->judul }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h4>5 Anggota Terbaru</h4>

            <ul class="list-group">
                @foreach($anggotaTerbaru as $anggota)
                    <li class="list-group-item">
                        {{ $anggota->nama }}
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <div class="mt-5">
        <h4>Quick Links</h4>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            Dashboard
        </a>

        <a href="{{ route('anggota.index') }}" class="btn btn-success">
            Anggota
        </a>

        <a href="{{ route('kategori.index') }}" class="btn btn-warning">
            Kategori
        </a>
    </div>

</div>
@endsection
