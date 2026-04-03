<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Status Peminjaman</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <h3 class="text-center fw-bold mb-4">
            <i class="bi bi-journal-bookmark-fill"></i> Status Peminjaman
        </h3>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <?php
                // Data
                $nama_anggota = "Jack Mc'Owi";
                $total_pinjaman = 3;
                $buku_terlambat = 4;
                $hari_keterlambatan = 8;

                $denda = 0;

                // IF ELSE
                if ($buku_terlambat > 0) {
                    $izin = "Tidak Bisa Pinjam";
                    $status = "Terlambat";
                    $peringatan = "Masih ada buku yang belum dikembalikan.";
                    $denda = $buku_terlambat * $hari_keterlambatan * 1000;

                    if ($denda > 50000) {
                        $denda = 50000;
                    }
                } elseif ($total_pinjaman >= 3) {
                    $izin = "Tidak Bisa Pinjam";
                    $status = "Penuh";
                    $peringatan = "Sudah mencapai batas maksimal peminjaman.";
                } else {
                    $izin = "Bisa Pinjam";
                    $status = "Normal";
                    $peringatan = "Tidak ada masalah.";
                }

                // SWITCH
                switch (true) {
                    case ($total_pinjaman <= 5):
                        $level = "Bronze";
                        $warna_level = "secondary";
                        break;
                    case ($total_pinjaman <= 15):
                        $level = "Silver";
                        $warna_level = "info";
                        break;
                    default:
                        $level = "Gold";
                        $warna_level = "warning";
                        break;
                }

                $warna_status = ($status == "Normal") ? "success" : (($status == "Penuh") ? "danger" : "warning");
                ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">
                            <i class="bi bi-person-circle"></i> <?php echo $nama_anggota; ?>
                        </h5>
                        <small class="text-muted">Anggota Perpustakaan</small>
                    </div>
                    <span class="badge bg-<?php echo $warna_level; ?>">
                        <i class="bi bi-award-fill"></i> <?php echo $level; ?>
                    </span>
                </div>

                <!-- Grid -->
                <div class="row text-center mb-4">

                    <div class="col-md-4 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-book-fill fs-3 text-primary"></i>
                            <small class="d-block mt-2">Total Pinjaman</small>
                            <h4><?php echo $total_pinjaman; ?></h4>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-exclamation-circle-fill fs-3 text-danger"></i>
                            <small class="d-block mt-2">Terlambat</small>
                            <h4 class="text-danger"><?php echo $buku_terlambat; ?></h4>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-cash-stack fs-3 text-warning"></i>
                            <small class="d-block mt-2">Denda</small>
                            <h4 class="text-warning">
                                Rp <?php echo number_format($denda, 0, ',', '.'); ?>
                            </h4>
                        </div>
                    </div>

                </div>

                <!-- Status -->
                <p>
                    <strong><i class="bi bi-info-circle"></i> Status:</strong>
                    <span class="badge bg-<?php echo $warna_status; ?>">
                        <?php echo $status; ?>
                    </span>
                </p>

                <p>
                    <strong><i class="bi bi-check-circle"></i> Izin Pinjam:</strong>
                    <span class="text-<?php echo ($izin == "Bisa Pinjam") ? "success" : "danger"; ?>">
                        <?php echo $izin; ?>
                    </span>
                </p>

                <p class="text-muted">
                    <i class="bi bi-exclamation-triangle"></i>
                    <?php echo $peringatan; ?>
                </p>

            </div>
        </div>

    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Sistem Perpustakaan</p>
    </footer>
</body>
</html>