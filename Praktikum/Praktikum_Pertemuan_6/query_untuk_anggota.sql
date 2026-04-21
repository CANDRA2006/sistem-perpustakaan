-- Semua anggota aktif
SELECT * FROM anggota WHERE status = 'Aktif';
 
-- Anggota perempuan
SELECT * FROM anggota WHERE jenis_kelamin = 'Perempuan';
 
-- Anggota mahasiswa
SELECT * FROM anggota WHERE pekerjaan = 'Mahasiswa';
 
-- Hitung anggota per pekerjaan
SELECT pekerjaan, COUNT(*) as jumlah 
FROM anggota 
GROUP BY pekerjaan;
 
-- Anggota terdaftar bulan Februari
SELECT * FROM anggota 
WHERE MONTH(tanggal_daftar) = 2 AND YEAR(tanggal_daftar) = 2024;
 
-- Hitung umur anggota
SELECT 
    nama,
    tanggal_lahir,
    YEAR(CURDATE()) - YEAR(tanggal_lahir) as umur
FROM anggota;
d. Buat Tabel Transaksi (Preview untuk pertemuan selanjutnya)

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE,
    tanggal_harus_kembali DATE NOT NULL,
    status ENUM('Dipinjam', 'Dikembalikan', 'Terlambat') DEFAULT 'Dipinjam',
    denda DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku),
    FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
);