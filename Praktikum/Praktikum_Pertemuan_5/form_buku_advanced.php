<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Advanced</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php
                // Function sanitasi
                function sanitize_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                
                // Variabel untuk error per field
                $errors = [];
                $success = '';
                
                // Variabel untuk keep value
                $judul = '';
                $kategori = '';
                $pengarang = '';
                $penerbit = '';
                $tahun = '';
                $isbn = '';
                $harga = '';
                $stok = '';
                $deskripsi = '';
                $bahasa = '';
                
                // Proses form
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Terima dan sanitasi data
                    $judul = sanitize_input($_POST['judul'] ?? '');
                    $kategori = sanitize_input($_POST['kategori'] ?? '');
                    $pengarang = sanitize_input($_POST['pengarang'] ?? '');
                    $penerbit = sanitize_input($_POST['penerbit'] ?? '');
                    $tahun = sanitize_input($_POST['tahun'] ?? '');
                    $isbn = sanitize_input($_POST['isbn'] ?? '');
                    $harga = sanitize_input($_POST['harga'] ?? '');
                    $stok = sanitize_input($_POST['stok'] ?? '');
                    $deskripsi = sanitize_input($_POST['deskripsi'] ?? '');
                    $bahasa = sanitize_input($_POST['bahasa'] ?? '');
                    
                    // Validasi per field
                    
                    // 1. Judul
                    if (empty($judul)) {
                        $errors['judul'] = "Judul wajib diisi";
                    } elseif (strlen($judul) < 3) {
                        $errors['judul'] = "Judul minimal 3 karakter";
                    } elseif (strlen($judul) > 200) {
                        $errors['judul'] = "Judul maksimal 200 karakter";
                    }
                    
                    // 2. Kategori
                    if (empty($kategori)) {
                        $errors['kategori'] = "Kategori wajib dipilih";
                    } else {
                        $valid_kategori = ['Programming', 'Database', 'Web Design', 'Networking'];
                        if (!in_array($kategori, $valid_kategori)) {
                            $errors['kategori'] = "Kategori tidak valid";
                        }
                    }
                    
                    // 3. Pengarang
                    if (empty($pengarang)) {
                        $errors['pengarang'] = "Pengarang wajib diisi";
                    } elseif (strlen($pengarang) < 3) {
                        $errors['pengarang'] = "Nama pengarang minimal 3 karakter";
                    }
                    
                    // 4. Penerbit
                    if (empty($penerbit)) {
                        $errors['penerbit'] = "Penerbit wajib diisi";
                    }
                    
                    // 5. Tahun
                    if (empty($tahun)) {
                        $errors['tahun'] = "Tahun terbit wajib diisi";
                    } elseif (!is_numeric($tahun)) {
                        $errors['tahun'] = "Tahun harus berupa angka";
                    } elseif ($tahun < 1900) {
                        $errors['tahun'] = "Tahun minimal 1900";
                    } elseif ($tahun > date('Y')) {
                        $errors['tahun'] = "Tahun tidak boleh melebihi tahun sekarang";
                    }
                    
                    // 6. ISBN (format: 978-602-1234-56-7)
                    if (!empty($isbn)) {
                        if (!preg_match('/^\d{3}-\d{3}-\d{4}-\d{2}-\d$/', $isbn)) {
                            $errors['isbn'] = "Format ISBN tidak valid (contoh: 978-602-1234-56-7)";
                        }
                    }
                    
                    // 7. Harga
                    if (empty($harga)) {
                        $errors['harga'] = "Harga wajib diisi";
                    } elseif (!is_numeric($harga)) {
                        $errors['harga'] = "Harga harus berupa angka";
                    } elseif ($harga < 10000) {
                        $errors['harga'] = "Harga minimal Rp 10.000";
                    } elseif ($harga > 1000000) {
                        $errors['harga'] = "Harga maksimal Rp 1.000.000";
                    }
                    
                    // 8. Stok
                    if (!isset($_POST['stok']) || $_POST['stok'] === '') {
                        $errors['stok'] = "Stok wajib diisi";
                    } elseif (!is_numeric($stok)) {
                        $errors['stok'] = "Stok harus berupa angka";
                    } elseif ($stok < 0) {
                        $errors['stok'] = "Stok tidak boleh negatif";
                    } elseif ($stok > 1000) {
                        $errors['stok'] = "Stok maksimal 1000";
                    }
                    
                    // 9. Deskripsi
                    if (!empty($deskripsi) && strlen($deskripsi) > 500) {
                        $errors['deskripsi'] = "Deskripsi maksimal 500 karakter";
                    }
                    
                    // 10. Bahasa
                    if (empty($bahasa)) {
                        $errors['bahasa'] = "Bahasa wajib dipilih";
                    }
                    
                    // Jika tidak ada error
                    if (count($errors) == 0) {
                        $success = "Data buku berhasil disimpan!";
                        
                        // Di sini bisa simpan ke database
                        // Untuk saat ini, hanya tampilkan success dan reset form
                        
                        // Reset form
                        $judul = '';
                        $kategori = '';
                        $pengarang = '';
                        $penerbit = '';
                        $tahun = '';
                        $isbn = '';
                        $harga = '';
                        $stok = '';
                        $deskripsi = '';
                        $bahasa = '';
                    }
                }
                ?>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Form Input Buku (Advanced Validation)</h4>
                    </div>
                    <div class="card-body">
                        <!-- Success Message -->
                        <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle-fill"></i> <strong>Berhasil!</strong> <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Global Error Summary -->
                        <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h6><i class="bi bi-exclamation-triangle-fill"></i> Terdapat <?php echo count($errors); ?> kesalahan:</h6>
                            <ul class="mb-0">
                                <?php foreach ($errors as $field => $error): ?>
                                    <li><strong><?php echo ucfirst($field); ?>:</strong> <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="" novalidate>
                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="judul" class="form-label">
                                    Judul Buku <span class="text-danger">*
                                </label>
                                <input type="text" 
                                       class="form-control <?php echo isset($errors['judul']) ? 'is-invalid' : ''; ?>" 
                                       id="judul" 
                                       name="judul" 
                                       value="<?php echo htmlspecialchars($judul); ?>" 
                                       placeholder="Masukkan judul buku">
                                <?php if (isset($errors['judul'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo $errors['judul']; ?>
                                </div>
                                <?php endif; ?>
                                <small class="text-muted">Minimal 3 karakter, maksimal 200 karakter</small>
                            </div>
                            
                            <!-- Kategori & Bahasa -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select <?php echo isset($errors['kategori']) ? 'is-invalid' : ''; ?>" 
                                            id="kategori" 
                                            name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Programming" <?php echo ($kategori == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                                        <option value="Database" <?php echo ($kategori == 'Database') ? 'selected' : ''; ?>>Database</option>
                                        <option value="Web Design" <?php echo ($kategori == 'Web Design') ? 'selected' : ''; ?>>Web Design</option>
                                        <option value="Networking" <?php echo ($kategori == 'Networking') ? 'selected' : ''; ?>>Networking</option>
                                    </select>
                                    <?php if (isset($errors['kategori'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['kategori']; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="bahasa" class="form-label">
                                        Bahasa <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input <?php echo isset($errors['bahasa']) ? 'is-invalid' : ''; ?>" 
                                                   type="radio" 
                                                   name="bahasa" 
                                                   id="bahasa_id" 
                                                   value="Indonesia" 
                                                   <?php echo ($bahasa == 'Indonesia') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="bahasa_id">Indonesia</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="bahasa" 
                                                   id="bahasa_en" 
                                                   value="Inggris" 
                                                   <?php echo ($bahasa == 'Inggris') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="bahasa_en">Inggris</label>
                                        </div>
                                        <?php if (isset($errors['bahasa'])): ?>
                                        <div class="text-danger small">
                                            <?php echo $errors['bahasa']; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pengarang & Penerbit -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pengarang" class="form-label">
                                        Pengarang <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?php echo isset($errors['pengarang']) ? 'is-invalid' : ''; ?>" 
                                           id="pengarang" 
                                           name="pengarang" 
                                           value="<?php echo htmlspecialchars($pengarang); ?>" 
                                           placeholder="Nama pengarang">
                                    <?php if (isset($errors['pengarang'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['pengarang']; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="penerbit" class="form-label">
                                        Penerbit <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?php echo isset($errors['penerbit']) ? 'is-invalid' : ''; ?>" 
                                           id="penerbit" 
                                           name="penerbit" 
                                           value="<?php echo htmlspecialchars($penerbit); ?>" 
                                           placeholder="Nama penerbit">
                                    <?php if (isset($errors['penerbit'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['penerbit']; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Tahun & ISBN -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tahun" class="form-label">
                                        Tahun Terbit <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['tahun']) ? 'is-invalid' : ''; ?>" 
                                           id="tahun" 
                                           name="tahun" 
                                           value="<?php echo htmlspecialchars($tahun); ?>" 
                                           min="1900" 
                                           max="<?php echo date('Y'); ?>" 
                                           placeholder="<?php echo date('Y'); ?>">
                                    <?php if (isset($errors['tahun'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['tahun']; ?>
                                    </div>
                                    <?php endif; ?>
                                    <small class="text-muted">Tahun 1900 - <?php echo date('Y'); ?></small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="isbn" class="form-label">
                                        ISBN <small class="text-muted">(Opsional)</small>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?php echo isset($errors['isbn']) ? 'is-invalid' : ''; ?>" 
                                           id="isbn" 
                                           name="isbn" 
                                           value="<?php echo htmlspecialchars($isbn); ?>" 
                                           placeholder="978-602-1234-56-7">
                                    <?php if (isset($errors['isbn'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['isbn']; ?>
                                    </div>
                                    <?php endif; ?>
                                    <small class="text-muted">Format: 978-602-1234-56-7</small>
                                </div>
                            </div>
                            
                            <!-- Harga & Stok -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">
                                        Harga (Rp) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['harga']) ? 'is-invalid' : ''; ?>" 
                                           id="harga" 
                                           name="harga" 
                                           value="<?php echo htmlspecialchars($harga); ?>" 
                                           min="10000" 
                                           max="1000000" 
                                           step="1000" 
                                           placeholder="75000">
                                    <?php if (isset($errors['harga'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['harga']; ?>
                                    </div>
                                    <?php endif; ?>
                                    <small class="text-muted">Rp 10.000 - Rp 1.000.000</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">
                                        Stok <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['stok']) ? 'is-invalid' : ''; ?>" 
                                           id="stok" 
                                           name="stok" 
                                           value="<?php echo htmlspecialchars($stok); ?>" 
                                           min="0" 
                                           max="1000" 
                                           placeholder="10">
                                    <?php if (isset($errors['stok'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['stok']; ?>
                                    </div>
                                    <?php endif; ?>
                                    <small class="text-muted">0 - 1000</small>
                                </div>
                            </div>
                            
                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">
                                    Deskripsi <small class="text-muted">(Opsional)</small>
                                </label>
                                <textarea class="form-control <?php echo isset($errors['deskripsi']) ? 'is-invalid' : ''; ?>" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="4" 
                                          placeholder="Deskripsi singkat tentang buku..."><?php echo htmlspecialchars($deskripsi); ?></textarea>
                                <?php if (isset($errors['deskripsi'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo $errors['deskripsi']; ?>
                                </div>
                                <?php endif; ?>
                                <small class="text-muted">
                                    Maksimal 500 karakter 
                                    <span id="char-count">(<?php echo strlen($deskripsi); ?>/500)</span>
                                </small>
                            </div>
                            
                            <hr>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-save"></i> Simpan Data Buku
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Reset Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Character counter untuk deskripsi
    document.getElementById('deskripsi').addEventListener('input', function() {
        var length = this.value.length;
        document.getElementById('char-count').textContent = '(' + length + '/500)';
    });
    </script>
</body>
</html>

