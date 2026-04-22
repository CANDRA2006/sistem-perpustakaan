<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <?php
    // Include functions dan data
    require_once 'functions.php';
    require_once 'data.php';
    ?>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book"></i> Library Management System
            </a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Dashboard Perpustakaan</h2>
                <p class="text-muted">Sistem manajemen buku menggunakan Array & Function PHP</p>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <?php $laporan = generate_laporan($buku_list); ?>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <i class="bi bi-book text-primary" style="font-size: 2rem;"></i>
                        <h4 class="mt-2"><?php echo $laporan["total_judul"]; ?></h4>
                        <p class="text-muted mb-0">Total Judul</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <i class="bi bi-stack text-success" style="font-size: 2rem;"></i>
                        <h4 class="mt-2"><?php echo $laporan["total_stok"]; ?></h4>
                        <p class="text-muted mb-0">Total Stok</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <i class="bi bi-cash text-info" style="font-size: 2rem;"></i>
                        <h5 class="mt-2"><?php echo format_rupiah($laporan["total_nilai"]); ?></h5>
                        <p class="text-muted mb-0">Total Nilai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-percent text-warning" style="font-size: 2rem;"></i>
                        <h4 class="mt-2"><?php echo number_format($laporan["persentase_tersedia"], 1); ?>%</h4>
                        <p class="text-muted mb-0">Tersedia</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Daftar Buku -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-table"></i> Daftar Buku Perpustakaan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Tahun</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($buku_list as $buku): 
                                // Status badge
                                if ($buku["stok"] == 0) {
                                    $status = '<span class="badge bg-danger">Habis</span>';
                                } elseif ($buku["stok"] < 5) {
                                    $status = '<span class="badge bg-warning">Menipis</span>';
                                } else {
                                    $status = '<span class="badge bg-success">Tersedia</span>';
                                }
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $buku["kode"]; ?></code></td>
                                <td><?php echo $buku["judul"]; ?></td>
                                <td><span class="badge bg-primary"><?php echo $buku["kategori"]; ?></span></td>
                                <td><?php echo $buku["pengarang"]; ?></td>
                                <td><?php echo $buku["tahun"]; ?></td>
                                <td><?php echo format_rupiah($buku["harga"]); ?></td>
                                <td class="text-center"><?php echo $buku["stok"]; ?></td>
                                <td><?php echo $status; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Analysis Section -->
        <div class="row">
            <!-- Top 3 Termahal -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="bi bi-graph-up-arrow"></i> Top 3 Buku Termahal</h6>
                    </div>
                    <div class="card-body">
                        <?php
                        $sorted_desc = sort_by_harga($buku_list, false);
                        $top3 = array_slice($sorted_desc, 0, 3);
                        ?>
                        <ol>
                            <?php foreach ($top3 as $buku): ?>
                                <li>
                                    <strong><?php echo $buku["judul"]; ?></strong><br />
                                    <small class="text-muted"><?php echo $buku["pengarang"]; ?></small><br />
                                    <span class="badge bg-danger"><?php echo format_rupiah($buku["harga"]); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </div>
            
            <!-- Buku Perlu Restocking -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h6 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Perlu Restocking (Stok < 5)</h6>
                    </div>
                    <div class="card-body">
                        <?php
                        $perlu_restock = [];
                        foreach ($buku_list as $buku) {
                            if ($buku["stok"] < 5) {
                                $perlu_restock[] = $buku;
                            }
                        }
                        ?>
                        <?php if (count($perlu_restock) > 0): ?>
                        <ul class="list-group">
                            <?php foreach ($perlu_restock as $buku): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?php echo $buku["judul"]; ?></strong><br />
                                        <small class="text-muted"><?php echo $buku["kode"]; ?></small>
                                    </div>
                                    <span class="badge bg-warning">Stok: <?php echo $buku["stok"]; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <div class="alert alert-success mb-0">
                            <i class="bi bi-check-circle"></i> Semua buku stok aman
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Category Distribution -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Distribusi Kategori Buku</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $kategori_list = ["Programming", "Database", "Web Design", "Networking"];
                    foreach ($kategori_list as $kategori):
                        $jumlah = hitung_by_kategori($buku_list, $kategori);
                        $persentase = ($jumlah / count($buku_list)) * 100;
                    ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $kategori; ?></h6>
                                <h3 class="text-primary"><?php echo $jumlah; ?></h3>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?php echo $persentase; ?>%" 
                                         aria-valuenow="<?php echo $persentase; ?>" 
                                         aria-valuemin="0" aria-valuemax="100">
                                        <?php echo number_format($persentase, 1); ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2024 Library Management System - Powered by PHP Array & Functions</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>