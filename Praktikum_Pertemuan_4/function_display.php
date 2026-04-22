<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Display Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-code-square"></i> Function untuk Display Buku</h1>
        
        <?php
        // Data buku
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
                "stok" => 0
            ]
        ];
        
        // ========== FUNCTION DEFINITIONS ==========
        
        // 1. Function untuk format rupiah
        function format_rupiah($angka) {
            return "Rp " . number_format($angka, 0, ',', '.');
        }
        
        // 2. Function untuk badge status stok
        function badge_stok($stok) {
            if ($stok == 0) {
                return '<span class="badge bg-danger">Habis</span>';
            } elseif ($stok < 5) {
                return '<span class="badge bg-warning">Menipis</span>';
            } else {
                return '<span class="badge bg-success">Tersedia</span>';
            }
        }
        
        // 3. Function untuk badge kategori
        function badge_kategori($kategori) {
            $warna = "secondary";
            $icon = "book";
            
            switch ($kategori) {
                case "Programming":
                    $warna = "primary";
                    $icon = "code-slash";
                    break;
                case "Database":
                    $warna = "success";
                    $icon = "database";
                    break;
                case "Web Design":
                    $warna = "info";
                    $icon = "palette";
                    break;
                case "Networking":
                    $warna = "warning";
                    $icon = "wifi";
                    break;
            }
            
            return "<span class='badge bg-$warna'><i class='bi bi-$icon'></i> $kategori</span>";
        }
        
        // 4. Function untuk tampilkan card buku
        function tampilkan_card_buku($buku) {
            $html = '<div class="card mb-3">';
            $html .= '<div class="card-header bg-primary text-white">';
            $html .= '<h5 class="mb-0">' . $buku["judul"] . '</h5>';
            $html .= '</div>';
            $html .= '<div class="card-body">';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-8">';
            $html .= '<table class="table table-borderless table-sm">';
            $html .= '<tr><th width="120">Kode</th><td>: <code>' . $buku["kode"] . '</code></td></tr>';
            $html .= '<tr><th>Kategori</th><td>: ' . badge_kategori($buku["kategori"]) . '</td></tr>';
            $html .= '<tr><th>Pengarang</th><td>: ' . $buku["pengarang"] . '</td></tr>';
            $html .= '<tr><th>Penerbit</th><td>: ' . $buku["penerbit"] . '</td></tr>';
            $html .= '<tr><th>Tahun</th><td>: ' . $buku["tahun"] . '</td></tr>';
            $html .= '<tr><th>Harga</th><td>: ' . format_rupiah($buku["harga"]) . '</td></tr>';
            $html .= '<tr><th>Stok</th><td>: ' . $buku["stok"] . ' ' . badge_stok($buku["stok"]) . '</td></tr>';
            $html .= '</table>';
            $html .= '</div>';
            $html .= '<div class="col-md-4 text-end">';
            
            if ($buku["stok"] > 0) {
                $html .= '<button class="btn btn-success"><i class="bi bi-cart-plus"></i> Pinjam</button>';
            } else {
                $html .= '<button class="btn btn-secondary" disabled><i class="bi bi-lock"></i> Habis</button>';
            }
            
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            
            return $html;
        }
        
        // 5. Function untuk tampilkan row tabel
        function tampilkan_row_tabel($buku, $nomor) {
            $html = '<tr>';
            $html .= '<td>' . $nomor . '</td>';
            $html .= '<td><code>' . $buku["kode"] . '</code></td>';
            $html .= '<td>' . $buku["judul"] . '</td>';
            $html .= '<td>' . badge_kategori($buku["kategori"]) . '</td>';
            $html .= '<td>' . $buku["pengarang"] . '</td>';
            $html .= '<td>' . format_rupiah($buku["harga"]) . '</td>';
            $html .= '<td class="text-center">' . $buku["stok"] . '</td>';
            $html .= '<td>' . badge_stok($buku["stok"]) . '</td>';
            $html .= '</tr>';
            
            return $html;
        }
        
        // 6. Function untuk hitung total stok
        function hitung_total_stok($buku_list) {
            $total = 0;
            foreach ($buku_list as $buku) {
                $total += $buku["stok"];
            }
            return $total;
        }
        
        // 7. Function untuk hitung total nilai
        function hitung_total_nilai($buku_list) {
            $total = 0;
            foreach ($buku_list as $buku) {
                $total += ($buku["harga"] * $buku["stok"]);
            }
            return $total;
        }
        
        // 8. Function untuk filter buku berdasarkan kategori
        function filter_kategori($buku_list, $kategori) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if ($buku["kategori"] == $kategori) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        ?>
        
        <!-- Tampilkan dengan Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">1. Tampilan Card (Menggunakan Function)</h5>
            </div>
            <div class="card-body">
                <?php foreach ($buku_list as $buku): ?>
                    <?php echo tampilkan_card_buku($buku); ?>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Tampilkan dengan Tabel -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">2. Tampilan Tabel (Menggunakan Function)</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th width="100">Kode</th>
                            <th>Judul</th>
                            <th width="150">Kategori</th>
                            <th>Pengarang</th>
                            <th width="120">Harga</th>
                            <th width="80">Stok</th>
                            <th width="100">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($buku_list as $buku): 
                        ?>
                            <?php echo tampilkan_row_tabel($buku, $no++); ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Statistik menggunakan Function -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">3. Statistik (Menggunakan Function)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Judul</h6>
                                <h3 class="text-primary"><?php echo count($buku_list); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Stok</h6>
                                <h3 class="text-success"><?php echo hitung_total_stok($buku_list); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-danger">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Nilai</h6>
                                <h3 class="text-danger"><?php echo format_rupiah(hitung_total_nilai($buku_list)); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filter dengan Function -->
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0">4. Filter Kategori (Menggunakan Function)</h5>
            </div>
            <div class="card-body">
                <?php
                $buku_programming = filter_kategori($buku_list, "Programming");
                $buku_database = filter_kategori($buku_list, "Database");
                ?>
                
                <h6>Buku Kategori Programming: <span class="badge bg-primary"><?php echo count($buku_programming); ?></span></h6>
                <ul>
                    <?php foreach ($buku_programming as $buku): ?>
                        <li><?php echo $buku["judul"]; ?> - <?php echo format_rupiah($buku["harga"]); ?></li>
                    <?php endforeach; ?>
                </ul>
                
                <h6>Buku Kategori Database: <span class="badge bg-success"><?php echo count($buku_database); ?></span></h6>
                <ul>
                    <?php foreach ($buku_database as $buku): ?>
                        <li><?php echo $buku["judul"]; ?> - <?php echo format_rupiah($buku["harga"]); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>