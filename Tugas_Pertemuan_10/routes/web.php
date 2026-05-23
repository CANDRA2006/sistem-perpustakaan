<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
Route::get('/about', [PerpustakaanController::class, 'about']);

// Anggota Routes
Route::get('/anggota', function () {
    $anggota_list = [
        ['id' => 1, 'kode' => 'AGT-001', 'nama' => 'Budi Santoso',   'email' => 'budi@email.com',  'telepon' => '081234567890', 'alamat' => 'Jakarta',    'status' => 'Aktif'],
        ['id' => 2, 'kode' => 'AGT-002', 'nama' => 'Siti Nurhaliza', 'email' => 'siti@email.com',  'telepon' => '082345678901', 'alamat' => 'Bandung',    'status' => 'Aktif'],
        ['id' => 3, 'kode' => 'AGT-003', 'nama' => 'Ahmad Rahman',   'email' => 'ahmad@email.com', 'telepon' => '083456789012', 'alamat' => 'Surabaya',   'status' => 'Aktif'],
        ['id' => 4, 'kode' => 'AGT-004', 'nama' => 'Dewi Lestari',   'email' => 'dewi@email.com',  'telepon' => '084567890123', 'alamat' => 'Yogyakarta', 'status' => 'Nonaktif'],
        ['id' => 5, 'kode' => 'AGT-005', 'nama' => 'Roni Wijaya',    'email' => 'roni@email.com',  'telepon' => '085678901234', 'alamat' => 'Medan',      'status' => 'Aktif'],
    ];

    return view('anggota.index', compact('anggota_list'));
})->name('anggota.index');

Route::get('/anggota/{id}', function ($id) {
    $anggota_list = [
        ['id' => 1, 'kode' => 'AGT-001', 'nama' => 'Budi Santoso',   'email' => 'budi@email.com',  'telepon' => '081234567890', 'alamat' => 'Jakarta',    'status' => 'Aktif'],
        ['id' => 2, 'kode' => 'AGT-002', 'nama' => 'Siti Nurhaliza', 'email' => 'siti@email.com',  'telepon' => '082345678901', 'alamat' => 'Bandung',    'status' => 'Aktif'],
        ['id' => 3, 'kode' => 'AGT-003', 'nama' => 'Ahmad Firdaus',  'email' => 'ahmad@email.com', 'telepon' => '083456290012', 'alamat' => 'Semarang',   'status' => 'Aktif'],
        ['id' => 4, 'kode' => 'AGT-004', 'nama' => 'Dewi Puspa',     'email' => 'dewi@email.com',  'telepon' => '084902890123', 'alamat' => 'Solo',       'status' => 'Nonaktif'],
        ['id' => 5, 'kode' => 'AGT-005', 'nama' => 'Roni Kusuma',    'email' => 'roni@email.com',  'telepon' => '085670971234', 'alamat' => 'Balikpapan', 'status' => 'Aktif'],
    ];

    $anggota = null;
    foreach ($anggota_list as $member) {
        if ($member['id'] == $id) {
            $anggota = $member;
            break;
        }
    }

    if (! $anggota) {
        abort(404, 'Anggota tidak ditemukan');
    }

    return view('anggota.show', compact('anggota', 'anggota_list'));
})->name('anggota.show');

// Kategori Routes
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword?}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])
    ->whereNumber('id')
    ->name('kategori.show');

// Testing Accessor & Scope
Route::get('/test-accessor-scope', function () {

    // DUMMY DATA BUKU (simulasi hasil Eloquent + accessor)
    $dummyBuku = collect([
        (object)['id' => 1, 'judul' => 'Belajar Laravel 11',        'pengarang' => 'Budi Raharjo',  'tahun_terbit' => 2024, 'harga' => 125000, 'stok' => 0],
        (object)['id' => 2, 'judul' => 'PHP Modern',                'pengarang' => 'Andi Nugroho',  'tahun_terbit' => 2024, 'harga' => 89000,  'stok' => 3],
        (object)['id' => 3, 'judul' => 'MySQL Lanjutan',            'pengarang' => 'Siti Aminah',   'tahun_terbit' => 2023, 'harga' => 75000,  'stok' => 10],
        (object)['id' => 4, 'judul' => 'JavaScript ES2023',         'pengarang' => 'Ahmad Wijaya',  'tahun_terbit' => 2023, 'harga' => 95000,  'stok' => 20],
        (object)['id' => 5, 'judul' => 'Clean Code Indonesia',      'pengarang' => 'Rudi Hermawan', 'tahun_terbit' => 2025, 'harga' => 115000, 'stok' => 4],
        (object)['id' => 6, 'judul' => 'Algoritma dan Struktur Data','pengarang' => 'Hasan Basri',   'tahun_terbit' => 2021, 'harga' => 60000,  'stok' => 18],
    ]);

    // Simulasi accessor getStatusStokBadgeAttribute
    $getStatusStokBadge = function ($stok) {
        if ($stok === 0)       return '<span class="badge bg-danger">Habis</span>';
        if ($stok <= 5)        return '<span class="badge bg-warning text-dark">Menipis</span>';
        if ($stok <= 15)       return '<span class="badge bg-info text-dark">Sedang</span>';
        return '<span class="badge bg-success">Aman</span>';
    };

    // Simulasi accessor getTahun
    $getTahunLabel = fn($tahun) => $tahun >= 2024 ? 'Buku Baru' : 'Buku Lama';

    // Simulasi scope terbaru 
    $bukuTerbaru     = $dummyBuku->filter(fn($b) => $b->tahun_terbit >= 2024)->values();

    // Simulasi scope stokMenipis
    $bukuStokMenipis = $dummyBuku->filter(fn($b) => $b->stok < 5)->values();

    // Simulasi scope hargaRang
    $bukuHargaRange  = $dummyBuku->filter(fn($b) => $b->harga >= 50000 && $b->harga <= 100000)->values();

    // DUMMY DATA ANGGOTA (hasil Eloquent + accessor)
    $dummyAnggota = collect([
        (object)['id' => 1, 'nama' => 'Budi Santoso',   'status' => 'Aktif',    'tanggal_lahir' => '2005-03-15', 'jenis_kelamin' => 'L', 'created_at' => now()],
        (object)['id' => 2, 'nama' => 'Siti Nurhaliza', 'status' => 'Aktif',    'tanggal_lahir' => '1990-07-22', 'jenis_kelamin' => 'P', 'created_at' => now()],
        (object)['id' => 3, 'nama' => 'Ahmad Rahman',   'status' => 'Aktif',    'tanggal_lahir' => '1985-11-08', 'jenis_kelamin' => 'L', 'created_at' => now()->subMonth()],
        (object)['id' => 4, 'nama' => 'Dewi Lestari',   'status' => 'Nonaktif', 'tanggal_lahir' => '1968-05-30', 'jenis_kelamin' => 'P', 'created_at' => now()->subMonths(3)],
        (object)['id' => 5, 'nama' => 'Roni Wijaya',    'status' => 'Aktif',    'tanggal_lahir' => '2001-12-01', 'jenis_kelamin' => 'L', 'created_at' => now()],
    ]);

    // Simulasi accessor getStatusBadgeAttribute
    $getStatusBadge = fn($status) => $status === 'Aktif'
        ? '<span class="badge bg-success">Aktif</span>'
        : '<span class="badge bg-secondary">Nonaktif</span>';

    // Simulasi accessor getKategoriUsiaAttribute
    $getKategoriUsia = function ($tgl) {
        $umur = \Carbon\Carbon::parse($tgl)->age;
        if ($umur < 20)   return 'Remaja';
        if ($umur <= 50)  return 'Dewasa';
        return 'Senior';
    };

    // Simulasi scope jenisKelamin('L')
    $anggotaLaki = $dummyAnggota->filter(fn($a) => $a->jenis_kelamin === 'L')->values();

    // Simulasi scope terdaftarBulanIni
    $anggotaBulanIni = $dummyAnggota->filter(function ($a) {
        return \Carbon\Carbon::parse($a->created_at)->month === now()->month
            && \Carbon\Carbon::parse($a->created_at)->year  === now()->year;
    })->values();

    // Render html 
    $bulan = now()->locale('id')->isoFormat('MMMM YYYY');

    $html = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Accessor & Scope — Tugas P9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .section-card { border-left: 4px solid; }
        .section-buku    { border-color: #0d6efd; }
        .section-anggota { border-color: #198754; }
        .section-scope   { border-color: #fd7e14; }
        code { background: #f1f3f5; padding: 2px 6px; border-radius: 4px; font-size: .85em; }
    </style>
</head>
<body>
<div class="container py-5">

    <div class="mb-5">
        <h1 class="fw-bold"><i class="bi bi-bug"></i> Testing Accessor &amp; Scope</h1>
        <p class="text-muted">Tugas Pemrograman Web 2 — Pertemuan 10 | Candra Sya'bana Putra Gunadi</p>
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            Data di halaman ini adalah <strong>dummy data</strong> yang mensimulasikan hasil Eloquent Model.
            Setelah migration &amp; seeder dijalankan.
        </div>
    </div>

    <div class="card shadow-sm mb-4 section-card section-buku">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-book"></i> Model Buku — Accessor</h4>
        </div>
        <div class="card-body">
            <p><code>getStatusStokBadgeAttribute()</code> dan <code>getTahunLabelAttribute()</code></p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Status Stok Badge</th>
                            <th class="text-center">Tahun Label</th>
                        </tr>
                    </thead>
                    <tbody>
HTML;

    foreach ($dummyBuku as $buku) {
        $badge  = $getStatusStokBadge($buku->stok);
        $label  = $getTahunLabel($buku->tahun_terbit);
        $labelClass = $buku->tahun_terbit >= 2024 ? 'text-success fw-semibold' : 'text-secondary';
        $html .= <<<ROW
                        <tr>
                            <td><strong>{$buku->judul}</strong></td>
                            <td>{$buku->pengarang}</td>
                            <td class="text-center">{$buku->tahun_terbit}</td>
                            <td class="text-center">{$buku->stok}</td>
                            <td class="text-center">{$badge}</td>
                            <td class="text-center"><span class="{$labelClass}">{$label}</span></td>
                        </tr>
ROW;
    }

    $html .= <<<HTML
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--SCOPE BUKU -->
    <div class="card shadow-sm mb-4 section-card section-scope">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-funnel"></i> Model Buku — Scope</h4>
        </div>
        <div class="card-body">
            <div class="row g-4">

                <!-- Scope terbaru -->
                <div class="col-md-4">
                    <h6 class="fw-bold text-primary"><i class="bi bi-star"></i> scopeTerbaru()</h6>
                    <p class="text-muted small">Buku dengan <code>tahun_terbit &gt;= 2024</code></p>
                    <ul class="list-group list-group-flush">
HTML;

    foreach ($bukuTerbaru as $b) {
        $html .= "<li class='list-group-item'><strong>{$b->judul}</strong> <span class='badge bg-primary'>{$b->tahun_terbit}</span></li>";
    }

    $html .= <<<HTML
                    </ul>
                    <span class="badge bg-primary mt-2">{$bukuTerbaru->count()} buku</span>
                </div>

                <!-- Scope stokMenipis -->
                <div class="col-md-4">
                    <h6 class="fw-bold text-danger"><i class="bi bi-exclamation-triangle"></i> scopeStokMenipis()</h6>
                    <p class="text-muted small">Buku dengan <code>stok &lt; 5</code></p>
                    <ul class="list-group list-group-flush">
HTML;

    foreach ($bukuStokMenipis as $b) {
        $html .= "<li class='list-group-item d-flex justify-content-between'><strong>{$b->judul}</strong> <span class='text-danger fw-bold'>Stok: {$b->stok}</span></li>";
    }

    $html .= <<<HTML
                    </ul>
                    <span class="badge bg-danger mt-2">{$bukuStokMenipis->count()} buku</span>
                </div>

                <!-- Scope hargaRange -->
                <div class="col-md-4">
                    <h6 class="fw-bold text-success"><i class="bi bi-cash-coin"></i> scopeHargaRange(50000, 100000)</h6>
                    <p class="text-muted small">Buku dengan harga antara Rp 50.000 – Rp 100.000</p>
                    <ul class="list-group list-group-flush">
HTML;

    foreach ($bukuHargaRange as $b) {
        $hargaFmt = 'Rp ' . number_format($b->harga, 0, ',', '.');
        $html .= "<li class='list-group-item d-flex justify-content-between'><strong>{$b->judul}</strong> <span class='text-success'>{$hargaFmt}</span></li>";
    }

    $html .= <<<HTML
                    </ul>
                    <span class="badge bg-success mt-2">{$bukuHargaRange->count()} buku</span>
                </div>

            </div><!-- .row -->
        </div>
    </div>

    <!-- Accessor -->
    <div class="card shadow-sm mb-4 section-card section-anggota">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="bi bi-people"></i> Model Anggota — Accessor</h4>
        </div>
        <div class="card-body">
            <p><code>getStatusBadgeAttribute()</code> dan <code>getKategoriUsiaAttribute()</code></p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">Tgl Lahir</th>
                            <th class="text-center">JK</th>
                            <th class="text-center">Status Badge</th>
                            <th class="text-center">Kategori Usia</th>
                        </tr>
                    </thead>
                    <tbody>
HTML;

    foreach ($dummyAnggota as $a) {
        $badge     = $getStatusBadge($a->status);
        $usia      = $getKategoriUsia($a->tanggal_lahir);
        $umur      = \Carbon\Carbon::parse($a->tanggal_lahir)->age;
        $jkLabel   = $a->jenis_kelamin === 'L' ? '<span class="badge bg-primary">L</span>' : '<span class="badge bg-pink" style="background:#d63384;color:#fff">P</span>';

        $usiaClass = match($usia) {
            'Remaja' => 'text-info fw-semibold',
            'Dewasa' => 'text-success fw-semibold',
            'Senior' => 'text-warning fw-semibold',
            default  => '',
        };

        $html .= <<<ROW
                        <tr>
                            <td><strong>{$a->nama}</strong></td>
                            <td class="text-center">{$a->tanggal_lahir} <small class="text-muted">({$umur} th)</small></td>
                            <td class="text-center">{$jkLabel}</td>
                            <td class="text-center">{$badge}</td>
                            <td class="text-center"><span class="{$usiaClass}">{$usia}</span></td>
                        </tr>
ROW;
    }

    $html .= <<<HTML
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scope Anggota -->
    <div class="card shadow-sm mb-4 section-card section-scope">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-funnel"></i> Model Anggota — Scope</h4>
        </div>
        <div class="card-body">
            <div class="row g-4">

                <!-- Scope jenisKelamin('L') -->
                <div class="col-md-6">
                    <h6 class="fw-bold text-primary"><i class="bi bi-person"></i> scopeJenisKelamin('L')</h6>
                    <p class="text-muted small">Anggota dengan jenis kelamin Laki-laki</p>
                    <ul class="list-group">
HTML;

    foreach ($anggotaLaki as $a) {
        $html .= "<li class='list-group-item'><i class='bi bi-person-fill text-primary'></i> {$a->nama}</li>";
    }

    $html .= <<<HTML
                    </ul>
                    <span class="badge bg-primary mt-2">{$anggotaLaki->count()} anggota</span>
                </div>

                <!-- Scope terdaftarBulanIni -->
                <div class="col-md-6">
                    <h6 class="fw-bold text-success"><i class="bi bi-calendar-check"></i> scopeTerdaftarBulanIni()</h6>
                    <p class="text-muted small">Anggota yang mendaftar bulan <strong>{$bulan}</strong></p>
                    <ul class="list-group">
HTML;

    foreach ($anggotaBulanIni as $a) {
        $tgl = \Carbon\Carbon::parse($a->created_at)->isoFormat('D MMMM YYYY');
        $html .= "<li class='list-group-item d-flex justify-content-between'><span><i class='bi bi-person-check text-success'></i> {$a->nama}</span> <small class='text-muted'>{$tgl}</small></li>";
    }

    $html .= <<<HTML
                    </ul>
                    <span class="badge bg-success mt-2">{$anggotaBulanIni->count()} anggota</span>
                </div>

            </div>
        </div>
    </div>

    <div class="text-muted mt-4 small">
        <i class="bi bi-clock"></i> Generated at: {{ now()->format('d M Y H:i:s') }}
    </div>

</div>
</body>
</html>
HTML;

    $html = str_replace('{{ now()->format(\'d M Y H:i:s\') }}', now()->format('d M Y H:i:s'), $html);

    return $html;
});
