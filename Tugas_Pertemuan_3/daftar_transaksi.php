<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center fw-bold">Daftar Transaksi Peminjaman</h1>
        
        <?php
        // Menghitung statistik menggunakan loop
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // Loop untuk hitung statistik
        for ($i = 1; $i <= 10; $i++) {
            if ($i == 8) {
                break;
            }

            if ($i % 2 == 0) {
                continue;
            }

            // Mengitung statistik
            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
            $total_transaksi++;

            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>
    
        <!-- Menampilkan statistik dalam cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-list-ol fs-1 text-primary"></i>
                        <h5 class="mt-3">Total Transaksi</h5>
                        <h3 class="fw-bold"><?php echo $total_transaksi; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-book-half fs-1 text-warning"></i>
                        <h5 class="mt-3">Masih Dipinjam</h5>
                        <h3 class="fw-bold"><?php echo $total_dipinjam; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                        <h5 class="mt-3">Sudah Dikembalikan</h5>
                        <h3 class="fw-bold"><?php echo $total_dikembalikan; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Menampilkan tabel transaksi -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><i class="bi bi-hash me-1"></i>No</th>
                        <th><i class="bi bi-upc-scan me-1"></i>ID Transaksi</th>
                        <th><i class="bi bi-person-fill me-1"></i>Peminjam</th>
                        <th><i class="bi bi-book-fill me-1"></i>Buku</th>
                        <th><i class="bi bi-calendar-date me-1"></i>Tgl Pinjam</th>
                        <th><i class="bi bi-calendar-check me-1"></i>Tgl Kembali</th>
                        <th><i class="bi bi-clock-history me-1"></i>Hari</th>
                        <th><i class="bi bi-info-circle-fill me-1"></i>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop untuk tampilkan data
                    // Gunakan continue untuk skip genap
                    // Gunakan break untuk stop di transaksi 8
                    $no = 1;

                    for ($i = 1; $i <= 10; $i++) {
                        if ($i == 8) {
                            break;
                        }

                        if ($i % 2 == 0) {
                            continue;
                        }

                        // Menampilkan data transaksi
                        $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                        $nama_peminjam = "Anggota " . $i;
                        $judul_buku = "Buku Teknologi Vol. " . $i;
                        $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                        $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                        $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                        if ($status == "Dipinjam") {
                            $hari = floor((time() - strtotime($tanggal_pinjam)) / 86400);
                            $keterangan_hari = $hari . " hari";
                            $warna = "warning";
                            $icon_status = "bi-hourglass-split";
                        } else {
                            $hari = floor((strtotime($tanggal_kembali) - strtotime($tanggal_pinjam)) / 86400);
                            $keterangan_hari = $hari . " hari (selesai)";
                            $warna = "success";
                            $icon_status = "bi-check-circle-fill";
                        }
                        ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $id_transaksi; ?></td>
                            <td><?php echo $nama_peminjam; ?></td>
                            <td><?php echo $judul_buku; ?></td>
                            <td><?php echo $tanggal_pinjam; ?></td>
                            <td><?php echo $tanggal_kembali; ?></td>
                            <td><?php echo $keterangan_hari; ?></td>
                            <td>
                                <span class="badge bg-<?php echo $warna; ?>">
                                    <i class="bi <?php echo $icon_status; ?> me-1"></i><?php echo $status; ?>
                                </span>
                            </td>
                        </tr>

                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Sistem Perpustakaan</p>
    </footer>
</body>
</html>