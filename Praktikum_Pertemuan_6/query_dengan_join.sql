-- Tampilkan transaksi dengan detail buku dan anggota
SELECT 
    t.id_transaksi,
    b.judul as nama_buku,
    a.nama as nama_anggota,
    t.tanggal_pinjam,
    t.tanggal_harus_kembali,
    t.status
FROM transaksi t
JOIN buku b ON t.id_buku = b.id_buku
JOIN anggota a ON t.id_anggota = a.id_anggota;