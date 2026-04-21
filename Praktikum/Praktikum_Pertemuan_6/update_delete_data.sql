-- ========== UPDATE ==========
 
-- 1. Update harga 1 buku
UPDATE buku 
SET harga = 80000 
WHERE kode_buku = 'BK-001';
 
-- Verifikasi
SELECT * FROM buku WHERE kode_buku = 'BK-001';
 
-- 2. Update multiple kolom
UPDATE buku 
SET 
    harga = 85000,
    stok = 15,
    deskripsi = 'Buku panduan PHP terbaru edisi revisi'
WHERE kode_buku = 'BK-001';
 
-- 3. Update dengan operasi matematika (tambah stok)
UPDATE buku 
SET stok = stok + 5 
WHERE kategori = 'Programming';
 
-- 4. Update berdasarkan kondisi
UPDATE buku 
SET harga = harga * 1.1 
WHERE tahun_terbit < 2024;
-- (Naikkan harga 10% untuk buku lama)
 
-- 5. Update semua (HATI-HATI!)
-- UPDATE buku SET stok = 10; 
-- Ini akan update SEMUA buku! Jangan jalankan kecuali sengaja
 
-- ========== DELETE ==========
 
-- 6. Delete 1 buku (by id)
DELETE FROM buku WHERE id_buku = 8;
 
-- Verifikasi
SELECT * FROM buku WHERE id_buku = 8;
-- Hasilnya empty
 
-- 7. Delete berdasarkan kondisi
-- Hapus buku yang stok = 0
DELETE FROM buku WHERE stok = 0;
 
-- 8. Delete dengan multiple kondisi
DELETE FROM buku 
WHERE kategori = 'Networking' AND stok < 5;
 
-- ========== RESTORE DATA ==========
-- Kalau sudah dihapus, insert lagi
 
INSERT INTO buku (kode_buku, judul, kategori, pengarang, penerbit, tahun_terbit, harga, stok) 
VALUES 
('BK-008', 'JavaScript Modern', 'Programming', 'Siti Aminah', 'Informatika', 2023, 80000, 5),
('BK-009', 'React Native Development', 'Programming', 'Ahmad Yani', 'Informatika', 2024, 135000, 10);
 
-- ========== SAFE DELETE (Soft Delete Simulation) ==========
-- Alternatif: Jangan delete, tapi tandai sebagai deleted
 
-- Tambah kolom is_deleted
ALTER TABLE buku 
ADD COLUMN is_deleted BOOLEAN DEFAULT FALSE;
 
-- "Delete" dengan update
UPDATE buku 
SET is_deleted = TRUE 
WHERE id_buku = 9;
 
-- Query hanya yang tidak deleted
SELECT * FROM buku WHERE is_deleted = FALSE;