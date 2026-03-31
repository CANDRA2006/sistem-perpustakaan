<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-book"></i> Daftar Buku Perpustakaan</h1>
        
        <!-- FOR Loop -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Metode 1: Menggunakan FOR Loop</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Simulasi data dengan FOR loop
                        for ($i = 1; $i <= 10; $i++) {
                            // Generate data dinamis
                            $kode = "BK-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                            $judul = "Buku Pemrograman Vol. $i";
                            $stok = rand(0, 15); // Random stok 0-15
                            
                            // Tentukan status berdasarkan stok
                            if ($stok == 0) {
                                $status = "Habis";
                                $badge = "danger";
                            } elseif ($stok < 5) {
                                $status = "Menipis";
                                $badge = "warning";
                            } else {
                                $status = "Tersedia";
                                $badge = "success";
                            }
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><code><?php echo $kode; ?></code></td>
                            <td><?php echo $judul; ?></td>
                            <td><?php echo $stok; ?></td>
                            <td>
                                <span class="badge bg-<?php echo $badge; ?>">
                                    <?php echo $status; ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!--WHILE Loop -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Metode 2: Menggunakan WHILE Loop</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $counter = 1;
                    while ($counter <= 6) {
                        $judul = "Buku Teknologi #$counter";
                        $harga = 50000 + ($counter * 10000);
                        $stok = rand(0, 20);
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $judul; ?></h6>
                                <p class="card-text">
                                    <strong>Harga:</strong> Rp <?php echo number_format($harga, 0, ',', '.'); ?><br />
                                    <strong>Stok:</strong> <?php echo $stok; ?>
                                </p>
                                <?php if ($stok > 0): ?>
                                    <button class="btn btn-sm btn-primary">Pinjam</button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled>Habis</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        $counter++;
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Nested Loop -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Metode 3: Nested Loop (Rak Perpustakaan)</h5>
            </div>
            <div class="card-body">
                <?php
                // Loop untuk rak
                for ($rak = 1; $rak <= 3; $rak++) {
                    echo "<div class='mb-4'>";
                    echo "<h5><i class='bi bi-bookshelf'></i> Rak $rak</h5>";
                    echo "<div class='row'>";
                    
                    // Loop untuk buku di setiap rak
                    for ($buku = 1; $buku <= 4; $buku++) {
                        $nomor = ($rak - 1) * 4 + $buku;
                        $kode = "R$rak-B$buku";
                        $stok = rand(0, 10);
                        
                        // Warna berdasarkan rak
                        switch ($rak) {
                            case 1:
                                $warna_rak = "primary";
                                break;
                            case 2:
                                $warna_rak = "success";
                                break;
                            case 3:
                                $warna_rak = "warning";
                                break;
                        }
                ?>
                    <div class="col-md-3 mb-2">
                        <div class="card border-<?php echo $warna_rak; ?>">
                            <div class="card-body text-center p-2">
                                <small><strong><?php echo $kode; ?></strong></small><br />
                                <small>Stok: <?php echo $stok; ?></small>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                    echo "</div></div>";
                }
                ?>
            </div>
        </div>
        
        <!--Loop dengan Skip  -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Metode 4: Hanya Tampilkan Buku Tersedia (Continue)</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Menampilkan hanya buku dengan stok > 0
                </div>
                <div class="row">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $stok = rand(0, 10);
                        
                        // Skip jika stok habis
                        if ($stok == 0) {
                            continue;
                        }
                        
                        $judul = "Buku Digital #$i";
                    ?>
                    <div class="col-md-3 mb-3">
                        <div class="card border-success">
                            <div class="card-body">
                                <h6><?php echo $judul; ?></h6>
                                <p class="mb-0">
                                    <span class="badge bg-success">Stok: <?php echo $stok; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <!-- Loop dengan Break -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Metode 5: Tampilkan Maksimal 5 Buku (Break)</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="bi bi-info-circle"></i> Loop akan berhenti setelah menampilkan 5 buku
                </div>
                <ul class="list-group">
                    <?php
                    $counter = 1;
                    $max_display = 5;
                    
                    while ($counter <= 20) {
                        echo "<li class='list-group-item'>";
                        echo "Buku ke-$counter: Panduan Lengkap Vol. $counter";
                        echo "</li>";
                        
                        if ($counter >= $max_display) {
                            break; // Stop di buku ke-5
                        }
                        
                        $counter++;
                    }
                    ?>
                </ul>
                <div class="alert alert-info mt-3 mb-0">
                    Loop berhenti di counter: <?php echo $counter; ?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>