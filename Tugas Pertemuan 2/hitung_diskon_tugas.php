<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>

        <?php
        
        // DATA INPUT
        $nama_pembeli  = "Raka";
        $judul_buku    = "Belajar Jadi Front-end Developer";
        $harga_satuan  = 19000;
        $jumlah_beli   = 5;
        $is_member     = true; // true atau false

        
        // HITUNG SUBTOTAL
        $subtotal = $harga_satuan * $jumlah_beli;
        
        // TENTUKAN PERSENTASE DISKON BERDASARKAN JUMLAH        
        if ($jumlah_beli >= 1 && $jumlah_beli <= 2) {
            $persentase_diskon = 0;
        } elseif ($jumlah_beli >= 3 && $jumlah_beli <= 5) {
            $persentase_diskon = 10;
        } elseif ($jumlah_beli >= 6 && $jumlah_beli <= 10) {
            $persentase_diskon = 15;
        } else {
            $persentase_diskon = 20;
        }

        // HITUNG DISKON        
        $diskon = $subtotal * ($persentase_diskon / 100);

        // TOTAL SETELAH DISKON PERTAMA        
        $total_setelah_diskon1 = $subtotal - $diskon;

        // HITUNG DISKON MEMBER (5%) JIKA MEMBER        
        $diskon_member = 0;
        if ($is_member) {
            $diskon_member = $total_setelah_diskon1 * 0.05;
        }
        
        // TOTAL SETELAH SEMUA DISKON
        $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;

        // HITUNG PPN 11%
        $ppn = $total_setelah_diskon * 0.11;

        // TOTAL AKHIR
        $total_akhir = $total_setelah_diskon + $ppn;
        
        // TOTAL PENGHEMATAN        
        $total_hemat = $diskon + $diskon_member;
        ?>

        <!-- INFO PEMBELI -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Pembeli</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="200">Nama Pembeli</th>
                        <td>: <?php echo $nama_pembeli; ?></td>
                    </tr>
                    <tr>
                        <th>Judul Buku</th>
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
                    <tr>
                        <th>Status</th>
                        <td>:
                            <?php if ($is_member) { ?>
                                <span class="badge bg-success">Member</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">Non-Member</span>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- HASIL PERHITUNGAN -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Hasil Perhitungan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="250">Subtotal</th>
                        <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            Diskon
                            <?php if ($persentase_diskon > 0) { ?>
                                <span class="badge bg-danger"><?php echo $persentase_diskon; ?>%</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">0%</span>
                            <?php } ?>
                        </td>
                        <td>- Rp <?php echo number_format($diskon, 0, ',', '.'); ?></td>
                    </tr>

                    <?php if ($is_member) { ?>
                    <tr>
                        <td>
                            Diskon Member
                            <span class="badge bg-warning text-dark">5%</span>
                            <small class="text-muted">(dari Rp <?php echo number_format($total_setelah_diskon1, 0, ',', '.'); ?>)</small>
                        </td>
                        <td>- Rp <?php echo number_format($diskon_member, 0, ',', '.'); ?></td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <th>Total Setelah Diskon</th>
                        <td>Rp <?php echo number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>PPN <span class="badge bg-secondary">11%</span></td>
                        <td>+ Rp <?php echo number_format($ppn, 0, ',', '.'); ?></td>
                    </tr>
                    <tr class="table-primary">
                        <th>Total Akhir</th>
                        <th>Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></th>
                    </tr>
                </table>
            </div>
        </div>

        <!-- TOTAL PENGHEMATAN -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Penghematan</h5>
            </div>
            <div class="card-body">
                <p class="mb-0 fs-5">
                    Selamat! Anda hemat
                    <strong class="text-success">Rp <?php echo number_format($total_hemat, 0, ',', '.'); ?></strong>
                </p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>