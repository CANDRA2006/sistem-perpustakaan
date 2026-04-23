-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2026 at 11:53 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int NOT NULL,
  `kode_anggota` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` enum('Aktif','Nonaktif') COLLATE utf8mb4_unicode_ci DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `kode_anggota`, `nama`, `email`, `telepon`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `tanggal_daftar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AGT-001', 'Budi Santoso', 'budi.santoso@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '1995-05-15', 'Laki-laki', 'Mahasiswa', '2024-01-10', 'Aktif', '2026-04-21 13:03:16', '2026-04-21 13:03:16'),
(2, 'AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com', '081234567891', 'Jl. Sudirman No. 25, Bandung', '1998-08-20', 'Perempuan', 'Pegawai', '2024-01-15', 'Aktif', '2026-04-21 13:03:16', '2026-04-21 13:03:16'),
(3, 'AGT-003', 'Ahmad Dhani', 'ahmad.dhani@email.com', '081234567892', 'Jl. Gatot Subroto No. 5, Surabaya', '1992-03-10', 'Laki-laki', 'Pegawai', '2024-02-01', 'Aktif', '2026-04-21 13:03:16', '2026-04-21 13:03:16'),
(4, 'AGT-004', 'Dewi Lestari', 'dewi.lestari@email.com', '081234567893', 'Jl. Ahmad Yani No. 30, Yogyakarta', '2000-12-05', 'Perempuan', 'Mahasiswa', '2024-02-10', 'Aktif', '2026-04-21 13:03:16', '2026-04-21 13:03:16'),
(5, 'AGT-005', 'Rizky Febian', 'rizky.feb@email.com', '081234567894', 'Jl. Diponegoro No. 15, Semarang', '1997-07-18', 'Laki-laki', 'Pelajar', '2024-02-15', 'Nonaktif', '2026-04-21 13:03:16', '2026-04-21 13:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `kode_buku` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('Programming','Database','Web Design','Networking') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int NOT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul`, `kategori`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `harga`, `stok`, `deskripsi`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'BK-001', 'Pemrograman PHP untuk Pemula', 'Programming', 'Budi Raharjo', 'Informatika', 2023, '978-602-1234-56-1', 93500.00, 20, 'Buku panduan PHP terbaru edisi revisi', '2026-04-21 12:22:18', '2026-04-21 12:55:39', 0),
(2, 'BK-002', 'Mastering MySQL Database', 'Database', 'Andi Nugroho', 'Graha Ilmu', 2022, '978-602-1234-56-2', 104500.00, 5, 'Panduan komprehensif administrasi dan optimasi MySQL', '2026-04-21 12:22:18', '2026-04-21 12:55:39', 0),
(3, 'BK-003', 'Laravel Framework Advanced', 'Programming', 'Siti Aminah', 'Informatika', 2024, '978-602-1234-56-3', 125000.00, 13, 'Teknik advanced development dengan Laravel framework', '2026-04-21 12:22:18', '2026-04-21 12:53:51', 0),
(4, 'BK-004', 'Web Design Principles', 'Web Design', 'Dedi Santoso', 'Andi', 2023, '978-602-1234-56-4', 93500.00, 15, 'Prinsip dan best practice dalam desain web modern', '2026-04-21 12:22:18', '2026-04-21 12:55:39', 0),
(6, 'BK-006', 'PHP Web Services', 'Programming', 'Budi Raharjo', 'Informatika', 2024, '978-602-1234-56-6', 90000.00, 17, 'Membangun RESTful API dengan PHP', '2026-04-21 12:22:18', '2026-04-21 12:53:51', 0),
(7, 'BK-007', 'PostgreSQL Advanced', 'Database', 'Ahmad Yani', 'Graha Ilmu', 2024, '978-602-1234-56-7', 115000.00, 7, 'Teknik advanced PostgreSQL untuk enterprise', '2026-04-21 12:22:18', '2026-04-21 12:22:18', 0),
(9, 'BK-008', 'JavaScript Modern', 'Programming', 'Siti Aminah', 'Informatika', 2023, NULL, 80000.00, 5, NULL, '2026-04-21 12:59:19', '2026-04-21 13:00:22', 1),
(10, 'BK-009', 'React Native Development', 'Programming', 'Ahmad Yani', 'Informatika', 2024, NULL, 135000.00, 10, NULL, '2026-04-21 12:59:19', '2026-04-21 12:59:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_buku` int NOT NULL,
  `id_anggota` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_harus_kembali` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') COLLATE utf8mb4_unicode_ci DEFAULT 'Dipinjam',
  `denda` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_buku`, `id_anggota`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_harus_kembali`, `status`, `denda`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-02-01', NULL, '2024-02-08', 'Dipinjam', 0.00, '2026-04-21 13:07:37', '2026-04-21 13:07:37'),
(2, 2, 2, '2024-02-03', NULL, '2024-02-10', 'Dipinjam', 0.00, '2026-04-21 13:07:37', '2026-04-21 13:07:37'),
(3, 3, 1, '2024-01-25', NULL, '2024-02-01', 'Dikembalikan', 0.00, '2026-04-21 13:07:37', '2026-04-21 13:07:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `kode_anggota` (`kode_anggota`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
