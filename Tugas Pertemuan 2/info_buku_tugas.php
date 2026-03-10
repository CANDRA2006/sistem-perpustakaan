<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Informasi Buku</h1>

        <?php
        
        // BUKU 1
        $judul1 = "Laravel: From Beginner to Advanced";
        $pengarang1 = "Budi Raharjo";
        $penerbit1 = "Informatika";
        $tahun_terbit1 = 2023;
        $harga1 = 125000;
        $stok1 = 8;
        $isbn1 = "978-602-1234-56-7";
        $kategori1 = "Programming";
        $bahasa1 = "Indonesia";
        $halaman1 = 412;
        $berat1 = 620;
        ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul1; ?></h5>
            </div>
            <div class="card-body">
                <span class="badge bg-primary mb-3"><?php echo $kategori1; ?></span>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang1; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit1; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit1; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn1; ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>: <?php echo $kategori1; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa1; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman1; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat1; ?> gram</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga1, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok1; ?> buku</td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
        
        // BUKU 2
        $judul2 = "Dasar-dasar Kali Linux";
        $pengarang2 = "Dian Pratiwi";
        $penerbit2 = "Elex Media Komputindo";
        $tahun_terbit2 = 2022;
        $harga2 = 98000;
        $stok2 = 14;
        $isbn2 = "978-602-0422-31-5";
        $kategori2 = "Keamanan Siber";
        $bahasa2 = "Indonesia";
        $halaman2 = 360;
        $berat2 = 540;
        ?>

        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><?php echo $judul2; ?></h5>
            </div>
            <div class="card-body">
                <span class="badge bg-success mb-3"><?php echo $kategori2; ?></span>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang2; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit2; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit2; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn2; ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>: <?php echo $kategori2; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa2; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman2; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat2; ?> gram</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga2, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok2; ?> buku</td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
        
        // BUKU 3
        $judul3 = "Belajar Jadi Front-end Developer";
        $pengarang3 = "Joko Jack";
        $penerbit3 = "Solo Publisher";
        $tahun_terbit3 = 2019;
        $harga3 = 19000;
        $stok3 = 19;
        $isbn3 = "199-919-2946-12-3";
        $kategori3 = "Web Design";
        $bahasa3 = "Indonesia";
        $halaman3 = 190;
        $berat3 = 450;
        ?>

        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><?php echo $judul3; ?></h5>
            </div>
            <div class="card-body">
                <span class="badge bg-warning text-dark mb-3"><?php echo $kategori3; ?></span>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang3; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit3; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit3; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn3; ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>: <?php echo $kategori3; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa3; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman3; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat3; ?> gram</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga3, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok3; ?> buku</td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
        
        // BUKU 4
        $judul4 = "Python untuk Machine Learning";
        $pengarang4 = "Sania Najwa";
        $penerbit4 = "Gramedia";
        $tahun_terbit4 = 2022;
        $harga4 = 150000;
        $stok4 = 6;
        $isbn4 = "978-602-0605-88-1";
        $kategori4 = "Artificial Intelligence";
        $bahasa4 = "Indonesia";
        $halaman4 = 480;
        $berat4 = 700;
        ?>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><?php echo $judul4; ?></h5>
            </div>
            <div class="card-body">
                <span class="badge bg-danger mb-3"><?php echo $kategori4; ?></span>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang4; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit4; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit4; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn4; ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>: <?php echo $kategori4; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa4; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $halaman4; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat4; ?> gram</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga4, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok4; ?> buku</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
