<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: linear-gradient(to right, #f4f4f4, #e8f5e9);
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2c3e50;
            border-bottom: 3px solid #27ae60;
            padding-bottom: 10px;
        }

        .info {
            background: #e8f5e9;
            border-left: 5px solid #27ae60;
            padding: 15px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .server {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .perpus {
            background: #e3f2fd;
            border-left: 5px solid #2196f3;
            padding: 15px;
            margin: 15px 0;
            border-radius: 6px;
        }

        p {
            margin: 6px 0;
        }

        .highlight {
            font-weight: bold;
            color: #27ae60;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>🏛️ Sistem Manajemen Perpustakaan</h1>

    <div class="info">
        <h3>Selamat Datang!</h3>
        <p><strong>Dibuat oleh:</strong> Candra Sya'bana Putra Gunadi</p>
        <p><strong>Tanggal:</strong> <?php echo date('d F Y'); ?></p>
        <p><strong>Waktu Server:</strong> <?php echo date('H:i:s'); ?></p>
    </div>

    <div class="server">
        <h3>Informasi Server</h3>
        <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
        <p><strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
        <p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT']; ?></p>
    </div>

    <?php
    // Data statis
    $nama_perpus   = "Perpustakaan UIN K.H. Abdurahman Wahid Pekalongan";

    $alamat_perpus = "Kampus 1: Jl. Kusuma Bangsa No.9 Kota Pekalongan 51141\n
                    Kampus 2: Jl. Pahlawan Km.5 Rowolaku Kajen Kab. Pekalongan 51161";

    $telepon_perpus = "085876130901";

    $jam_operasional = "Senin-Kamis : 08.00 - 19.00\n
                        Jum'at : 09.00 - 16.00";

    $total_buku    = 1250;
    $total_anggota = 450;
    $buku_dipinjam = 178;

    $buku_tersedia = $total_buku - $buku_dipinjam;

    // Persentase buku tersedia
    $persen_tersedia = round(($buku_tersedia / $total_buku) * 100, 1);
    ?>

    <div class="info">
        <h3>📊 Statistik <?php echo $nama_perpus; ?></h3>
        <p><strong>Total Buku:</strong> <?php echo number_format($total_buku); ?> buku</p>
        <p><strong>Total Anggota:</strong> <?php echo number_format($total_anggota); ?> orang</p>
        <p><strong>Sedang Dipinjam:</strong> <?php echo $buku_dipinjam; ?> buku</p>
        <p>
            <strong>Tersedia:</strong> 
            <?php echo number_format($buku_tersedia); ?> buku 
            (<span class="highlight"><?php echo $persen_tersedia; ?>%</span>)
        </p>
    </div>

    <div class="perpus">
        <h3>📚 Informasi Perpustakaan</h3>
        <p><strong>Alamat:</strong><br>
            <?php echo nl2br($alamat_perpus); ?>
        </p>

        <p><strong>Telepon:</strong> 
            <?php echo $telepon_perpus; ?>
        </p>

        <p><strong>Jam Operasional:</strong><br>
            <?php echo nl2br($jam_operasional); ?>
        </p>

        <p><strong>Hari Libur:</strong> Sabtu – Minggu</p>
    </div>

</div>

</body>
</html>