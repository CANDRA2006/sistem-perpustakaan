<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Harga - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Harga Buku</h1>
        
        <?php
        // Data buku
        $judul_buku = "Mastering Laravel Framework";
        $harga_satuan = 95000;
        $jumlah_beli = 3;
        
        // Perhitungan
        $subtotal = $harga_satuan * $jumlah_beli;
        
        // Diskon berdasarkan jumlah
        if ($jumlah_beli >= 3) {
            $persentase_diskon = 10; // 10%
        } else {
            $persentase_diskon = 0;
        }
        
        $diskon = $subtotal * ($persentase_diskon / 100);
        $total_setelah_diskon = $subtotal - $diskon;
        
        // PPN 11%
        $ppn = $total_setelah_diskon * 0.11;
        
        // Total akhir
        $total_akhir = $total_setelah_diskon + $ppn;
        ?>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>                           
                                <th width="250">Judul Buku</th>
                                <td>: <?php echo $judul_buku; ?></td>
                            </tr>
                            <tr>
                                <th>Harga Satuan</th>
                                <td>: Rp <?php echo number_format($harga_satuan, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Beli</th>
                                <td>: <?php echo $jumlah_beli; ?> buku</td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Subtotal</th>
                                <td>: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="text-success">
                                <th>Diskon (<?php echo $persentase_diskon; ?>%)</th>
                                <td>: - Rp <?php echo number_format($diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Total Setelah Diskon</th>
                                <td>: Rp <?php echo number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>PPN 11%</th>
                                <td>: + Rp <?php echo number_format($ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-primary fw-bold">
                                <th>TOTAL AKHIR</th>
                                <td>: Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></td>
                            </tr>
                        </table>
                        
                        <?php if ($persentase_diskon > 0): ?>
                        <div class="alert alert-success">
                            <strong>Selamat!</strong> Anda mendapat diskon <?php echo $persentase_diskon; ?>% 
                            karena membeli <?php echo $jumlah_beli; ?> buku atau lebih.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Informasi Diskon</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 3+ buku: Diskon 10%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 5+ buku: Diskon 15%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-info-circle text-info"></i>
                                Semua harga sudah termasuk PPN
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card border-warning mt-3">
                    <div class="card-header bg-warning">
                        <h6 class="mb-0">Hemat Anda</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="text-success">
                            Rp <?php echo number_format($diskon, 0, ',', '.'); ?>
                        </h4>
                        <small class="text-muted">
                            dari harga normal Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contoh perhitungan lain -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Contoh Perhitungan Lainnya</h5>
            </div>
            <div class="card-body">
                <?php
                // Contoh 1: Menghitung total stok
                $stok_gudang_a = 45;
                $stok_gudang_b = 32;
                $stok_gudang_c = 18;
                $total_stok = $stok_gudang_a + $stok_gudang_b + $stok_gudang_c;
                ?>
                <h6>1. Total Stok dari 3 Gudang:</h6>
                <p>
                    Gudang A: <?php echo $stok_gudang_a; ?> + 
                    Gudang B: <?php echo $stok_gudang_b; ?> + 
                    Gudang C: <?php echo $stok_gudang_c; ?> = 
                    <strong><?php echo $total_stok; ?> buku</strong>
                </p>
                
                <?php
                // Contoh 2: Menghitung rata-rata harga
                $harga1 = 50000;
                $harga2 = 75000;
                $harga3 = 95000;
                $rata_rata = ($harga1 + $harga2 + $harga3) / 3;
                ?>
                <h6>2. Rata-rata Harga Buku:</h6>
                <p>
                    (Rp <?php echo number_format($harga1, 0, ',', '.'); ?> + 
                    Rp <?php echo number_format($harga2, 0, ',', '.'); ?> + 
                    Rp <?php echo number_format($harga3, 0, ',', '.'); ?>) / 3 = 
                    <strong>Rp <?php echo number_format($rata_rata, 0, ',', '.'); ?></strong>
                </p>
                
                <?php
                // Contoh 3: Menghitung persentase
                $buku_dipinjam = 78;
                $total_buku = 500;
                $persentase = ($buku_dipinjam / $total_buku) * 100;
                ?>
                <h6>3. Persentase Buku Dipinjam:</h6>
                <p>
                    (<?php echo $buku_dipinjam; ?> / <?php echo $total_buku; ?>) × 100 = 
                    <strong><?php echo number_format($persentase, 2); ?>%</strong>
                </p>
                
                <?php
                // Contoh 4: Pembulatan
                $harga_diskon = 87543.75;
                ?>
                <h6>4. Pembulatan Harga:</h6>
                <p>
                    Harga asli: Rp <?php echo number_format($harga_diskon, 2, ',', '.'); ?><br />
                    Pembulatan ke atas: Rp <?php echo number_format(ceil($harga_diskon), 0, ',', '.'); ?><br />
                    Pembulatan ke bawah: Rp <?php echo number_format(floor($harga_diskon), 0, ',', '.'); ?><br />
                    Pembulatan normal: Rp <?php echo number_format(round($harga_diskon), 0, ',', '.'); ?>
                </p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>