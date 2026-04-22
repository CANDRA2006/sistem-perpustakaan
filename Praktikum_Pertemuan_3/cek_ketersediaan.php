<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ketersediaan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-search"></i> Cek Ketersediaan Buku</h1>
        
        <?php
        // Data buku 1
        $judul1 = "Pemrograman PHP untuk Pemula";
        $stok1 = 8;
        $harga1 = 75000;
        
        // Data buku 2
        $judul2 = "Mastering MySQL Database";
        $stok2 = 10;
        $harga2 = 95000;
        
        // Data buku 3
        $judul3 = "Laravel Framework Advanced";
        $stok3 = 5;
        $harga3 = 125000;
        ?>
        
        <!-- Buku 1 -->
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul1; ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Harga:</strong> Rp <?php echo number_format($harga1, 0, ',', '.'); ?></p>
                        <p><strong>Stok:</strong> <?php echo $stok1; ?> buku</p>
                        
                        <?php
                        // Logika ketersediaan
                        if ($stok1 > 0) {
                            $status1 = "Tersedia";
                            $badge1 = "success";
                            $icon1 = "check-circle";
                            $pesan1 = "Buku dapat dipinjam";
                        } else {
                            $status1 = "Tidak Tersedia";
                            $badge1 = "danger";
                            $icon1 = "x-circle";
                            $pesan1 = "Mohon maaf, buku sedang dipinjam semua ";
                        }
                        ?>
                        
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge bg-<?php echo $badge1; ?>">
                                <i class="bi bi-<?php echo $icon1; ?>"></i> <?php echo $status1; ?>
                            </span>
                        </p>
                        <p class="text-muted"><em><?php echo $pesan1; ?></em></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <?php if ($stok1 > 0): ?>
                            <button class="btn btn-success">
                                <i class="bi bi-cart-plus"></i> Pinjam
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>
                                <i class="bi bi-lock"></i> Tidak Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Buku 2 -->
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul2; ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Harga:</strong> Rp <?php echo number_format($harga2, 0, ',', '.'); ?></p>
                        <p><strong>Stok:</strong> <?php echo $stok2; ?> buku</p>
                        
                        <?php
                        if ($stok2 > 0) {
                            $status2 = "Tersedia";
                            $badge2 = "success";
                            $icon2 = "check-circle";
                            $pesan2 = "Buku dapat dipinjam";
                        } else {
                            $status2 = "Tidak Tersedia";
                            $badge2 = "danger";
                            $icon2 = "x-circle";
                            $pesan2 = "Mohon maaf, buku sedang dipinjam semua";
                        }
                        ?>
                        
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge bg-<?php echo $badge2; ?>">
                                <i class="bi bi-<?php echo $icon2; ?>"></i> <?php echo $status2; ?>
                            </span>
                        </p>
                        <p class="text-muted"><em><?php echo $pesan2; ?></em></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <?php if ($stok2 > 0): ?>
                            <button class="btn btn-success">
                                <i class="bi bi-cart-plus"></i> Pinjam
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>
                                <i class="bi bi-lock"></i> Tidak Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Buku 3 dengan logika stok menipis -->
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul3; ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Harga:</strong> Rp <?php echo number_format($harga3, 0, ',', '.'); ?></p>
                        <p><strong>Stok:</strong> <?php echo $stok3; ?> buku</p>
                        
                        <?php
                        // Logika lebih detail
                        if ($stok3 == 0) {
                            $status3 = "Tidak Tersedia";
                            $badge3 = "danger";
                            $icon3 = "x-circle";
                            $pesan3 = "Buku sedang dipinjam semua";
                        } elseif ($stok3 < 3) {
                            $status3 = "Stok Menipis";
                            $badge3 = "warning";
                            $icon3 = "exclamation-triangle";
                            $pesan3 = "Segera pinjam, hanya tersisa $stok3 buku";
                        } elseif ($stok3 < 10) {
                            $status3 = "Tersedia";
                            $badge3 = "info";
                            $icon3 = "info-circle";
                            $pesan3 = "Stok terbatas, tersedia $stok3 buku";
                        } else {
                            $status3 = "Tersedia";
                            $badge3 = "success";
                            $icon3 = "check-circle";
                            $pesan3 = "Stok buku mencukupi";
                        }
                        ?>
                        
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge bg-<?php echo $badge3; ?>">
                                <i class="bi bi-<?php echo $icon3; ?>"></i> <?php echo $status3; ?>
                            </span>
                        </p>
                        <p class="text-muted"><em><?php echo $pesan3; ?></em></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <?php if ($stok3 > 0): ?>
                            <button class="btn btn-success">
                                <i class="bi bi-cart-plus"></i> Pinjam
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>
                                <i class="bi bi-lock"></i> Tidak Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>