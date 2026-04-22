<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-search"></i> Pencarian Buku Perpustakaan</h1>
        
        <?php
        // Data buku (dalam praktik nyata, ini dari database)
        $buku_list = [
            [
                "kode" => "BK-001",
                "judul" => "Pemrograman PHP untuk Pemula",
                "kategori" => "Programming",
                "pengarang" => "Budi Raharjo",
                "penerbit" => "Informatika",
                "tahun" => 2023,
                "harga" => 75000,
                "stok" => 10
            ],
            [
                "kode" => "BK-002",
                "judul" => "Mastering MySQL Database",
                "kategori" => "Database",
                "pengarang" => "Andi Nugroho",
                "penerbit" => "Graha Ilmu",
                "tahun" => 2022,
                "harga" => 95000,
                "stok" => 5
            ],
            [
                "kode" => "BK-003",
                "judul" => "Laravel Framework Advanced",
                "kategori" => "Programming",
                "pengarang" => "Siti Aminah",
                "penerbit" => "Informatika",
                "tahun" => 2024,
                "harga" => 125000,
                "stok" => 8
            ],
            [
                "kode" => "BK-004",
                "judul" => "Web Design Principles",
                "kategori" => "Web Design",
                "pengarang" => "Dedi Santoso",
                "penerbit" => "Andi",
                "tahun" => 2023,
                "harga" => 85000,
                "stok" => 15
            ],
            [
                "kode" => "BK-005",
                "judul" => "Network Security Fundamentals",
                "kategori" => "Networking",
                "pengarang" => "Rina Wijaya",
                "penerbit" => "Erlangga",
                "tahun" => 2023,
                "harga" => 110000,
                "stok" => 3
            ],
            [
                "kode" => "BK-006",
                "judul" => "PHP Web Services",
                "kategori" => "Programming",
                "pengarang" => "Budi Raharjo",
                "penerbit" => "Informatika",
                "tahun" => 2024,
                "harga" => 90000,
                "stok" => 12
            ],
            [
                "kode" => "BK-007",
                "judul" => "PostgreSQL Advanced",
                "kategori" => "Database",
                "pengarang" => "Ahmad Yani",
                "penerbit" => "Graha Ilmu",
                "tahun" => 2024,
                "harga" => 115000,
                "stok" => 7
            ],
            [
                "kode" => "BK-008",
                "judul" => "JavaScript Modern",
                "kategori" => "Programming",
                "pengarang" => "Siti Aminah",
                "penerbit" => "Informatika",
                "tahun" => 2023,
                "harga" => 80000,
                "stok" => 0
            ]
        ];
        
        // Ambil parameter pencarian dari GET
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
        $min_harga = isset($_GET['min_harga']) ? trim($_GET['min_harga']) : '';
        $max_harga = isset($_GET['max_harga']) ? trim($_GET['max_harga']) : '';
        
        // Sanitasi input
        $keyword = htmlspecialchars($keyword);
        $kategori = htmlspecialchars($kategori);
        
        // Lakukan pencarian jika ada parameter
        $hasil = [];
        $is_search = false;
        
        if (!empty($keyword) || !empty($kategori) || !empty($min_harga) || !empty($max_harga)) {
            $is_search = true;
            
            foreach ($buku_list as $buku) {
                $match = true;
                
                // Filter by keyword (judul atau pengarang)
                if (!empty($keyword)) {
                    if (stripos($buku['judul'], $keyword) === false && 
                        stripos($buku['pengarang'], $keyword) === false) {
                        $match = false;
                    }
                }
                
                // Filter by kategori
                if (!empty($kategori) && $buku['kategori'] != $kategori) {
                    $match = false;
                }
                
                // Filter by harga minimum
                if (!empty($min_harga) && $buku['harga'] < $min_harga) {
                    $match = false;
                }
                
                // Filter by harga maksimum
                if (!empty($max_harga) && $buku['harga'] > $max_harga) {
                    $match = false;
                }
                
                if ($match) {
                    $hasil[] = $buku;
                }
            }
        }
        ?>
        
        <!-- Form Pencarian -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-funnel"></i> Filter Pencarian</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="keyword" class="form-label">Kata Kunci (Judul / Pengarang)</label>
                            <input type="text" class="form-control" id="keyword" name="keyword" 
                                   value="<?php echo $keyword; ?>" 
                                   placeholder="Masukkan kata kunci...">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">-- Semua Kategori --</option>
                                <option value="Programming" <?php echo ($kategori == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                                <option value="Database" <?php echo ($kategori == 'Database') ? 'selected' : ''; ?>>Database</option>
                                <option value="Web Design" <?php echo ($kategori == 'Web Design') ? 'selected' : ''; ?>>Web Design</option>
                                <option value="Networking" <?php echo ($kategori == 'Networking') ? 'selected' : ''; ?>>Networking</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="min_harga" class="form-label">Harga Minimum (Rp)</label>
                            <input type="number" class="form-control" id="min_harga" name="min_harga" 
                                   value="<?php echo $min_harga; ?>" 
                                   min="0" step="10000" 
                                   placeholder="0">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="max_harga" class="form-label">Harga Maksimum (Rp)</label>
                            <input type="number" class="form-control" id="max_harga" name="max_harga" 
                                   value="<?php echo $max_harga; ?>" 
                                   min="0" step="10000" 
                                   placeholder="1000000">
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="search_buku.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Hasil Pencarian -->
        <?php if ($is_search): ?>
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-table"></i> Hasil Pencarian 
                    <span class="badge bg-light text-dark"><?php echo count($hasil); ?> buku</span>
                </h5>
            </div>
            <div class="card-body">
                <?php if (count($hasil) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
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
                            <?php 
                            $no = 1;
                            foreach ($hasil as $buku): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $buku['kode']; ?></code></td>
                                <td>
                                    <strong><?php echo $buku['judul']; ?></strong>
                                    <?php if ($buku['tahun'] >= 2024): ?>
                                        <span class="badge bg-danger">NEW</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge bg-primary"><?php echo $buku['kategori']; ?></span></td>
                                <td><?php echo $buku['pengarang']; ?></td>
                                <td><?php echo $buku['penerbit']; ?></td>
                                <td><?php echo $buku['tahun']; ?></td>
                                <td>Rp <?php echo number_format($buku['harga'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <?php if ($buku['stok'] > 0): ?>
                                        <span class="badge bg-success"><?php echo $buku['stok']; ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Info Parameter Pencarian -->
                <div class="alert alert-info mt-3 mb-0">
                    <strong><i class="bi bi-info-circle"></i> Parameter Pencarian:</strong>
                    <ul class="mb-0">
                        <?php if (!empty($keyword)): ?>
                            <li>Kata kunci: <strong><?php echo $keyword; ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($kategori)): ?>
                            <li>Kategori: <strong><?php echo $kategori; ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($min_harga)): ?>
                            <li>Harga minimal: <strong>Rp <?php echo number_format($min_harga, 0, ',', '.'); ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($max_harga)): ?>
                            <li>Harga maksimal: <strong>Rp <?php echo number_format($max_harga, 0, ',', '.'); ?></strong></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <?php else: ?>
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle"></i> 
                    <strong>Tidak ada buku yang ditemukan</strong> dengan kriteria pencarian tersebut.
                    Silakan coba dengan kriteria lain.
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <?php else: ?>
        <!-- Tampilkan semua buku jika belum search -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-book"></i> Semua Buku Perpustakaan 
                    <span class="badge bg-light text-dark"><?php echo count($buku_list); ?> buku</span>
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Gunakan form di atas untuk mencari buku berdasarkan kriteria tertentu.
                </div>
                
                <div class="row">
                    <?php foreach ($buku_list as $buku): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $buku['judul']; ?></h6>
                                <p class="card-text mb-2">
                                    <small class="text-muted">
                                        <strong><?php echo $buku['pengarang']; ?></strong> | 
                                        <?php echo $buku['penerbit']; ?> (<?php echo $buku['tahun']; ?>)
                                    </small>
                                </p>
                                <p class="mb-2">
                                    <span class="badge bg-primary"><?php echo $buku['kategori']; ?></span>
                                    <?php if ($buku['stok'] > 0): ?>
                                        <span class="badge bg-success">Tersedia</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </p>
                                <p class="mb-0">
                                    <strong>Harga:</strong> Rp <?php echo number_format($buku['harga'], 0, ',', '.'); ?><br />
                                    <strong>Stok:</strong> <?php echo $buku['stok']; ?> buku
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>