<?php
session_start();
 
// Inisialisasi session untuk menyimpan data buku
if (!isset($_SESSION['buku_list'])) {
    $_SESSION['buku_list'] = [
        [
            "id" => 1,
            "kode" => "BK-001",
            "judul" => "Pemrograman PHP untuk Pemula",
            "kategori" => "Programming",
            "pengarang" => "Budi Raharjo",
            "harga" => 75000,
            "stok" => 10
        ],
        [
            "id" => 2,
            "kode" => "BK-002",
            "judul" => "Mastering MySQL Database",
            "kategori" => "Database",
            "pengarang" => "Andi Nugroho",
            "harga" => 95000,
            "stok" => 5
        ]
    ];
    $_SESSION['next_id'] = 3;
}
 
// Variabel
$success = '';
$errors = [];
$mode = 'list'; // list, add, edit
 
// Handle Actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    // DELETE
    if ($action == 'delete' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        foreach ($_SESSION['buku_list'] as $key => $buku) {
            if ($buku['id'] == $id) {
                unset($_SESSION['buku_list'][$key]);
                $_SESSION['buku_list'] = array_values($_SESSION['buku_list']); // Re-index
                $success = "Buku berhasil dihapus!";
                break;
            }
        }
    }
    
    // EDIT MODE
    if ($action == 'edit' && isset($_GET['id'])) {
        $mode = 'edit';
        $edit_id = (int)$_GET['id'];
    }
    
    // ADD MODE
    if ($action == 'add') {
        $mode = 'add';
    }
}
 
// Handle Form Submit (CREATE & UPDATE)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitasi input
    $judul = trim(htmlspecialchars($_POST['judul'] ?? ''));
    $kategori = trim($_POST['kategori'] ?? '');
    $pengarang = trim(htmlspecialchars($_POST['pengarang'] ?? ''));
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    
    // Validasi
    if (empty($judul)) {
        $errors[] = "Judul wajib diisi";
    }
    if (empty($kategori)) {
        $errors[] = "Kategori wajib dipilih";
    }
    if (empty($pengarang)) {
        $errors[] = "Pengarang wajib diisi";
    }
    if (empty($harga) || !is_numeric($harga) || $harga < 10000) {
        $errors[] = "Harga minimal Rp 10.000";
    }
    if (!isset($_POST['stok']) || !is_numeric($stok) || $stok < 0) {
        $errors[] = "Stok tidak valid";
    }
    
    // Jika valid
    if (count($errors) == 0) {
        if (isset($_POST['id'])) {
            // UPDATE
            $id = (int)$_POST['id'];
            foreach ($_SESSION['buku_list'] as &$buku) {
                if ($buku['id'] == $id) {
                    $buku['judul'] = $judul;
                    $buku['kategori'] = $kategori;
                    $buku['pengarang'] = $pengarang;
                    $buku['harga'] = (int)$harga;
                    $buku['stok'] = (int)$stok;
                    break;
                }
            }
            $success = "Buku berhasil diupdate!";
        } else {
            // CREATE
            $new_buku = [
                "id" => $_SESSION['next_id'],
                "kode" => "BK-" . str_pad($_SESSION['next_id'], 3, "0", STR_PAD_LEFT),
                "judul" => $judul,
                "kategori" => $kategori,
                "pengarang" => $pengarang,
                "harga" => (int)$harga,
                "stok" => (int)$stok
            ];
            $_SESSION['buku_list'][] = $new_buku;
            $_SESSION['next_id']++;
            $success = "Buku berhasil ditambahkan!";
        }
        $mode = 'list';
    } else {
        // Keep mode if error
        $mode = isset($_POST['id']) ? 'edit' : 'add';
    }
}
 
// Get data untuk edit
$edit_data = null;
if ($mode == 'edit' && isset($edit_id)) {
    foreach ($_SESSION['buku_list'] as $buku) {
        if ($buku['id'] == $edit_id) {
            $edit_data = $buku;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Buku - Session Storage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="crud_buku.php">
                <i class="bi bi-book"></i> CRUD Buku Perpustakaan
            </a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <!-- Success Message -->
        <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <!-- Error Messages -->
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
        
        <?php if ($mode == 'list'): ?>
        <!-- LIST MODE -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="bi bi-table"></i> Daftar Buku</h2>
            <a href="?action=add" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <?php if (count($_SESSION['buku_list']) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($_SESSION['buku_list'] as $buku): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $buku['kode']; ?></code></td>
                                <td><?php echo $buku['judul']; ?></td>
                                <td><span class="badge bg-primary"><?php echo $buku['kategori']; ?></span></td>
                                <td><?php echo $buku['pengarang']; ?></td>
                                <td>Rp <?php echo number_format($buku['harga'], 0, ',', '.'); ?></td>
                                <td class="text-center"><?php echo $buku['stok']; ?></td>
                                <td>
                                    <a href="?action=edit&id=<?php echo $buku['id']; ?>" 
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="?action=delete&id=<?php echo $buku['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i> Belum ada data buku. Silakan tambah buku baru.
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <?php elseif ($mode == 'add' || $mode == 'edit'): ?>
        <!-- FORM MODE (ADD / EDIT) -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>
                <i class="bi bi-<?php echo $mode == 'add' ? 'plus-circle' : 'pencil'; ?>"></i> 
                <?php echo $mode == 'add' ? 'Tambah' : 'Edit'; ?> Buku
            </h2>
            <a href="crud_buku.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <?php if ($mode == 'edit' && $edit_data): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="judul" 
                               name="judul" 
                               value="<?php echo $mode == 'edit' && $edit_data ? htmlspecialchars($edit_data['judul']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $kategori_list = ['Programming', 'Database', 'Web Design', 'Networking'];
                            $selected_kategori = $mode == 'edit' && $edit_data ? $edit_data['kategori'] : '';
                            foreach ($kategori_list as $kat):
                            ?>
                            <option value="<?php echo $kat; ?>" <?php echo ($selected_kategori == $kat) ? 'selected' : ''; ?>>
                                <?php echo $kat; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="pengarang" 
                               name="pengarang" 
                               value="<?php echo $mode == 'edit' && $edit_data ? htmlspecialchars($edit_data['pengarang']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control" 
                                   id="harga" 
                                   name="harga" 
                                   value="<?php echo $mode == 'edit' && $edit_data ? $edit_data['harga'] : ''; ?>" 
                                   min="10000" 
                                   required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control" 
                                   id="stok" 
                                   name="stok" 
                                   value="<?php echo $mode == 'edit' && $edit_data ? $edit_data['stok'] : ''; ?>" 
                                   min="0" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> <?php echo $mode == 'add' ? 'Simpan' : 'Update'; ?>
                        </button>
                        <a href="crud_buku.php" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>