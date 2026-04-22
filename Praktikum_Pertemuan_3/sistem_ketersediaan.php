<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Ketersediaan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book"></i> Sistem Perpustakaan
            </a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h1 class="mb-4"><i class="bi bi-search"></i> Sistem Cek Ketersediaan Buku</h1>
        
        <?php
        // Data Buku dalam Array
        $buku_list = [
            [
                "kode" => "BK-001",
                "judul" => "Pemrograman PHP untuk Pemula",
                "kategori" => "Programming",
                "pengarang" => "Budi Raharjo",
                "tahun" => 2023,
                "harga" => 75000,
                "stok" => 8
            ],
            [
                "kode" => "BK-002",
                "judul" => "Mastering MySQL Database",
                "kategori" => "Database",
                "pengarang" => "Andi Nugroho",
                "tahun" => 2022,
                "harga" => 95000,
                "stok" => 0
            ],
            [
                "kode" => "BK-003",
                "judul" => "Laravel Framework Advanced",
                "kategori" => "Programming",
                "pengarang" => "Siti Aminah",
                "tahun" => 2024,
                "harga" => 125000,
                "stok" => 2
            ],
            [
                "kode" => "BK-004",
                "judul" => "Web Design Principles",
                "kategori" => "Web Design",
                "pengarang" => "Dedi Santoso",
                "tahun" => 2023,
                "harga" => 85000,
                "stok" => 15
            ],
            [
                "kode" => "BK-005",
                "judul" => "Network Security Fundamentals",
                "kategori" => "Networking",
                "pengarang" => "Rina Wijaya",
                "tahun" => 2023,
                "harga" => 110000,
                "stok" => 5
            ]
        ];
        
        // Hitung statistik
        $total_buku = count($buku_list);
        $total_stok = 0;
        $buku_tersedia = 0;
        $buku_habis = 0;
        
        foreach ($buku_list as $buku) {
            $total_stok += $buku["stok"];
            if ($buku["stok"] > 0) {
                $buku_tersedia++;
            } else {
                $buku_habis++;
            }
        }
        ?>
        
        <!-- Dashboard Statistik -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <h3 class="text-primary"><?php echo $total_buku; ?></h3>
                        <p class="mb-0">Total Judul Buku</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h3 class="text-success"><?php echo $buku_tersedia; ?></h3>
                        <p class="mb-0">Buku Tersedia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h3 class="text-danger"><?php echo $buku_habis; ?></h3>
                        <p class="mb-0">Buku Habis</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h3 class="text-info"><?php echo $total_stok; ?></h3>
                        <p class="mb-0">Total Eksemplar</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filter Kategori -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Filter Berdasarkan Kategori</h5>
            </div>
            <div class="card-body">
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-primary active">Semua</button>
                    <button class="btn btn-outline-primary">Programming</button>
                    <button class="btn btn-outline-success">Database</button>
                    <button class="btn btn-outline-info">Web Design</button>
                    <button class="btn btn-outline-warning">Networking</button>
                </div>
                <p class="text-muted mt-2 mb-0">
                    <small><em>Note: Filter akan diimplementasikan dengan JavaScript (tidak termasuk scope pertemuan ini)</em></small>
                </p>
            </div>
        </div>
        
        <!-- Daftar Buku -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Buku Perpustakaan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th width="100">Kode</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th width="80">Tahun</th>
                                <th width="120">Harga</th>
                                <th width="80">Stok</th>
                                <th width="150">Status</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($buku_list as $buku) {
                                // Tentukan warna kategori dengan switch
                                switch ($buku["kategori"]) {
                                    case "Programming":
                                        $warna_kategori = "primary";
                                        $icon_kategori = "code-slash";
                                        break;
                                    case "Database":
                                        $warna_kategori = "success";
                                        $icon_kategori = "database";
                                        break;
                                    case "Web Design":
                                        $warna_kategori = "info";
                                        $icon_kategori = "palette";
                                        break;
                                    case "Networking":
                                        $warna_kategori = "warning";
                                        $icon_kategori = "wifi";
                                        break;
                                    default:
                                        $warna_kategori = "secondary";
                                        $icon_kategori = "book";
                                }
                                
                                // Tentukan status dengan if-elseif-else
                                if ($buku["stok"] == 0) {
                                    $status = "Habis";
                                    $warna_status = "danger";
                                    $icon_status = "x-circle";
                                    $dapat_pinjam = false;
                                } elseif ($buku["stok"] < 3) {
                                    $status = "Stok Menipis";
                                    $warna_status = "warning";
                                    $icon_status = "exclamation-triangle";
                                    $dapat_pinjam = true;
                                } elseif ($buku["stok"] < 10) {
                                    $status = "Tersedia";
                                    $warna_status = "info";
                                    $icon_status = "info-circle";
                                    $dapat_pinjam = true;
                                } else {
                                    $status = "Stok Aman";
                                    $warna_status = "success";
                                    $icon_status = "check-circle";
                                    $dapat_pinjam = true;
                                }
                                
                                // Cek tahun untuk menandai buku baru
                                $tahun_sekarang = date("Y");
                                $is_buku_baru = ($buku["tahun"] >= ($tahun_sekarang - 1));
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $buku["kode"]; ?></code></td>
                                <td>
                                    <strong><?php echo $buku["judul"]; ?></strong>
                                    <?php if ($is_buku_baru): ?>
                                        <span class="badge bg-danger ms-1">NEW</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $warna_kategori; ?>">
                                        <i class="bi bi-<?php echo $icon_kategori; ?>"></i>
                                        <?php echo $buku["kategori"]; ?>
                                    </span>
                                </td>
                                <td><?php echo $buku["pengarang"]; ?></td>
                                <td><?php echo $buku["tahun"]; ?></td>
                                <td>Rp <?php echo number_format($buku["harga"], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <strong><?php echo $buku["stok"]; ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $warna_status; ?>">
                                        <i class="bi bi-<?php echo $icon_status; ?>"></i>
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($dapat_pinjam): ?>
                                        <button class="btn btn-sm btn-success">
                                            <i class="bi bi-cart-plus"></i> Pinjam
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            <i class="bi bi-lock"></i> Habis
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Analisis Detail -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Analisis Stok</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Kategorikan buku berdasarkan stok
                        $stok_aman = 0;
                        $stok_menipis = 0;
                        $stok_habis = 0;
                        
                        foreach ($buku_list as $buku) {
                            if ($buku["stok"] == 0) {
                                $stok_habis++;
                            } elseif ($buku["stok"] < 5) {
                                $stok_menipis++;
                            } else {
                                $stok_aman++;
                            }
                        }
                        
                        $persentase_aman = ($stok_aman / $total_buku) * 100;
                        $persentase_menipis = ($stok_menipis / $total_buku) * 100;
                        $persentase_habis = ($stok_habis / $total_buku) * 100;
                        ?>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Stok Aman (≥5)</span>
                                <span><strong><?php echo $stok_aman; ?> judul</strong></span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: <?php echo $persentase_aman; ?>%">
                                    <?php echo number_format($persentase_aman, 1); ?>%
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Stok Menipis (1-4)</span>
                                <span><strong><?php echo $stok_menipis; ?> judul</strong></span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: <?php echo $persentase_menipis; ?>%">
                                    <?php echo number_format($persentase_menipis, 1); ?>%
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-0">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Stok Habis (0)</span>
                                <span><strong><?php echo $stok_habis; ?> judul</strong></span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: <?php echo $persentase_habis; ?>%">
                                    <?php echo number_format($persentase_habis, 1); ?>%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Rekomendasi Restocking</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Buku yang perlu restocking:</strong></p>
                        <ul class="list-group">
                            <?php
                            $perlu_restock = false;
                            foreach ($buku_list as $buku) {
                                if ($buku["stok"] < 5) {
                                    $perlu_restock = true;
                                    $jumlah_order = 10 - $buku["stok"]; // Target stok 10
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo $buku["judul"]; ?></strong><br />
                                    <small class="text-muted">
                                        Stok: <?php echo $buku["stok"]; ?> | 
                                        Kode: <?php echo $buku["kode"]; ?>
                                    </small>
                                </div>
                                <span class="badge bg-warning rounded-pill">
                                    Order: <?php echo $jumlah_order; ?> buku
                                </span>
                            </li>
                            <?php
                                }
                            }
                            
                            if (!$perlu_restock) {
                                echo '<li class="list-group-item text-center text-success">';
                                echo '<i class="bi bi-check-circle"></i> Semua stok aman, tidak perlu restocking';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Sistem Perpustakaan</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>