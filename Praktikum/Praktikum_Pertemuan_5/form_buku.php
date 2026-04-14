<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Form Input Buku Baru</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        // Variabel untuk menyimpan pesan
                        $success = '';
                        $errors = [];
                        
                        // Variabel untuk menyimpan input (untuk keep value)
                        $judul = '';
                        $kategori = '';
                        $pengarang = '';
                        $penerbit = '';
                        $tahun = '';
                        $harga = '';
                        $stok = '';
                        
                        // Proses form jika di-submit
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Ambil dan sanitasi data
                            $judul = trim(htmlspecialchars($_POST['judul'] ?? ''));
                            $kategori = trim($_POST['kategori'] ?? '');
                            $pengarang = trim(htmlspecialchars($_POST['pengarang'] ?? ''));
                            $penerbit = trim(htmlspecialchars($_POST['penerbit'] ?? ''));
                            $tahun = trim($_POST['tahun'] ?? '');
                            $harga = trim($_POST['harga'] ?? '');
                            $stok = trim($_POST['stok'] ?? '');
                            
                            // Validasi Judul
                            if (empty($judul)) {
                                $errors[] = "Judul buku wajib diisi";
                            } elseif (strlen($judul) < 3) {
                                $errors[] = "Judul minimal 3 karakter";
                            }
                            
                            // Validasi Kategori
                            if (empty($kategori)) {
                                $errors[] = "Kategori wajib dipilih";
                            }
                            
                            // Validasi Pengarang
                            if (empty($pengarang)) {
                                $errors[] = "Pengarang wajib diisi";
                            }
                            
                            // Validasi Penerbit
                            if (empty($penerbit)) {
                                $errors[] = "Penerbit wajib diisi";
                            }
                            
                            // Validasi Tahun
                            if (empty($tahun)) {
                                $errors[] = "Tahun terbit wajib diisi";
                            } elseif (!is_numeric($tahun)) {
                                $errors[] = "Tahun harus berupa angka";
                            } elseif ($tahun < 1900 || $tahun > date('Y')) {
                                $errors[] = "Tahun tidak valid (1900 - " . date('Y') . ")";
                            }
                            
                            // Validasi Harga
                            if (empty($harga)) {
                                $errors[] = "Harga wajib diisi";
                            } elseif (!is_numeric($harga)) {
                                $errors[] = "Harga harus berupa angka";
                            } elseif ($harga < 10000) {
                                $errors[] = "Harga minimal Rp 10.000";
                            }
                            
                            // Validasi Stok
                            if (empty($stok) && $stok !== '0') {
                                $errors[] = "Stok wajib diisi";
                            } elseif (!is_numeric($stok)) {
                                $errors[] = "Stok harus berupa angka";
                            } elseif ($stok < 0) {
                                $errors[] = "Stok tidak boleh negatif";
                            }
                            
                            // Jika tidak ada error, proses data
                            if (count($errors) == 0) {
                                $success = "Data buku berhasil disimpan!";
                                
                                // Reset form
                                $judul = '';
                                $kategori = '';
                                $pengarang = '';
                                $penerbit = '';
                                $tahun = '';
                                $harga = '';
                                $stok = '';
                            }
                        }
                        ?>
                        
                        <!-- Tampilkan pesan sukses -->
                        <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle"></i> <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Tampilkan error -->
                        <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h6><i class="bi bi-exclamation-triangle"></i> Terdapat kesalahan:</h6>
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Form -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php echo (!empty($errors) && empty($judul)) ? 'is-invalid' : ''; ?>" 
                                       id="judul" name="judul" value="<?php echo htmlspecialchars($judul); ?>" 
                                       placeholder="Masukkan judul buku">
                            </div>
                            
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" id="kategori" name="kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Programming" <?php echo ($kategori == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                                    <option value="Database" <?php echo ($kategori == 'Database') ? 'selected' : ''; ?>>Database</option>
                                    <option value="Web Design" <?php echo ($kategori == 'Web Design') ? 'selected' : ''; ?>>Web Design</option>
                                    <option value="Networking" <?php echo ($kategori == 'Networking') ? 'selected' : ''; ?>>Networking</option>
                                </select>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pengarang" class="form-label">Pengarang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pengarang" name="pengarang" 
                                           value="<?php echo htmlspecialchars($pengarang); ?>" 
                                           placeholder="Nama pengarang">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="penerbit" class="form-label">Penerbit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit"
                                           value="<?php echo htmlspecialchars($penerbit); ?>" 
                                           placeholder="Nama penerbit">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="tahun" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="tahun" name="tahun" 
                                           value="<?php echo htmlspecialchars($tahun); ?>" 
                                           min="1900" max="<?php echo date('Y'); ?>" 
                                           placeholder="<?php echo date('Y'); ?>">
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="harga" name="harga" 
                                           value="<?php echo htmlspecialchars($harga); ?>" 
                                           min="10000" step="1000" 
                                           placeholder="75000">
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stok" name="stok" 
                                           value="<?php echo htmlspecialchars($stok); ?>" 
                                           min="0" 
                                           placeholder="10">
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <small><i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Field dengan tanda (*) wajib diisi</small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Data Buku
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Reset Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Info Validasi -->
                <div class="card mt-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="bi bi-shield-check"></i> Aturan Validasi</h6>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Judul minimal 3 karakter</li>
                            <li>Kategori harus dipilih</li>
                            <li>Tahun terbit antara 1900 - <?php echo date('Y'); ?></li>
                            <li>Harga minimal Rp 10.000</li>
                            <li>Stok tidak boleh negatif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>