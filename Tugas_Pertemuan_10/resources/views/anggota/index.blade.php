@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-people"></i> Daftar Anggota Perpustakaan
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Kode Anggota</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anggota_list as $index => $anggota)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ $anggota['kode'] }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $anggota['nama'] }}</strong>
                                    </td>
                                    <td>
                                        <i class="bi bi-envelope"></i> {{ $anggota['email'] }}
                                    </td>
                                    <td>
                                        @if ($anggota['status'] == 'Aktif')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> {{ $anggota['status'] }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle"></i> {{ $anggota['status'] }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('anggota.show', $anggota['id']) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i> Tidak ada data anggota
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <p class="text-muted">
            <strong>Total Anggota:</strong> {{ count($anggota_list) }}
        </p>
    </div>
</div>
@endsection
