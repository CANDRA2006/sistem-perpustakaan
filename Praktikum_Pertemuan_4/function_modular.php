<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Modular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-puzzle"></i> Modularisasi dengan Include & Require</h1>
        
        <?php
        // Include file functions dan data
        require_once 'functions.php';
        require_once 'data.php';
        ?>
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> <strong>Info:</strong> Halaman ini menggunakan function dari file <code>functions.php</code> dan data dari file <code>data.php</code>
        </div>
        
        <!-- Laporan Statistik -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Laporan Statistik Perpustakaan</h5>
            </div>
            <div class="card-body">
                <?php
                $laporan = generate_laporan($buku_list);
                ?>
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Judul</h6>
                                <h2 class="text-primary"><?php echo $laporan["total_judul"]; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Stok</h6>
                                <h2 class="text-success"><?php echo $laporan["total_stok"]; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-info">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Nilai</h6>
                                <h3 class="text-info"><?php echo format_rupiah($laporan["total_nilai"]); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Rata-rata Harga</h6>
                                <h3 class="text-warning"><?php echo format_rupiah($laporan["rata_rata_harga"]); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Buku Termahal</h6>
                                <p class="mb-1"><strong><?php echo $laporan["buku_termahal"]["judul"]; ?></strong></p>
                                <p class="mb-0 text-danger">
                                    <strong><?php echo format_rupiah($laporan["buku_termahal"]["harga"]); ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Buku Termurah</h6>
                                <p class="mb-1"><strong><?php echo $laporan["buku_termurah"]["judul"]; ?></strong></p>
                                <p class="mb-0 text-success">
                                    <strong><?php echo format_rupiah($laporan["buku_termurah"]["harga"]); ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3 mb-0">
                    <strong>Persentase Ketersediaan:</strong> 
                    <?php echo number_format($laporan["persentase_tersedia"], 1); ?>% buku tersedia
                </div>
            </div>
        </div>
        
        <!-- Statistik by Kategori -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Statistik by Kategori</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $kategori_list = ["Programming", "Database", "Web Design", "Networking"];
                    foreach ($kategori_list as $kategori):
                        $jumlah = hitung_by_kategori($buku_list, $kategori);
                    ?>
                    <div class="col-md-3 mb-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6><?php echo $kategori; ?></h6>
                                <h3 class="text-primary"><?php echo $jumlah; ?></h3>
                                <small class="text-muted">judul</small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Filter Stok Minimum -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Buku dengan Stok ≥ 10</h5>
            </div>
            <div class="card-body">
                <?php
                $buku_stok_aman = filter_stok_minimum($buku_list, 10);
                ?>
                <p>Ditemukan <strong><?php echo count($buku_stok_aman); ?></strong> buku dengan stok aman</p>
                <ul>
                    <?php foreach ($buku_stok_aman as $buku): ?>
                        <li>
                            <?php echo $buku["judul"]; ?> - 
                            <span class="badge bg-success">Stok: <?php echo $buku["stok"]; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <!-- Sort by Harga -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Buku Terurut by Harga (Termurah - Termahal)</h5>
            </div>
            <div class="card-body">
                <?php
                $buku_sorted = sort_by_harga($buku_list, true);
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($buku_sorted as $buku): 
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $buku["judul"]; ?></td>
                            <td><span class="badge bg-primary"><?php echo $buku["kategori"]; ?></span></td>
                            <td><?php echo format_rupiah($buku["harga"]); ?></td>
                            <td><?php echo $buku["stok"]; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>