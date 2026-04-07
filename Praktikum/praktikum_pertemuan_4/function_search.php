<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Search Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-search"></i> Function Search Buku</h1>
        
        <?php
        // Data buku
        $buku_list = [
            [
                "kode" => "BK-001",
                "judul" => "Pemrograman PHP untuk Pemula",
                "kategori" => "Programming",
                "pengarang" => "Budi Raharjo",
                "tahun" => 2023,
                "harga" => 75000,
                "stok" => 10
            ],
            [
                "kode" => "BK-002",
                "judul" => "Mastering MySQL Database",
                "kategori" => "Database",
                "pengarang" => "Andi Nugroho",
                "tahun" => 2022,
                "harga" => 95000,
                "stok" => 5
            ],
            [
                "kode" => "BK-003",
                "judul" => "Laravel Framework Advanced",
                "kategori" => "Programming",
                "pengarang" => "Siti Aminah",
                "tahun" => 2024,
                "harga" => 125000,
                "stok" => 8
            ],
            [
                "kode" => "BK-004",
                "judul" => "PHP Web Services",
                "kategori" => "Programming",
                "pengarang" => "Budi Raharjo",
                "tahun" => 2023,
                "harga" => 85000,
                "stok" => 12
            ],
            [
                "kode" => "BK-005",
                "judul" => "PostgreSQL Advanced",
                "kategori" => "Database",
                "pengarang" => "Rina Wijaya",
                "tahun" => 2024,
                "harga" => 110000,
                "stok" => 3
            ]
        ];
        
        // ========== SEARCH FUNCTIONS ==========
        
        // 1. Cari buku by kode
        function cari_by_kode($buku_list, $kode) {
            foreach ($buku_list as $buku) {
                if ($buku["kode"] == $kode) {
                    return $buku;  // Return buku jika ketemu
                }
            }
            return null;  // Return null jika tidak ketemu
        }
        
        // 2. Cari buku by judul (partial match, case insensitive)
        function cari_by_judul($buku_list, $keyword) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if (stripos($buku["judul"], $keyword) !== false) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        
        // 3. Cari buku by kategori
        function cari_by_kategori($buku_list, $kategori) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if ($buku["kategori"] == $kategori) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        
        // 4. Cari buku by pengarang
        function cari_by_pengarang($buku_list, $pengarang) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if (stripos($buku["pengarang"], $pengarang) !== false) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        
        // 5. Cari buku by range harga
        function cari_by_range_harga($buku_list, $min, $max) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if ($buku["harga"] >= $min && $buku["harga"] <= $max) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        
        // 6. Cari buku tersedia (stok > 0)
        function cari_buku_tersedia($buku_list) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if ($buku["stok"] > 0) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        
        // 7. Cari buku terbaru (tahun terbit)
        function cari_buku_terbaru($buku_list, $tahun) {
            $hasil = [];
            foreach ($buku_list as $buku) {
                if ($buku["tahun"] >= $tahun) {
                    $hasil[] = $buku;
                }
            }
            return $hasil;
        }
        
        // Helper function untuk tampilkan hasil
        function tampilkan_hasil($hasil, $judul_pencarian) {
            if (count($hasil) > 0) {
                echo "<div class='alert alert-success'>";
                echo "<strong>$judul_pencarian:</strong> Ditemukan " . count($hasil) . " buku";
                echo "</div>";
                
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered table-hover'>";
                echo "<thead class='table-dark'>";
                echo "<tr>";
                echo "<th>No</th>";
                echo "<th>Kode</th>";
                echo "<th>Judul</th>";
                echo "<th>Kategori</th>";
                echo "<th>Pengarang</th>";
                echo "<th>Tahun</th>";
                echo "<th>Harga</th>";
                echo "<th>Stok</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                $no = 1;
                foreach ($hasil as $buku) {
                    echo "<tr>";
                    echo "<td>{$no}</td>";
                    echo "<td><code>{$buku['kode']}</code></td>";
                    echo "<td>{$buku['judul']}</td>";
                    echo "<td><span class='badge bg-primary'>{$buku['kategori']}</span></td>";
                    echo "<td>{$buku['pengarang']}</td>";
                    echo "<td>{$buku['tahun']}</td>";
                    echo "<td>Rp " . number_format($buku['harga'], 0, ',', '.') . "</td>";
                    echo "<td>{$buku['stok']}</td>";
                    echo "</tr>";
                    $no++;
                }
                
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning'>";
                echo "<strong>$judul_pencarian:</strong> Tidak ada buku yang ditemukan";
                echo "</div>";
            }
        }
        ?>
        
        <!-- Pencarian by Kode -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">1. Pencarian by Kode</h5>
            </div>
            <div class="card-body">
                <?php
                $kode_cari = "BK-002";
                $buku = cari_by_kode($buku_list, $kode_cari);
                
                if ($buku != null) {
                    echo "<div class='alert alert-success'>";
                    echo "<strong>Pencarian Kode '$kode_cari':</strong> Buku ditemukan!";
                    echo "</div>";
                    
                    echo "<table class='table table-bordered'>";
                    echo "<tr><th width='150'>Kode</th><td><code>{$buku['kode']}</code></td></tr>";
                    echo "<tr><th>Judul</th><td>{$buku['judul']}</td></tr>";
                    echo "<tr><th>Kategori</th><td><span class='badge bg-primary'>{$buku['kategori']}</span></td></tr>";
                    echo "<tr><th>Pengarang</th><td>{$buku['pengarang']}</td></tr>";
                    echo "<tr><th>Tahun</th><td>{$buku['tahun']}</td></tr>";
                    echo "<tr><th>Harga</th><td>Rp " . number_format($buku['harga'], 0, ',', '.') . "</td></tr>";
                    echo "<tr><th>Stok</th><td>{$buku['stok']} buku</td></tr>";
                    echo "</table>";
                } else {
                    echo "<div class='alert alert-warning'>";
                    echo "<strong>Pencarian Kode '$kode_cari':</strong> Buku tidak ditemukan";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        
        <!-- Pencarian by Judul -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">2. Pencarian by Judul (Keyword: "PHP")</h5>
            </div>
            <div class="card-body">
                <?php
                $keyword = "PHP";
                $hasil = cari_by_judul($buku_list, $keyword);
                tampilkan_hasil($hasil, "Pencarian Judul dengan keyword '$keyword'");
                ?>
            </div>
        </div>
        
        <!-- Pencarian by Kategori -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">3. Pencarian by Kategori (Kategori: "Programming")</h5>
            </div>
            <div class="card-body">
                <?php
                $kategori = "Programming";
                $hasil = cari_by_kategori($buku_list, $kategori);
                tampilkan_hasil($hasil, "Pencarian Kategori '$kategori'");
                ?>
            </div>
        </div>
        
        <!-- Pencarian by Pengarang -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0">4. Pencarian by Pengarang (Pengarang: "Budi")</h5>
            </div>
            <div class="card-body">
                <?php
                $pengarang = "Budi";
                $hasil = cari_by_pengarang($buku_list, $pengarang);
                tampilkan_hasil($hasil, "Pencarian Pengarang dengan keyword '$pengarang'");
                ?>
            </div>
        </div>
        
        <!-- Pencarian by Range Harga -->
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">5. Pencarian by Range Harga (Rp 70.000 - Rp 100.000)</h5>
            </div>
            <div class="card-body">
                <?php
                $min = 70000;
                $max = 100000;
                $hasil = cari_by_range_harga($buku_list, $min, $max);
                tampilkan_hasil($hasil, "Pencarian Range Harga Rp " . number_format($min, 0, ',', '.') . " - Rp " . number_format($max, 0, ',', '.'));
                ?>
            </div>
        </div>
        
        <!-- Pencarian Buku Tersedia -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">6. Buku yang Tersedia (Stok > 0)</h5>
            </div>
            <div class="card-body">
                <?php
                $hasil = cari_buku_tersedia($buku_list);
                tampilkan_hasil($hasil, "Buku yang Tersedia");
                ?>
            </div>
        </div>
        
        <!-- Pencarian Buku Terbaru -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">7. Buku Terbaru (Tahun ≥ 2024)</h5>
            </div>
            <div class="card-body">
                <?php
                $tahun = 2024;
                $hasil = cari_buku_terbaru($buku_list, $tahun);
                tampilkan_hasil($hasil, "Buku Terbaru (Tahun $tahun ke atas)");
                ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>