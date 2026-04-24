DROP DATABASE IF EXISTS perpustakaan_lengkap;
CREATE DATABASE perpustakaan_lengkap
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE perpustakaan_lengkap;

-- 1. TABEL KATEGORI_BUKU

CREATE TABLE kategori_buku (
  id_kategori   INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(50)  NOT NULL UNIQUE,
  deskripsi     TEXT,
  is_deleted    TINYINT(1)   NOT NULL DEFAULT 0,
  created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 2. TABEL PENERBIT

CREATE TABLE penerbit (
  id_penerbit   INT AUTO_INCREMENT PRIMARY KEY,
  nama_penerbit VARCHAR(100) NOT NULL,
  alamat        TEXT,
  telepon       VARCHAR(15),
  email         VARCHAR(100),
  is_deleted    TINYINT(1)   NOT NULL DEFAULT 0,
  created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 3. TABEL RAK 

CREATE TABLE rak (
  id_rak     INT AUTO_INCREMENT PRIMARY KEY,
  kode_rak   VARCHAR(10)  NOT NULL UNIQUE,
  lokasi     VARCHAR(100) NOT NULL,
  kapasitas  INT          NOT NULL DEFAULT 50,
  is_deleted TINYINT(1)   NOT NULL DEFAULT 0,
  created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 4. TABEL BUKU (MODIFIKASI + SOFT DELETE + RELASI RAK)

CREATE TABLE buku (
  id_buku       INT AUTO_INCREMENT PRIMARY KEY,
  kode_buku     VARCHAR(20)    NOT NULL UNIQUE,
  judul         VARCHAR(200)   NOT NULL,
  id_kategori   INT            NOT NULL,
  id_penerbit   INT            NOT NULL,
  id_rak        INT            DEFAULT NULL,
  pengarang     VARCHAR(100)   NOT NULL,
  tahun_terbit  INT            NOT NULL,
  isbn          VARCHAR(20)    DEFAULT NULL,
  harga         DECIMAL(10,2)  NOT NULL,
  stok          INT            NOT NULL DEFAULT 0,
  deskripsi     TEXT,
  is_deleted    TINYINT(1)     NOT NULL DEFAULT 0,
  created_at    TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP      DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_buku_kategori FOREIGN KEY (id_kategori) REFERENCES kategori_buku(id_kategori),
  CONSTRAINT fk_buku_penerbit FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit),
  CONSTRAINT fk_buku_rak      FOREIGN KEY (id_rak)      REFERENCES rak(id_rak)
);


-- 5. TABEL ANGGOTA

CREATE TABLE anggota (
  id_anggota     INT AUTO_INCREMENT PRIMARY KEY,
  kode_anggota   VARCHAR(20)  NOT NULL UNIQUE,
  nama           VARCHAR(100) NOT NULL,
  email          VARCHAR(100) NOT NULL UNIQUE,
  telepon        VARCHAR(15)  NOT NULL,
  alamat         TEXT         NOT NULL,
  tanggal_lahir  DATE         NOT NULL,
  jenis_kelamin  ENUM('Laki-laki','Perempuan') NOT NULL,
  pekerjaan      VARCHAR(50)  DEFAULT NULL,
  tanggal_daftar DATE         NOT NULL,
  status         ENUM('Aktif','Nonaktif') DEFAULT 'Aktif',
  is_deleted     TINYINT(1)   NOT NULL DEFAULT 0,
  created_at     TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  updated_at     TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 6. TABEL TRANSAKSI

CREATE TABLE transaksi (
  id_transaksi          INT AUTO_INCREMENT PRIMARY KEY,
  id_buku               INT           NOT NULL,
  id_anggota            INT           NOT NULL,
  tanggal_pinjam        DATE          NOT NULL,
  tanggal_kembali       DATE          DEFAULT NULL,
  tanggal_harus_kembali DATE          NOT NULL,
  status                ENUM('Dipinjam','Dikembalikan','Terlambat') DEFAULT 'Dipinjam',
  denda                 DECIMAL(10,2) DEFAULT 0.00,
  is_deleted            TINYINT(1)    NOT NULL DEFAULT 0,
  created_at            TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
  updated_at            TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_transaksi_buku    FOREIGN KEY (id_buku)    REFERENCES buku(id_buku),
  CONSTRAINT fk_transaksi_anggota FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
);


-- INSERT DATA: KATEGORI BUKU (7 kategori)

INSERT INTO kategori_buku (nama_kategori, deskripsi) VALUES
('Programming',  'Buku-buku tentang pemrograman dan pengembangan perangkat lunak'),
('Database',     'Buku-buku tentang basis data dan manajemen data'),
('Web Design',   'Buku-buku tentang desain dan pengembangan web'),
('Networking',   'Buku-buku tentang jaringan komputer dan keamanan'),
('Data Science', 'Buku-buku tentang analisis data, machine learning, dan AI'),
('Mobile Dev',   'Buku-buku tentang pengembangan aplikasi mobile'),
('DevOps',       'Buku-buku tentang DevOps, CI/CD, dan cloud computing');


-- INSERT DATA: PENERBIT (7 penerbit)

INSERT INTO penerbit (nama_penerbit, alamat, telepon, email) VALUES
('Informatika', 'Jl. Setiabudi No. 65, Bandung',         '022-2034207',      'info@informatika.co.id'),
('Graha Ilmu',  'Jl. Raden Saleh No. 1A, Yogyakarta',    '0274-515194',      'info@grahailmu.co.id'),
('Andi',        'Jl. Beo No. 38-40, Yogyakarta',         '0274-561881',      'info@andipublisher.com'),
('Elex Media',  'Jl. Palmerah Barat No. 29-33, Jakarta', '021-5305006',      'info@elexmedia.co.id'),
('Oreilly',     'Sebastopol, California, USA',           '+1-707-827-7000',  'info@oreilly.com'),
('Packt',       'Livery Place, Birmingham, UK',          '+44-121-2655-800', 'info@packtpub.com'),
('Deepublish',  'Jl. Rajawali No. 14, Yogyakarta',       '0274-560525',      'info@deepublish.co.id');


-- INSERT DATA: RAK (BONUS - 5 rak)

INSERT INTO rak (kode_rak, lokasi, kapasitas) VALUES
('RAK-A1', 'Lantai 1 - Sayap Kiri, Baris A',  40),
('RAK-A2', 'Lantai 1 - Sayap Kiri, Baris B',  40),
('RAK-B1', 'Lantai 1 - Sayap Kanan, Baris A', 50),
('RAK-B2', 'Lantai 1 - Sayap Kanan, Baris B', 50),
('RAK-C1', 'Lantai 2 - Ruang Referensi',       30);


-- INSERT DATA: BUKU (17 buku, relasi benar)

INSERT INTO buku (kode_buku, judul, id_kategori, id_penerbit, id_rak, pengarang, tahun_terbit, isbn, harga, stok, deskripsi) VALUES
('BK-001', 'Pemrograman PHP untuk Pemula',   1, 1, 1, 'Budi Raharjo',   2023, '978-602-1234-56-1',  93500.00, 20, 'Panduan PHP terbaru edisi revisi'),
('BK-002', 'Laravel Framework Advanced',     1, 1, 1, 'Siti Aminah',    2024, '978-602-1234-56-3', 125000.00, 13, 'Teknik advanced Laravel'),
('BK-003', 'PHP Web Services',               1, 1, 1, 'Budi Raharjo',   2024, '978-602-1234-56-6',  90000.00, 17, 'Membangun RESTful API dengan PHP'),
('BK-004', 'React Native Development',       1, 4, 2, 'Ahmad Yani',     2024, '978-602-1234-56-9', 135000.00, 10, 'Panduan lengkap React Native'),
('BK-005', 'Python untuk Data Science',      1, 5, 2, 'Dewi Kusuma',    2023, '978-602-1234-57-1', 145000.00,  8, 'Pengantar Python untuk analisis data'),
('BK-006', 'Mastering MySQL Database',       2, 2, 3, 'Andi Nugroho',   2022, '978-602-1234-56-2', 104500.00,  5, 'Panduan komprehensif administrasi MySQL'),
('BK-007', 'PostgreSQL Advanced',            2, 2, 3, 'Ahmad Yani',     2024, '978-602-1234-56-7', 115000.00,  7, 'Teknik advanced PostgreSQL'),
('BK-008', 'MongoDB in Action',              2, 5, 3, 'Rizky Pratama',  2023, '978-602-1234-58-1', 110000.00,  6, 'Panduan lengkap MongoDB NoSQL'),
('BK-009', 'Web Design Principles',          3, 3, 4, 'Dedi Santoso',   2023, '978-602-1234-56-4',  93500.00, 15, 'Prinsip desain web modern'),
('BK-010', 'CSS dan Tailwind Mastery',       3, 4, 4, 'Lina Marlina',   2024, '978-602-1234-59-1',  98000.00, 12, 'Menguasai CSS dan Tailwind'),
('BK-011', 'Jaringan Komputer Dasar',        4, 3, 5, 'Hendra Gunawan', 2022, '978-602-1234-60-1',  85000.00,  9, 'Konsep dasar jaringan komputer'),
('BK-012', 'Ethical Hacking dan Security',   4, 6, 5, 'Rizky Febian',   2024, '978-602-1234-61-1', 155000.00,  4, 'Panduan keamanan jaringan'),
('BK-013', 'Machine Learning dengan Python', 5, 5, 2, 'Dewi Kusuma',    2024, '978-602-1234-62-1', 165000.00,  6, 'Implementasi ML dengan Python'),
('BK-014', 'Data Visualization dengan R',    5, 7, 2, 'Bambang Wijaya', 2023, '978-602-1234-63-1', 120000.00,  3, 'Teknik visualisasi data dengan R'),
('BK-015', 'Flutter untuk Pemula',           6, 1, 1, 'Siti Aminah',    2024, '978-602-1234-64-1', 115000.00, 11, 'Pengembangan aplikasi mobile Flutter'),
('BK-016', 'Docker dan Kubernetes Praktis',  7, 6, 5, 'Ahmad Fauzi',    2024, '978-602-1234-65-1', 175000.00,  8, 'Containerisasi aplikasi modern'),
('BK-017', 'CICD dengan GitHub Actions',     7, 5, 5, 'Budi Raharjo',   2023, '978-602-1234-66-1', 130000.00,  5, 'Otomasi deployment dengan GitHub Actions');


-- INSERT DATA: ANGGOTA

INSERT INTO anggota (kode_anggota, nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, pekerjaan, tanggal_daftar, status) VALUES
('AGT-001', 'Budi Santoso',   'budi.santoso@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta',        '1995-05-15', 'Laki-laki', 'Mahasiswa', '2024-01-10', 'Aktif'),
('AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com',     '081234567891', 'Jl. Sudirman No. 25, Bandung',       '1998-08-20', 'Perempuan', 'Pegawai',   '2024-01-15', 'Aktif'),
('AGT-003', 'Ahmad Dhani',    'ahmad.dhani@email.com',  '081234567892', 'Jl. Gatot Subroto No. 5, Surabaya',  '1992-03-10', 'Laki-laki', 'Pegawai',   '2024-02-01', 'Aktif'),
('AGT-004', 'Dewi Lestari',   'dewi.lestari@email.com', '081234567893', 'Jl. Ahmad Yani No. 30, Yogyakarta',  '2000-12-05', 'Perempuan', 'Mahasiswa', '2024-02-10', 'Aktif'),
('AGT-005', 'Rizky Febian',   'rizky.feb@email.com',    '081234567894', 'Jl. Diponegoro No. 15, Semarang',    '1997-07-18', 'Laki-laki', 'Pelajar',   '2024-02-15', 'Nonaktif');


-- INSERT DATA: TRANSAKSI

INSERT INTO transaksi (id_buku, id_anggota, tanggal_pinjam, tanggal_kembali, tanggal_harus_kembali, status, denda) VALUES
(1,  1, '2024-02-01', NULL,         '2024-02-08', 'Dipinjam',     0.00),
(6,  2, '2024-02-03', NULL,         '2024-02-10', 'Dipinjam',     0.00),
(2,  1, '2024-01-25', '2024-02-01', '2024-02-01', 'Dikembalikan', 0.00),
(9,  3, '2024-03-01', '2024-03-10', '2024-03-08', 'Terlambat',    2000.00),
(13, 4, '2024-03-05', NULL,         '2024-03-12', 'Dipinjam',     0.00);


-- QUERY JOIN


-- Q1: Tampilkan buku dengan nama kategori dan penerbit
SELECT
    b.kode_buku,
    b.judul,
    k.nama_kategori,
    p.nama_penerbit,
    b.pengarang,
    b.tahun_terbit,
    b.harga,
    b.stok
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit      p ON b.id_penerbit  = p.id_penerbit
WHERE b.is_deleted = 0
ORDER BY k.nama_kategori, b.judul;

-- Q2: Jumlah buku per kategori
SELECT
    k.nama_kategori,
    COUNT(b.id_buku) AS jumlah_buku,
    SUM(b.stok)      AS total_stok
FROM kategori_buku k
LEFT JOIN buku b ON k.id_kategori = b.id_kategori AND b.is_deleted = 0
WHERE k.is_deleted = 0
GROUP BY k.id_kategori, k.nama_kategori
ORDER BY jumlah_buku DESC;

-- Q3: Jumlah buku per penerbit
SELECT
    p.nama_penerbit,
    COUNT(b.id_buku) AS jumlah_buku,
    SUM(b.stok)      AS total_stok
FROM penerbit p
LEFT JOIN buku b ON p.id_penerbit = b.id_penerbit AND b.is_deleted = 0
WHERE p.is_deleted = 0
GROUP BY p.id_penerbit, p.nama_penerbit
ORDER BY jumlah_buku DESC;

-- Q4: Detail lengkap buku (kategori + penerbit + rak)
SELECT
    b.kode_buku,
    b.judul,
    b.pengarang,
    k.nama_kategori,
    p.nama_penerbit,
    p.telepon   AS telepon_penerbit,
    r.kode_rak,
    r.lokasi    AS lokasi_rak,
    b.tahun_terbit,
    b.isbn,
    b.harga,
    b.stok
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit      p ON b.id_penerbit  = p.id_penerbit
LEFT JOIN rak      r ON b.id_rak       = r.id_rak
WHERE b.is_deleted = 0
ORDER BY b.kode_buku;


-- STORED PROCEDURE (BONUS)


DELIMITER $$

-- SP1: Tambah buku baru
CREATE PROCEDURE sp_tambah_buku(
    IN p_kode_buku    VARCHAR(20),
    IN p_judul        VARCHAR(200),
    IN p_id_kategori  INT,
    IN p_id_penerbit  INT,
    IN p_id_rak       INT,
    IN p_pengarang    VARCHAR(100),
    IN p_tahun_terbit INT,
    IN p_isbn         VARCHAR(20),
    IN p_harga        DECIMAL(10,2),
    IN p_stok         INT,
    IN p_deskripsi    TEXT
)
BEGIN
    INSERT INTO buku (kode_buku, judul, id_kategori, id_penerbit, id_rak,
                      pengarang, tahun_terbit, isbn, harga, stok, deskripsi)
    VALUES (p_kode_buku, p_judul, p_id_kategori, p_id_penerbit, p_id_rak,
            p_pengarang, p_tahun_terbit, p_isbn, p_harga, p_stok, p_deskripsi);
    SELECT LAST_INSERT_ID() AS id_buku_baru;
END$$

-- SP2: Soft delete buku
CREATE PROCEDURE sp_hapus_buku(IN p_id_buku INT)
BEGIN
    UPDATE buku SET is_deleted = 1 WHERE id_buku = p_id_buku;
    SELECT ROW_COUNT() AS rows_affected;
END$$

-- SP3: Cek status stok buku
CREATE PROCEDURE sp_cek_stok(IN p_kode_buku VARCHAR(20))
BEGIN
    SELECT
        b.kode_buku,
        b.judul,
        k.nama_kategori,
        b.stok,
        CASE
            WHEN b.stok = 0 THEN 'HABIS'
            WHEN b.stok < 5 THEN 'PERLU RESTOCK'
            ELSE 'STOK AMAN'
        END AS status_stok
    FROM buku b
    JOIN kategori_buku k ON b.id_kategori = k.id_kategori
    WHERE b.kode_buku = p_kode_buku AND b.is_deleted = 0;
END$$

DELIMITER ;

-- Contoh pemanggilan stored procedure:
CALL sp_cek_stok('BK-001');

-- END 