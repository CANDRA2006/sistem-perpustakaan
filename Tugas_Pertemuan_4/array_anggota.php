<?php
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "gmail" => "budi@gmail.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjaman" => 5
    ],
    [
        "id" => "AGT-002",
        "nama" => "Lamine Yamal",
        "gmail" => "yamal@gmail.com",
        "telepon" => "081298765432",
        "alamat" => "Pekalongan",
        "tanggal_daftar" => "2022-02-10",
        "status" => "Aktif",
        "total_pinjaman" => 8
    ],
    [
        "id" => "AGT-003",
        "nama" => "Jack Dodo",
        "gmail" => "jack@gmail.com",
        "telepon" => "081345678901",
        "alamat" => "Solo",
        "tanggal_daftar" => "2020-03-05",
        "status" => "Non-Aktif",
        "total_pinjaman" => 2
    ],
    [
        "id" => "AGT-004",
        "nama" => "Pedri Gonzales",
        "gmail" => "pedri@gmail.com",
        "telepon" => "089644869711",
        "alamat" => "Semarang",
        "tanggal_daftar" => "2024-01-20",
        "status" => "Aktif",
        "total_pinjaman" => 10
    ],
    [
        "id" => "AGT-005",
        "nama" => "Rizky Pratama",
        "gmail" => "rizky@gmail.com",
        "telepon" => "081998877665",
        "alamat" => "Semarang",
        "tanggal_daftar" => "2024-02-25",
        "status" => "Non-Aktif",
        "total_pinjaman" => 1
    ]
];

// Total anggota
$total_anggota = count($anggota_list);

// Hitung aktif & non-aktif
$aktif = 0;
$non_aktif = 0;
$total_pinjaman_semua = 0;
$anggota_teraktif = $anggota_list[0];

foreach ($anggota_list as $anggota) {
    if ($anggota["status"] == "Aktif") {
        $aktif++;
    } else {
        $non_aktif++;
    }

    $total_pinjaman_semua += $anggota["total_pinjaman"];

    // Cari anggota dengan pinjaman terbanyak
    if ($anggota["total_pinjaman"] > $anggota_teraktif["total_pinjaman"]) {
        $anggota_teraktif = $anggota;
    }
}

// Persentase
$persen_aktif = ($aktif / $total_anggota) * 100;
$persen_nonaktif = ($non_aktif / $total_anggota) * 100;

// Rata-rata pinjaman
$rata_pinjaman = $total_pinjaman_semua / $total_anggota;

// Filter (optional)
$status_filter = $_GET['status'] ?? "Semua";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">📚 Data Anggota Perpustakaan</h2>

    <!-- FILTER -->
    <form method="GET" class="mb-4">
        <select name="status" class="form-select w-25 d-inline">
            <option value="Semua">Semua</option>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
        </select>
        <button class="btn btn-primary">Filter</button>
    </form>

    <!-- STATISTIK CARDS -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5>Total Anggota</h5>
                    <h3><?= $total_anggota ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5>Aktif</h5>
                    <h3><?= round($persen_aktif, 1) ?>%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5>Non-Aktif</h5>
                    <h3><?= round($persen_nonaktif, 1) ?>%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5>Rata Pinjaman</h5>
                    <h3><?= round($rata_pinjaman, 2) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- ANGGOTA TERAKTIF -->
    <div class="alert alert-info">
        <strong>Anggota Teraktif:</strong>
        <?= $anggota_teraktif["nama"] ?> (<?= $anggota_teraktif["total_pinjaman"] ?> pinjaman)
    </div>

    <!-- TABEL -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>gmail</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Total Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anggota_list as $anggota): ?>
                <?php if ($status_filter == "Semua" || $anggota["status"] == $status_filter): ?>
                <tr>
                    <td><?= $anggota["id"] ?></td>
                    <td><?= $anggota["nama"] ?></td>
                    <td><?= $anggota["gmail"] ?></td>
                    <td><?= $anggota["telepon"] ?></td>
                    <td><?= $anggota["alamat"] ?></td>
                    <td><?= $anggota["tanggal_daftar"] ?></td>
                    <td>
                        <span class="badge <?= $anggota["status"] == 'Aktif' ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $anggota["status"] ?>
                        </span>
                    </td>
                    <td><?= $anggota["total_pinjaman"] ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>