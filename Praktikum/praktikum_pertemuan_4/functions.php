<?php
// ========== LIBRARY FUNCTIONS PERPUSTAKAAN ==========
 
// 1. Format Rupiah
function format_rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
 
// 2. Hitung Total Stok
function hitung_total_stok($buku_list) {
    $total = 0;
    foreach ($buku_list as $buku) {
        $total += $buku["stok"];
    }
    return $total;
}
 
// 3. Hitung Total Nilai Inventaris
function hitung_total_nilai($buku_list) {
    $total = 0;
    foreach ($buku_list as $buku) {
        $total += ($buku["harga"] * $buku["stok"]);
    }
    return $total;
}
 
// 4. Hitung Rata-rata Harga
function hitung_rata_rata_harga($buku_list) {
    if (count($buku_list) == 0) return 0;
    
    $total_harga = 0;
    foreach ($buku_list as $buku) {
        $total_harga += $buku["harga"];
    }
    return $total_harga / count($buku_list);
}
 
// 5. Cari Buku Termahal
function cari_buku_termahal($buku_list) {
    if (count($buku_list) == 0) return null;
    
    $termahal = $buku_list[0];
    foreach ($buku_list as $buku) {
        if ($buku["harga"] > $termahal["harga"]) {
            $termahal = $buku;
        }
    }
    return $termahal;
}
 
// 6. Cari Buku Termurah
function cari_buku_termurah($buku_list) {
    if (count($buku_list) == 0) return null;
    
    $termurah = $buku_list[0];
    foreach ($buku_list as $buku) {
        if ($buku["harga"] < $termurah["harga"]) {
            $termurah = $buku;
        }
    }
    return $termurah;
}
 
// 7. Hitung Jumlah by Kategori
function hitung_by_kategori($buku_list, $kategori) {
    $count = 0;
    foreach ($buku_list as $buku) {
        if ($buku["kategori"] == $kategori) {
            $count++;
        }
    }
    return $count;
}
 
// 8. Hitung Persentase Stok Tersedia
function hitung_persentase_tersedia($buku_list) {
    if (count($buku_list) == 0) return 0;
    
    $tersedia = 0;
    foreach ($buku_list as $buku) {
        if ($buku["stok"] > 0) {
            $tersedia++;
        }
    }
    return ($tersedia / count($buku_list)) * 100;
}
 
// 9. Filter Buku by Stok Minimum
function filter_stok_minimum($buku_list, $min_stok) {
    $hasil = [];
    foreach ($buku_list as $buku) {
        if ($buku["stok"] >= $min_stok) {
            $hasil[] = $buku;
        }
    }
    return $hasil;
}
 
// 10. Sort Buku by Harga
function sort_by_harga($buku_list, $ascending = true) {
    $sorted = $buku_list;
    
    for ($i = 0; $i < count($sorted) - 1; $i++) {
        for ($j = 0; $j < count($sorted) - $i - 1; $j++) {
            if ($ascending) {
                if ($sorted[$j]["harga"] > $sorted[$j + 1]["harga"]) {
                    $temp = $sorted[$j];
                    $sorted[$j] = $sorted[$j + 1];
                    $sorted[$j + 1] = $temp;
                }
            } else {
                if ($sorted[$j]["harga"] < $sorted[$j + 1]["harga"]) {
                    $temp = $sorted[$j];
                    $sorted[$j] = $sorted[$j + 1];
                    $sorted[$j + 1] = $temp;
                }
            }
        }
    }
    
    return $sorted;
}
 
// 11. Generate Laporan Statistik
function generate_laporan($buku_list) {
    return [
        "total_judul" => count($buku_list),
        "total_stok" => hitung_total_stok($buku_list),
        "total_nilai" => hitung_total_nilai($buku_list),
        "rata_rata_harga" => hitung_rata_rata_harga($buku_list),
        "buku_termahal" => cari_buku_termahal($buku_list),
        "buku_termurah" => cari_buku_termurah($buku_list),
        "persentase_tersedia" => hitung_persentase_tersedia($buku_list)
    ];
}
 
// 12. Validasi Data Buku
function validasi_buku($buku) {
    $errors = [];
    
    if (empty($buku["judul"])) {
        $errors[] = "Judul tidak boleh kosong";
    }
    
    if (empty($buku["pengarang"])) {
        $errors[] = "Pengarang tidak boleh kosong";
    }
    
    if (!isset($buku["harga"]) || $buku["harga"] < 0) {
        $errors[] = "Harga tidak valid";
    }
    
    if (!isset($buku["stok"]) || $buku["stok"] < 0) {
        $errors[] = "Stok tidak valid";
    }
    
    return $errors;
}
?>