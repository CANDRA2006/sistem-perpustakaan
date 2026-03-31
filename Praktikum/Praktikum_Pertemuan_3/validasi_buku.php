<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-shield-check"></i> Validasi Data Buku</h1>
        
        <?php
        // Simulasi data input 
        $judul = "PHP Programming";
        $pengarang = "John Doe";
        $penerbit = "Gramedia";
        $tahun = 2025;
        $harga = 70000; 
        $stok = 5;
        $isbn = "9780123456789"; 
        
        // Array untuk menyimpan error
        $errors = [];
        $valid = true;
        
        // Validasi Judul
        if (empty($judul)) {
            $errors[] = "Judul buku harus diisi";
            $valid = false;
        } elseif (strlen($judul) < 3) {
            $errors[] = "Judul buku minimal 3 karakter";
            $valid = false;
        }
        
        // Validasi Pengarang
        if (empty($pengarang)) {
            $errors[] = "Pengarang harus diisi";
            $valid = false;
        }
        
        // Validasi Penerbit
        if (empty($penerbit)) {
            $errors[] = "Penerbit harus diisi";
            $valid = false;
        }
        
        // Validasi Tahun
        $tahun_sekarang = date("Y");
        if (empty($tahun)) {
            $errors[] = "Tahun terbit harus diisi";
            $valid = false;
        } elseif ($tahun < 1900) {
            $errors[] = "Tahun terbit tidak valid (minimal 1900)";
            $valid = false;
        } elseif ($tahun > $tahun_sekarang) {
            $errors[] = "Tahun terbit tidak boleh lebih dari tahun sekarang ($tahun_sekarang)";
            $valid = false;
        }
        
        // Validasi Harga
        if (empty($harga)) {
            $errors[] = "Harga harus diisi";
            $valid = false;
        } elseif ($harga < 0) {
            $errors[] = "Harga tidak boleh negatif";
            $valid = false;
        } elseif ($harga < 10000) {
            $errors[] = "Harga terlalu murah (minimal Rp 10.000)";
            $valid = false;
        }
        
        // Validasi Stok
        if (!isset($stok)) {
            $errors[] = "Stok harus diisi";
            $valid = false;
        } elseif ($stok < 0) {
            $errors[] = "Stok tidak boleh negatif";
            $valid = false;
        }
        
        // Validasi ISBN
        if (empty($isbn)) {
            $errors[] = "ISBN harus diisi";
            $valid = false;
        } elseif (strlen($isbn) < 10) {
            $errors[] = "ISBN minimal 10 karakter";
            $valid = false;
        }
        ?>
        
        <!-- Tampilkan Data Input -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Data Input</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Judul</th>
                        <td><?php echo !empty($judul) ? $judul : '<em class="text-muted">Kosong</em>'; ?></td>
                    </tr>
                    <tr>
                        <th>Pengarang</th>
                        <td><?php echo !empty($pengarang) ? $pengarang : '<em class="text-muted">Kosong</em>'; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td><?php echo !empty($penerbit) ? $penerbit : '<em class="text-muted">Kosong</em>'; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td><?php echo $tahun; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td><?php echo $stok; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><?php echo !empty($isbn) ? $isbn : '<em class="text-muted">Kosong</em>'; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Hasil Validasi -->
        <?php if ($valid): ?>
            <div class="alert alert-success">
                <h5><i class="bi bi-check-circle"></i> Validasi Berhasil!</h5>
                <p class="mb-0">Semua data valid dan siap disimpan ke database.</p>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <h5><i class="bi bi-x-circle"></i> Validasi Gagal!</h5>
                <p>Ditemukan <?php echo count($errors); ?> kesalahan:</p>
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- Detail Validasi per Field -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Detail Validasi per Field</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Validasi Judul -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                Validasi Judul
                            </div>
                            <div class="card-body">
                                <?php
                                if (empty($judul)) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> Judul kosong';
                                    echo '</div>';
                                } elseif (strlen($judul) < 3) {
                                    echo '<div class="alert alert-warning mb-0">';
                                    echo '<i class="bi bi-exclamation-triangle"></i> Judul terlalu pendek (' . strlen($judul) . ' karakter)';
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-success mb-0">';
                                    echo '<i class="bi bi-check-circle"></i> Judul valid (' . strlen($judul) . ' karakter)';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Validasi Tahun -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                Validasi Tahun Terbit
                            </div>
                            <div class="card-body">
                                <?php
                                if (empty($tahun)) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> Tahun kosong';
                                    echo '</div>';
                                } elseif ($tahun < 1900) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> Tahun terlalu lama';
                                    echo '</div>';
                                } elseif ($tahun > $tahun_sekarang) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> Tahun melebihi tahun sekarang';
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-success mb-0">';
                                    echo '<i class="bi bi-check-circle"></i> Tahun valid';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Validasi Harga -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                Validasi Harga
                            </div>
                            <div class="card-body">
                                <?php
                                if (empty($harga)) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> Harga kosong';
                                    echo '</div>';
                                } elseif ($harga < 0) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> Harga negatif';
                                    echo '</div>';
                                } elseif ($harga < 10000) {
                                    echo '<div class="alert alert-warning mb-0">';
                                    echo '<i class="bi bi-exclamation-triangle"></i> Harga terlalu murah';
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-success mb-0">';
                                    echo '<i class="bi bi-check-circle"></i> Harga valid';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Validasi ISBN -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                Validasi ISBN
                            </div>
                            <div class="card-body">
                                <?php
                                if (empty($isbn)) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-x-circle"></i> ISBN kosong';
                                    echo '</div>';
                                } elseif (strlen($isbn) < 10) {
                                    echo '<div class="alert alert-warning mb-0">';
                                    echo '<i class="bi bi-exclamation-triangle"></i> ISBN terlalu pendek (' . strlen($isbn) . ' karakter, minimal 10)';
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-success mb-0">';
                                    echo '<i class="bi bi-check-circle"></i> ISBN valid';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>