<?php
ob_start();
session_start();

// PROSES SANITASI
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function highlight_keyword($text, $keyword) {
    if ($keyword === '') {
        return $text;
    }

    $escaped = preg_quote($keyword, '/');
    return preg_replace('/(' . $escaped . ')/i', '<mark>$1</mark>', $text);
}

// LIST DATA BUKU 
$buku_list = [
    [
        "kode" => "BK001",
        "judul" => "Kali Linux Fundamental",
        "kategori" => "Pemrograman",
        "pengarang" => "Budi",
        "penerbit" => "Gramedia",
        "tahun" => 2020,
        "harga" => 95000,
        "stok" => 10
    ],
    [
        "kode" => "BK002",
        "judul" => "Dasar-dasar Basis Data",
        "kategori" => "Pemrograman",
        "pengarang" => "Doni",
        "penerbit" => "Gramedia",
        "tahun" => 2020,
        "harga" => 85000,
        "stok" => 0
    ],
    [
        "kode" => "BK003",
        "judul" => "Step by Step Jadi Bug Hunter",
        "kategori" => "Networking",
        "pengarang" => "Joko",
        "penerbit" => "Elex",
        "tahun" => 2022,
        "harga" => 90000,
        "stok" => 6
    ],
    [
        "kode" => "BK004",
        "judul" => "Jaringan Komputer",
        "kategori" => "Networking",
        "pengarang" => "Raditya",
        "penerbit" => "Gramedia",
        "tahun" => 2018,
        "harga" => 95000,
        "stok" => 2
    ],
    [
        "kode" => "BK005",
        "judul" => "The Red Team Playbook: Dari Recon hingga Domain Takeover",
        "kategori" => "Networking",
        "pengarang" => "Robby",
        "penerbit" => "Gramedia",
        "tahun" => 2026,
        "harga" => 100000,
        "stok" => 20
    ],
    [
        "kode" => "BK006",
        "judul" => "Fundamental Python untuk Pemula",
        "kategori" => "Pemrograman",
        "pengarang" => "Raka Pratama",
        "penerbit" => "TechPress Nusantara",
        "tahun" => 2023,
        "harga" => 88000,
        "stok" => 4
    ],
    [
        "kode" => "BK007",
        "judul" => "Konsep Machine Learning Modern",
        "kategori" => "AI",
        "pengarang" => "Dimas Saputra",
        "penerbit" => "Digital Insight",
        "tahun" => 2021,
        "harga" => 120000,
        "stok" => 0
    ],
    [
        "kode" => "BK008",
        "judul" => "Deep Learning: Teori dan Implementasi",
        "kategori" => "AI",
        "pengarang" => "Bagas Wicaksono",
        "penerbit" => "Inovasi Digital",
        "tahun" => 2022,
        "harga" => 130000,
        "stok" => 6
    ],
    [
        "kode" => "BK009",
        "judul" => "Dasar Keamanan Jaringan Komputer",
        "kategori" => "Networking",
        "pengarang" => "Arief Hidayat",
        "penerbit" => "Cyber Media Press",
        "tahun" => 2020,
        "harga" => 97000,
        "stok" => 1
    ],
    [
        "kode" => "BK010",
        "judul" => "Prinsip UI/UX untuk Aplikasi Modern",
        "kategori" => "Desain",
        "pengarang" => "Nadya Putri",
        "penerbit" => "Creative Tech Publisher",
        "tahun" => 2022,
        "harga" => 80000,
        "stok" => 5
    ],
];

// PARAMETER GET 
$keyword   = sanitize_input($_GET['keyword'] ?? '');
$kategori  = sanitize_input($_GET['kategori'] ?? '');
$min_harga = sanitize_input($_GET['min_harga'] ?? '');
$max_harga = sanitize_input($_GET['max_harga'] ?? '');
$tahun     = sanitize_input($_GET['tahun'] ?? '');
$status    = sanitize_input($_GET['status'] ?? 'semua');
$sort      = sanitize_input($_GET['sort'] ?? 'judul');
$page      = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// SISTEM VALIDASI
$errors = [];

if ($min_harga !== '' && $max_harga !== '' && (int)$min_harga > (int)$max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum.";
}

if ($tahun !== '') {
    $tahun_now = (int)date('Y');
    if ((int)$tahun < 1900 || (int)$tahun > $tahun_now) {
        $errors[] = "Tahun harus valid antara 1900 sampai " . $tahun_now . ".";
    }
}

// SISTEM FILTER
$hasil_filter = array_filter($buku_list, function ($buku) use ($keyword, $kategori, $min_harga, $max_harga, $tahun, $status) {
    if ($keyword !== '') {
        $cocok_keyword = stripos($buku['judul'], $keyword) !== false || stripos($buku['pengarang'], $keyword) !== false;
        if (!$cocok_keyword) {
            return false;
        }
    }

    if ($kategori !== '' && $buku['kategori'] !== $kategori) {
        return false;
    }

    if ($min_harga !== '' && (int)$buku['harga'] < (int)$min_harga) {
        return false;
    }

    if ($max_harga !== '' && (int)$buku['harga'] > (int)$max_harga) {
        return false;
    }

    if ($tahun !== '' && (int)$buku['tahun'] !== (int)$tahun) {
        return false;
    }

    if ($status === 'tersedia' && (int)$buku['stok'] <= 0) {
        return false;
    }

    if ($status === 'habis' && (int)$buku['stok'] > 0) {
        return false;
    }

    return true;
});

// MULAI SORTING 
$sort_allowed = ['judul', 'harga', 'tahun'];
if (!in_array($sort, $sort_allowed, true)) {
    $sort = 'judul';
}

usort($hasil_filter, function ($a, $b) use ($sort) {
    if ($sort === 'judul') {
        return strcasecmp($a['judul'], $b['judul']);
    }

    if ($sort === 'harga' || $sort === 'tahun') {
        return $a[$sort] <=> $b[$sort];
    }

    return 0;
});

// PENCARIAN 
if (!empty($_GET)) {
    $search_snapshot = [
        'keyword' => $keyword,
        'kategori' => $kategori,
        'min_harga' => $min_harga,
        'max_harga' => $max_harga,
        'tahun' => $tahun,
        'status' => $status,
        'sort' => $sort
    ];

    if (!isset($_SESSION['recent_searches'])) {
        $_SESSION['recent_searches'] = [];
    }

    array_unshift($_SESSION['recent_searches'], $search_snapshot);
    $_SESSION['recent_searches'] = array_slice($_SESSION['recent_searches'], 0, 5);
}

// EXPORT CSV 
if (isset($_GET['export']) && $_GET['export'] === 'csv' && empty($errors)) {
    if (ob_get_level()) ob_end_clean();

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=data_buku.csv');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');

    $output = fopen('php://output', 'w');

    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    fputcsv($output, ['Kode', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun', 'Harga', 'Stok']);

    foreach ($hasil_filter as $buku) {
        fputcsv($output, [
            $buku['kode'],
            $buku['judul'],
            $buku['kategori'],
            $buku['pengarang'],
            $buku['penerbit'],
            $buku['tahun'],
            $buku['harga'],
            $buku['stok']
        ]);
    }

    fclose($output);
    exit;
}

// PAGINATION 
$per_page = 10;
$total_hasil = count($hasil_filter);
$total_page = (int)ceil($total_hasil / $per_page);
$page = $total_page > 0 ? min($page, $total_page) : 1;
$start = ($page - 1) * $per_page;
$hasil_tampil = array_slice($hasil_filter, $start, $per_page);

function build_query(array $override = []): string {
    $params = array_merge($_GET, $override);
    if (!array_key_exists('export', $override)) {
        unset($params['export']);
    }
    return http_build_query($params);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencarian Buku Lanjutan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="card shadow-lg border-0 rounded-4 mb-4">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">🔍 Pencarian Buku Lanjutan</h4>
                        <small>Gunakan filter untuk menemukan buku dengan lebih cepat</small>
                    </div>

                    <div class="card-body p-4">

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                                    
                        <form method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Keyword (judul / pengarang)</label>
                                    <input type="text" name="keyword" class="form-control" value="<?= $keyword ?>" placeholder="Cari judul atau pengarang">
                                </div>
                                    
                                <div class="col-md-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="kategori" class="form-select">
                                        <option value="">Semua Kategori</option>
                                        <option value="Pemrograman" <?= $kategori === 'Pemrograman' ? 'selected' : '' ?>>Pemrograman</option>
                                        <option value="Database" <?= $kategori === 'Database' ? 'selected' : '' ?>>Database</option>
                                        <option value="Networking" <?= $kategori === 'Networking' ? 'selected' : '' ?>>Networking</option>
                                        <option value="AI" <?= $kategori === 'AI' ? 'selected' : '' ?>>AI</option>
                                        <option value="Desain" <?= $kategori === 'Desain' ? 'selected' : '' ?>>Desain</option>
                                    </select>
                                </div>
                                    
                                <div class="col-md-2">
                                    <label class="form-label">Min Harga</label>
                                    <input type="number" name="min_harga" class="form-control" value="<?= $min_harga ?>" placeholder="0">
                                </div>
                                    
                                <div class="col-md-2">
                                    <label class="form-label">Max Harga</label>
                                    <input type="number" name="max_harga" class="form-control" value="<?= $max_harga ?>" placeholder="0">
                                </div>
                                    
                                <div class="col-md-1">
                                    <label class="form-label">Tahun</label>
                                    <input type="number" name="tahun" class="form-control" value="<?= $tahun ?>" placeholder="2024">
                                </div>
                                    
                                <div class="col-md-4">
                                    <label class="form-label">Status Ketersediaan</label>
                                    <div class="d-flex flex-wrap gap-3 pt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="statusSemua" value="semua" <?= $status === 'semua' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="statusSemua">Semua</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="statusTersedia" value="tersedia" <?= $status === 'tersedia' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="statusTersedia">Tersedia</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="statusHabis" value="habis" <?= $status === 'habis' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="statusHabis">Habis</label>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-md-3">
                                    <label class="form-label">Sorting</label>
                                    <select name="sort" class="form-select">
                                        <option value="judul" <?= $sort === 'judul' ? 'selected' : '' ?>>Judul</option>
                                        <option value="harga" <?= $sort === 'harga' ? 'selected' : '' ?>>Harga</option>
                                        <option value="tahun" <?= $sort === 'tahun' ? 'selected' : '' ?>>Tahun</option>
                                    </select>
                                </div>
                                    
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary px-4">Cari</button>
                                        <a href="search_advanced.php" class="btn btn-outline-secondary px-4">Reset</a>
                                        <a href="?<?= htmlspecialchars(build_query(['export' => 'csv'])) ?>" class="btn btn-success px-4">Export CSV</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                                    
                <?php if (!empty($_GET)): ?>
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="mb-1">Hasil Pencarian</h5>
                                <div class="text-muted">Ditemukan <?= $total_hasil ?> buku</div>
                            </div>
                            <div class="text-muted">
                                Halaman <?= $total_page > 0 ? $page : 0 ?> dari <?= $total_page ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                
                        <?php if ($total_hasil > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($hasil_tampil as $buku): ?>
                                            <tr>
                                                <td><?= $buku['kode'] ?></td>
                                                <td><?= highlight_keyword($buku['judul'], $keyword) ?></td>
                                                <td><?= $buku['kategori'] ?></td>
                                                <td><?= highlight_keyword($buku['pengarang'], $keyword) ?></td>
                                                <td><?= $buku['penerbit'] ?></td>
                                                <td><?= $buku['tahun'] ?></td>
                                                <td>Rp <?= number_format($buku['harga'], 0, ',', '.') ?></td>
                                                <td>
                                                    <?php if ($buku['stok'] > 0): ?>
                                                        <span class="badge bg-success"><?= $buku['stok'] ?> tersedia</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Habis</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                                                    
                            <?php if ($total_page > 1): ?>
                                <nav class="mt-4">
                                    <ul class="pagination mb-0">
                                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?<?= htmlspecialchars(build_query(['page' => $page - 1])) ?>">Sebelumnya</a>
                                        </li>
                            
                                        <?php for ($i = 1; $i <= $total_page; $i++): ?>
                                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?<?= htmlspecialchars(build_query(['page' => $i])) ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        
                                        <li class="page-item <?= $page >= $total_page ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?<?= htmlspecialchars(build_query(['page' => $page + 1])) ?>">Berikutnya</a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                                        
                        <?php else: ?>
                            <div class="text-center py-5">
                                <h5 class="text-muted mb-2">Tidak ada hasil ditemukan</h5>
                                <p class="text-muted mb-0">Coba ubah keyword, kategori, harga, atau status pencarian.</p>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                        
                <?php if (!empty($_SESSION['recent_searches'])): ?>
                    <div class="card shadow-sm border-0 rounded-4 mt-4">
                        <div class="card-header bg-white">
                            <strong>Pencarian Terakhir</strong>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <?php foreach ($_SESSION['recent_searches'] as $recent): ?>
                                    <a class="list-group-item list-group-item-action"
                                       href="?<?= htmlspecialchars(http_build_query($recent)) ?>">
                                        Keyword: <?= $recent['keyword'] !== '' ? $recent['keyword'] : '-' ?>,
                                        Kategori: <?= $recent['kategori'] !== '' ? $recent['kategori'] : 'Semua' ?>,
                                        Status: <?= $recent['status'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                                
            </div>
        </div>
    </div>

</body>
</html>