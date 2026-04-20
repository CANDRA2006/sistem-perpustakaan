<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi Anggota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php
        session_start();
    
        function sanitize_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }
    
        $nama = $email = $telepon = $alamat = $jenis_kelamin = $tanggal_lahir = $pekerjaan = "";
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            $nama = sanitize_input($_POST['nama'] ?? '');
            $email = sanitize_input($_POST['email'] ?? '');
            $telepon = sanitize_input($_POST['telepon'] ?? '');
            $alamat = sanitize_input($_POST['alamat'] ?? '');
            $jenis_kelamin = sanitize_input($_POST['jenis_kelamin'] ?? '');
            $tanggal_lahir = sanitize_input($_POST['tanggal_lahir'] ?? '');
            $pekerjaan = sanitize_input($_POST['pekerjaan'] ?? '');
    
            if (empty($nama)) {
                $errors['nama'] = "Nama wajib diisi";
            } elseif (strlen($nama) < 3) {
                $errors['nama'] = "Minimal 3 karakter";
            }
    
            if (empty($email)) {
                $errors['email'] = "Email wajib diisi";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Format email tidak valid";
            }
    
            if (empty($telepon)) {
                $errors['telepon'] = "Telepon wajib diisi";
            } elseif (!preg_match('/^08[0-9]{8,11}$/', $telepon)) {
                $errors['telepon'] = "Format 08xxxxxxxxxx";
            }
    
            if (empty($alamat)) {
                $errors['alamat'] = "Alamat wajib diisi";
            } elseif (strlen($alamat) < 10) {
                $errors['alamat'] = "Minimal 10 karakter";
            }
    
            if (empty($jenis_kelamin)) {
                $errors['jenis_kelamin'] = "Pilih jenis kelamin";
            }
    
            if (empty($tanggal_lahir)) {
                $errors['tanggal_lahir'] = "Tanggal wajib diisi";
            } else {
                $umur = (new DateTime())->diff(new DateTime($tanggal_lahir))->y;
                if ($umur < 10) {
                    $errors['tanggal_lahir'] = "Umur minimal 10 tahun";
                }
            }
    
            if (empty($pekerjaan)) {
                $errors['pekerjaan'] = "Pilih pekerjaan";
            }
    
            if (empty($errors)) {
                $_SESSION['data'] = compact(
                    'nama', 'email', 'telepon', 'alamat',
                    'jenis_kelamin', 'tanggal_lahir', 'pekerjaan'
                );
    
                header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                exit;
            }
        }
    ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">📚 Registrasi Anggota</h4>
                    </div>

                    <div class="card-body p-4">

                        <!-- ERROR -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $err): ?>
                                        <li><?= $err ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- SUCCESS -->
                        <?php if (isset($_GET['success']) && isset($_SESSION['data'])): 
                            $data = $_SESSION['data'];
                        ?>
                            <div class="card mb-4 border-success shadow-sm">
                                <div class="card-header bg-success text-white">
                                    Data Berhasil Disimpan
                                </div>
                                <div class="card-body">
                                    <p><b>Nama:</b> <?= $data['nama'] ?></p>
                                    <p><b>Email:</b> <?= $data['email'] ?></p>
                                    <p><b>Telepon:</b> <?= $data['telepon'] ?></p>
                                    <p><b>Jenis Kelamin:</b> <?= $data['jenis_kelamin'] ?></p>
                                    <p><b>Tanggal Lahir:</b> <?= $data['tanggal_lahir'] ?></p>
                                    <p><b>Pekerjaan:</b> <?= $data['pekerjaan'] ?></p>
                                    <p><b>Alamat:</b> <?= nl2br($data['alamat']) ?></p>
                                </div>
                            </div>

                            <?php unset($_SESSION['data']); ?>
                        <?php endif; ?>

                        <!-- FORM -->
                        <form method="POST">

                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text"
                                       name="nama"
                                       class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>"
                                       value="<?= $nama ?>">
                                <div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                       value="<?= $email ?>">
                                <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                            </div>

                            <div class="mb-3">
                                <label>Telepon</label>
                                <input type="text"
                                       name="telepon"
                                       class="form-control <?= isset($errors['telepon']) ? 'is-invalid' : '' ?>"
                                       value="<?= $telepon ?>"
                                       inputmode="numeric"
                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                <div class="invalid-feedback"><?= $errors['telepon'] ?? '' ?></div>
                            </div>

                            <div class="mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat"
                                          class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : '' ?>"><?= $alamat ?></textarea>
                                <div class="invalid-feedback"><?= $errors['alamat'] ?? '' ?></div>
                            </div>

                            <div class="mb-3">
                                <label>Jenis Kelamin</label><br>

                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="Laki-laki"
                                       <?= $jenis_kelamin == 'Laki-laki' ? 'checked' : '' ?>>
                                Laki-laki

                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="Perempuan"
                                       <?= $jenis_kelamin == 'Perempuan' ? 'checked' : '' ?>>
                                Perempuan

                                <div class="text-danger"><?= $errors['jenis_kelamin'] ?? '' ?></div>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date"
                                       name="tanggal_lahir"
                                       class="form-control <?= isset($errors['tanggal_lahir']) ? 'is-invalid' : '' ?>"
                                       value="<?= $tanggal_lahir ?>">
                                <div class="invalid-feedback"><?= $errors['tanggal_lahir'] ?? '' ?></div>
                            </div>

                            <div class="mb-3">
                                <label>Pekerjaan</label>
                                <select name="pekerjaan"
                                        class="form-select <?= isset($errors['pekerjaan']) ? 'is-invalid' : '' ?>">
                                    <option value="">-- pilih --</option>
                                    <option <?= $pekerjaan == 'Pelajar' ? 'selected' : '' ?>>Pelajar</option>
                                    <option <?= $pekerjaan == 'Mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                                    <option <?= $pekerjaan == 'Pegawai' ? 'selected' : '' ?>>Pegawai</option>
                                    <option <?= $pekerjaan == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                </select>
                                <div class="invalid-feedback"><?= $errors['pekerjaan'] ?? '' ?></div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary w-100">Daftar</button>

                                <button type="button"
                                        class="btn btn-outline-secondary w-100"
                                        onclick="window.location.href=window.location.pathname">
                                    Reset
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>