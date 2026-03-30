<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulasi String - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manipulasi String Judul Buku</h1>
        
        <?php
        // Data buku
        $judul = "pemrograman web dengan php dan mysql";
        $pengarang = "BUDI RAHARJO";
        $deskripsi = "Buku ini membahas pemrograman web menggunakan PHP dan MySQL secara lengkap dari dasar hingga mahir";
        ?>
        
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Data Original</h5>
            </div>
            <div class="card-body">
                <p><strong>Judul:</strong> <?php echo $judul; ?></p>
                <p><strong>Pengarang:</strong> <?php echo $pengarang; ?></p>
                <p><strong>Deskripsi:</strong> <?php echo $deskripsi; ?></p>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Hasil Manipulasi</h5>
            </div>
            <div class="card-body">
                <!-- strtoupper() -->
                <p><strong>Judul Uppercase:</strong><br />
                   <?php echo strtoupper($judul); ?></p>
                
                <!-- strtolower() -->
                <p><strong>Pengarang Lowercase:</strong><br />
                   <?php echo strtolower($pengarang); ?></p>
                
                <!-- ucwords() -->
                <p><strong>Judul Title Case:</strong><br />
                   <?php echo ucwords($judul); ?></p>
                
                <!-- ucfirst() -->
                <p><strong>Deskripsi First Capital:</strong><br />
                   <?php echo ucfirst($deskripsi); ?></p>
                
                <!-- strlen() -->
                <p><strong>Panjang Judul:</strong><br />
                   <?php echo strlen($judul); ?> karakter</p>
                
                <!-- str_word_count() -->
                <p><strong>Jumlah Kata Judul:</strong><br />
                   <?php echo str_word_count($judul); ?> kata</p>
                
                <!-- substr() -->
                <p><strong>20 Karakter Pertama Deskripsi:</strong><br />
                   <?php echo substr($deskripsi, 0, 20) . "..."; ?></p>
                
                <!-- str_replace() -->
                <p><strong>Replace "PHP" menjadi "PHP 8":</strong><br />
                   <?php echo str_replace("PHP", "PHP 8", $judul); ?></p>
                
                <!-- strpos() -->
                <p><strong>Posisi kata "web":</strong><br />
                   Posisi ke-<?php echo strpos($judul, "web"); ?></p>
                
                <!-- trim() -->
                <?php $judul_spasi = "  PHP Programming  "; ?>
                <p><strong>Trim Spasi:</strong><br />
                   Sebelum: "<?php echo $judul_spasi; ?>" (panjang: <?php echo strlen($judul_spasi); ?>)<br />
                   Sesudah: "<?php echo trim($judul_spasi); ?>" (panjang: <?php echo strlen(trim($judul_spasi)); ?>)</p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>