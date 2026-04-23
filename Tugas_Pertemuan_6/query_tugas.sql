-- FILE   : query_tugas.sql
-- DATABASE: perpustakaan
-- DESKRIPSI: Query tugas praktikum pertemuan 6
USE perpustakaan;

-- 1. STATISTIK BUKU

-- 1a. Total buku seluruhnya
SELECT COUNT(*) AS total_buku
FROM buku
WHERE is_deleted = 0;

-- 1b. Total nilai inventaris (sum harga × stok)
SELECT SUM(harga * stok) AS total_nilai_inventaris
FROM buku
WHERE is_deleted = 0;

-- 1c. Rata-rata harga buku
SELECT ROUND(AVG(harga), 2) AS rata_rata_harga
FROM buku
WHERE is_deleted = 0;

-- 1d. Buku termahal (tampilkan judul dan harga)
SELECT judul, harga
FROM buku
WHERE is_deleted = 0
ORDER BY harga DESC
LIMIT 1;

-- 1e. Buku dengan stok terbanyak
SELECT judul, stok
FROM buku
WHERE is_deleted = 0
ORDER BY stok DESC
LIMIT 1;

-- 2. FILTER DAN PENCARIAN

-- 2a. Semua buku kategori Programming dengan harga < 100.000
SELECT kode_buku, judul, pengarang, harga, stok
FROM buku
WHERE is_deleted = 0
  AND kategori = 'Programming'
  AND harga < 100000;

-- 2b. Buku yang judulnya mengandung kata "PHP" atau "MySQL"
SELECT kode_buku, judul, kategori, pengarang, harga
FROM buku
WHERE is_deleted = 0
  AND (judul LIKE '%PHP%' OR judul LIKE '%MySQL%');

-- 2c. Buku yang terbit tahun 2024
SELECT kode_buku, judul, kategori, pengarang, tahun_terbit
FROM buku
WHERE is_deleted = 0
  AND tahun_terbit = 2024;

-- 2d. Buku yang stoknya antara 5-10
SELECT kode_buku, judul, kategori, stok
FROM buku
WHERE is_deleted = 0
  AND stok BETWEEN 5 AND 10;

-- 2e. Buku yang pengarangnya "Budi Raharjo"
SELECT kode_buku, judul, kategori, tahun_terbit, harga, stok
FROM buku
WHERE is_deleted = 0
  AND pengarang = 'Budi Raharjo';

-- 3. GROUPING DAN AGREGASI

-- 3a. Jumlah buku per kategori beserta total stok per kategori
SELECT
    kategori,
    COUNT(*)        AS jumlah_buku,
    SUM(stok)       AS total_stok
FROM buku
WHERE is_deleted = 0
GROUP BY kategori
ORDER BY jumlah_buku DESC;

-- 3b. Rata-rata harga per kategori
SELECT
    kategori,
    ROUND(AVG(harga), 2) AS rata_rata_harga
FROM buku
WHERE is_deleted = 0
GROUP BY kategori
ORDER BY rata_rata_harga DESC;

-- 3c. Kategori dengan total nilai inventaris terbesar
SELECT
    kategori,
    SUM(harga * stok) AS total_nilai_inventaris
FROM buku
WHERE is_deleted = 0
GROUP BY kategori
ORDER BY total_nilai_inventaris DESC
LIMIT 1;

-- 4. UPDATE DATA

-- 4a. Naikkan harga semua buku kategori Programming sebesar 5%
UPDATE buku
SET harga = harga * 1.05
WHERE kategori = 'Programming'
  AND is_deleted = 0;

-- Verifikasi hasil update 4a
SELECT kode_buku, judul, kategori, harga
FROM buku
WHERE kategori = 'Programming'
  AND is_deleted = 0;

-- 4b. Tambah stok 10 untuk semua buku yang stoknya < 5
UPDATE buku
SET stok = stok + 10
WHERE stok < 5
  AND is_deleted = 0;

-- Verifikasi hasil update 4b
SELECT kode_buku, judul, stok
FROM buku
WHERE is_deleted = 0
ORDER BY stok ASC;

-- 5. LAPORAN KHUSUS

-- 5a. Daftar buku yang perlu restocking (stok < 5)
SELECT
    kode_buku,
    judul,
    kategori,
    pengarang,
    stok
FROM buku
WHERE is_deleted = 0
  AND stok < 5
ORDER BY stok ASC;

-- 5b. Top 5 buku termahal
SELECT
    kode_buku,
    judul,
    kategori,
    pengarang,
    harga
FROM buku
WHERE is_deleted = 0
ORDER BY harga DESC
LIMIT 5;

-- END OF FILE