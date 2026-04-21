CREATE TABLE anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    kode_anggota VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telepon VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    pekerjaan VARCHAR(50),
    tanggal_daftar DATE NOT NULL,
    status ENUM('Aktif', 'Nonaktif') DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);