INSERT INTO buku (kode_buku, judul, kategori, pengarang, penerbit, tahun_terbit, isbn, harga, stok, deskripsi) 
VALUES 
('BK-001', 'Pemrograman PHP untuk Pemula', 'Programming', 'Budi Raharjo', 'Informatika', 2023, '978-602-1234-56-1', 75000.00, 10, 'Buku panduan lengkap belajar PHP dari dasar hingga mahir'),
 
('BK-002', 'Mastering MySQL Database', 'Database', 'Andi Nugroho', 'Graha Ilmu', 2022, '978-602-1234-56-2', 95000.00, 5, 'Panduan komprehensif administrasi dan optimasi MySQL'),
 
('BK-003', 'Laravel Framework Advanced', 'Programming', 'Siti Aminah', 'Informatika', 2024, '978-602-1234-56-3', 125000.00, 8, 'Teknik advanced development dengan Laravel framework'),
 
('BK-004', 'Web Design Principles', 'Web Design', 'Dedi Santoso', 'Andi', 2023, '978-602-1234-56-4', 85000.00, 15, 'Prinsip dan best practice dalam desain web modern'),
 
('BK-005', 'Network Security Fundamentals', 'Networking', 'Rina Wijaya', 'Erlangga', 2023, '978-602-1234-56-5', 110000.00, 3, 'Dasar-dasar keamanan jaringan komputer'),
 
('BK-006', 'PHP Web Services', 'Programming', 'Budi Raharjo', 'Informatika', 2024, '978-602-1234-56-6', 90000.00, 12, 'Membangun RESTful API dengan PHP'),
 
('BK-007', 'PostgreSQL Advanced', 'Database', 'Ahmad Yani', 'Graha Ilmu', 2024, '978-602-1234-56-7', 115000.00, 7, 'Teknik advanced PostgreSQL untuk enterprise'),
 
('BK-008', 'JavaScript Modern', 'Programming', 'Siti Aminah', 'Informatika', 2023, '978-602-1234-56-8', 80000.00, 0, 'JavaScript ES6+ untuk web development modern');


-- VERIFIKASI
-- Lihat semua data
SELECT * FROM buku;
 
-- Hitung jumlah
SELECT COUNT(*) as total FROM buku;