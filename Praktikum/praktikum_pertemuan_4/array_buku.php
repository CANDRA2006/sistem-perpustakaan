<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-book"></i> Array Data Buku Perpustakaan</h1>
        
        <?php
        // 1. ARRAY INDEXED - Daftar judul buku
        $judul_buku = [
            "Pemrograman PHP untuk Pemula",
            "Mastering MySQL Database",
            "Laravel Framework Advanced",
            "JavaScript Fundamentals",
            "Web Design Principles"
        ];
        ?>
        
        <!-- Array Indexed -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">1. Array Indexed - Daftar Judul Buku</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Buku:</strong> <?php echo count($judul_buku); ?></p>
                <ol>
                    <?php foreach ($judul_buku as $judul): ?>
                        <li><?php echo $judul; ?></li>
                    <?php endforeach; ?>
                </ol>
                
                <hr>
                
                <h6>Akses Elemen Spesifik:</h6>
                <ul>
                    <li>Buku pertama: <strong><?php echo $judul_buku[0]; ?></strong></li>
                    <li>Buku ketiga: <strong><?php echo $judul_buku[2]; ?></strong></li>
                    <li>Buku terakhir: <strong><?php echo $judul_buku[count($judul_buku) - 1]; ?></strong></li>
                </ul>
            </div>
        </div>
        
        <?php
        // 2. ARRAY ASSOCIATIVE - Data buku lengkap
        $buku1 = [
            "kode" => "BK-001",
            "judul" => "Pemrograman PHP untuk Pemula",
            "kategori" => "Programming",
            "pengarang" => "Budi Raharjo",
            "penerbit" => "Informatika",
            "tahun" => 2023,
            "isbn" => "978-602-1234-56-7",
            "harga" => 75000,
            "stok" => 10,
            "bahasa" => "Indonesia"
        ];
        ?>
        
        <!-- Array Associative -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">2. Array Associative - Data Buku Lengkap</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Kode Buku</th>
                                <td>: <code><?php echo $buku1["kode"]; ?></code></td>
                            </tr>
                            <tr>
                                <th>Judul</th>
                                <td>: <?php echo $buku1["judul"]; ?></td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>: <span class="badge bg-primary"><?php echo $buku1["kategori"]; ?></span></td>
                            </tr>
                            <tr>
                                <th>Pengarang</th>
                                <td>: <?php echo $buku1["pengarang"]; ?></td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>: <?php echo $buku1["penerbit"]; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Tahun Terbit</th>
                                <td>: <?php echo $buku1["tahun"]; ?></td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>: <?php echo $buku1["isbn"]; ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp <?php echo number_format($buku1["harga"], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>: <?php echo $buku1["stok"]; ?> buku</td>
                            </tr>
                            <tr>
                                <th>Bahasa</th>
                                <td>: <?php echo $buku1["bahasa"]; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <h6>Informasi Array:</h6>
                <ul>
                    <li>Jumlah properties: <strong><?php echo count($buku1); ?></strong></li>
                    <li>Keys: <code><?php echo implode(", ", array_keys($buku1)); ?></code></li>
                </ul>
            </div>
        </div>
        
        <?php
        // 3. MULTIDIMENSIONAL ARRAY - Multiple buku
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
                "stok" => 3
            ]
        ];
        ?>
        
        <!-- Multidimensional Array -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">3. Multidimensional Array - Daftar Semua Buku</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Buku:</strong> <?php echo count($buku_list); ?> judul</p>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Tahun</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($buku_list as $buku): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $buku["kode"]; ?></code></td>
                                <td><?php echo $buku["judul"]; ?></td>
                                <td><span class="badge bg-primary"><?php echo $buku["kategori"]; ?></span></td>
                                <td><?php echo $buku["pengarang"]; ?></td>
                                <td><?php echo $buku["tahun"]; ?></td>
                                <td>Rp <?php echo number_format($buku["harga"], 0, ',', '.'); ?></td>
                                <td><?php echo $buku["stok"]; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Statistik dari Array -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0">4. Statistik Data (Menggunakan Loop & Array)</h5>
            </div>
            <div class="card-body">
                <?php
                // Hitung statistik
                $total_stok = 0;
                $total_nilai = 0;
                $harga_tertinggi = 0;
                $harga_terendah = PHP_INT_MAX;
                
                foreach ($buku_list as $buku) {
                    $total_stok += $buku["stok"];
                    $total_nilai += ($buku["harga"] * $buku["stok"]);
                    
                    if ($buku["harga"] > $harga_tertinggi) {
                        $harga_tertinggi = $buku["harga"];
                        $buku_termahal = $buku["judul"];
                    }
                    
                    if ($buku["harga"] < $harga_terendah) {
                        $harga_terendah = $buku["harga"];
                        $buku_termurah = $buku["judul"];
                    }
                }
                
                $rata_rata_harga = $total_nilai / $total_stok;
                ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Total Judul Buku:</strong>
                                <span class="badge bg-primary"><?php echo count($buku_list); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Total Stok:</strong>
                                <span class="badge bg-success"><?php echo $total_stok; ?> buku</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Total Nilai Inventaris:</strong>
                                <span class="badge bg-info">Rp <?php echo number_format($total_nilai, 0, ',', '.'); ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Buku Termahal:</strong><br />
                                <small><?php echo $buku_termahal; ?></small><br />
                                <span class="badge bg-danger">Rp <?php echo number_format($harga_tertinggi, 0, ',', '.'); ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Buku Termurah:</strong><br />
                                <small><?php echo $buku_termurah; ?></small><br />
                                <span class="badge bg-success">Rp <?php echo number_format($harga_terendah, 0, ',', '.'); ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Rata-rata Harga:</strong><br />
                                <span class="badge bg-secondary">Rp <?php echo number_format($rata_rata_harga, 0, ',', '.'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Array Functions -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">5. Demonstrasi Array Functions</h5>
            </div>
            <div class="card-body">
                <?php
                // Extract judul saja ke array baru
                $daftar_judul = [];
                foreach ($buku_list as $buku) {
                    $daftar_judul[] = $buku["judul"];
                }
                
                // Sort judul
                $judul_sorted = $daftar_judul;
                sort($judul_sorted);
                
                // Reverse
                $judul_reverse = array_reverse($daftar_judul);
                ?>
                
                <div class="row">
                    <div class="col-md-4">
                        <h6>Urutan Original:</h6>
                        <ol>
                            <?php foreach ($daftar_judul as $judul): ?>
                                <li><small><?php echo $judul; ?></small></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <h6>Sorted A-Z:</h6>
                        <ol>
                            <?php foreach ($judul_sorted as $judul): ?>
                                <li><small><?php echo $judul; ?></small></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <h6>Reversed:</h6>
                        <ol>
                            <?php foreach ($judul_reverse as $judul): ?>
                                <li><small><?php echo $judul; ?></small></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                
                <hr>
                
                <h6>Filter & Search:</h6>
                <?php
                // Cari buku dengan kata kunci
                $keyword = "PHP";
                $hasil_cari = [];
                
                foreach ($buku_list as $buku) {
                    if (stripos($buku["judul"], $keyword) !== false) {
                        $hasil_cari[] = $buku;
                    }
                }
                ?>
                
                <p>Hasil pencarian buku dengan kata kunci "<strong><?php echo $keyword; ?></strong>": 
                   <span class="badge bg-success"><?php echo count($hasil_cari); ?> buku</span>
                </p>
                
                <?php if (count($hasil_cari) > 0): ?>
                <ul>
                    <?php foreach ($hasil_cari as $buku): ?>
                        <li><?php echo $buku["judul"]; ?> - Rp <?php echo number_format($buku["harga"], 0, ',', '.'); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
