<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-bookmark"></i> Kategori Buku Perpustakaan</h1>
        
        <div class="row">
            <?php
            // Array data buk
            $buku_list = [
                ["judul" => "PHP Programming", "kategori" => "Programming"],
                ["judul" => "MySQL Database", "kategori" => "Database"],
                ["judul" => "Web Design Principles", "kategori" => "Web Design"],
                ["judul" => "Network Security", "kategori" => "Networking"],
                ["judul" => "Digital Marketing", "kategori" => "Marketing"],
                ["judul" => "Data Science with Python", "kategori" => "Programming"]
            ];
            
            // Loop setiap buku
            foreach ($buku_list as $buku):
                // Switch untuk menentukan warna, icon, deskripsi
                switch ($buku["kategori"]) {
                    case "Programming":
                        $warna = "primary";
                        $icon = "code-slash";
                        $deskripsi = "Buku tentang bahasa pemrograman dan pengembangan software";
                        break;
                    case "Database":
                        $warna = "success";
                        $icon = "database";
                        $deskripsi = "Buku tentang manajemen dan desain database";
                        break;
                    case "Web Design":
                        $warna = "info";
                        $icon = "palette";
                        $deskripsi = "Buku tentang desain antarmuka dan pengalaman pengguna";
                        break;
                    case "Networking":
                        $warna = "warning";
                        $icon = "wifi";
                        $deskripsi = "Buku tentang jaringan komputer dan keamanan";
                        break;
                    case "Marketing":
                        $warna = "danger";
                        $icon = "megaphone";
                        $deskripsi = "Buku tentang strategi pemasaran digital";
                        break;
                    default:
                        $warna = "secondary";
                        $icon = "book";
                        $deskripsi = "Kategori umum";
                }
            ?>
            
            <div class="col-md-6 mb-3">
                <div class="card border-<?php echo $warna; ?>">
                    <div class="card-header bg-<?php echo $warna; ?> text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-<?php echo $icon; ?>"></i>
                            <?php echo $buku["judul"]; ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <span class="badge bg-<?php echo $warna; ?>">
                                <?php echo $buku["kategori"]; ?>
                            </span>
                        </p>
                        <p class="text-muted"><small><?php echo $deskripsi; ?></small></p>
                    </div>
                </div>
            </div>
            
            <?php endforeach; ?>
        </div>
        
        <!-- Statistik Kategori -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Statistik Kategori</h5>
            </div>
            <div class="card-body">
                <?php
                // Switch untuk statistik
                $total_programming = 0;
                $total_database = 0;
                $total_web_design = 0;
                $total_networking = 0;
                $total_marketing = 0;
                $total_lainnya = 0;
                
                foreach ($buku_list as $buku) {
                    switch ($buku["kategori"]) {
                        case "Programming":
                            $total_programming++;
                            break;
                        case "Database":
                            $total_database++;
                            break;
                        case "Web Design":
                            $total_web_design++;
                            break;
                        case "Networking":
                            $total_networking++;
                            break;
                        case "Marketing":
                            $total_marketing++;
                            break;
                        default:
                            $total_lainnya++;
                    }
                }
                ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-code-slash text-primary"></i> Programming</span>
                                <span class="badge bg-primary"><?php echo $total_programming; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-database text-success"></i> Database</span>
                                <span class="badge bg-success"><?php echo $total_database; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-palette text-info"></i> Web Design</span>
                                <span class="badge bg-info"><?php echo $total_web_design; ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-wifi text-warning"></i> Networking</span>
                                <span class="badge bg-warning"><?php echo $total_networking; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-megaphone text-danger"></i> Marketing</span>
                                <span class="badge bg-danger"><?php echo $total_marketing; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-book text-secondary"></i> Lainnya</span>
                                <span class="badge bg-secondary"><?php echo $total_lainnya; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>