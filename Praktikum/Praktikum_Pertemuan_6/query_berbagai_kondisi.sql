-- 1. Select semua buku
SELECT * FROM buku;
 
-- 2. Select kolom tertentu
SELECT judul, pengarang, harga FROM buku;
 
-- 3. Filter by kategori
SELECT * FROM buku WHERE kategori = 'Programming';
 
-- 4. Filter by harga
SELECT * FROM buku WHERE harga > 90000;
 
-- 5. Filter dengan AND
SELECT * FROM buku 
WHERE kategori = 'Programming' AND harga < 100000;
 
-- 6. Filter dengan OR
SELECT * FROM buku 
WHERE kategori = 'Programming' OR kategori = 'Database';
 
-- 7. Search judul (LIKE)
SELECT * FROM buku WHERE judul LIKE '%PHP%';
 
-- 8. Search pengarang
SELECT * FROM buku WHERE pengarang LIKE '%Budi%';
 
-- 9. Filter dengan IN
SELECT * FROM buku 
WHERE kategori IN ('Programming', 'Database');
 
-- 10. Filter range harga (BETWEEN)
SELECT * FROM buku 
WHERE harga BETWEEN 80000 AND 100000;
 
-- 11. Order by judul ASC
SELECT * FROM buku ORDER BY judul ASC;
 
-- 12. Order by harga DESC
SELECT * FROM buku ORDER BY harga DESC;
 
-- 13. Limit 5
SELECT * FROM buku LIMIT 5;
 
-- 14. Pagination (skip 3, ambil 3)
SELECT * FROM buku LIMIT 3 OFFSET 3;
 
-- 15. Count semua buku
SELECT COUNT(*) as total_buku FROM buku;
 
-- 16. Sum total stok
SELECT SUM(stok) as total_stok FROM buku;
 
-- 17. Average harga
SELECT AVG(harga) as rata_rata_harga FROM buku;
 
-- 18. Max & Min harga
SELECT MAX(harga) as termahal, MIN(harga) as termurah FROM buku;
 
-- 19. Group by kategori
SELECT kategori, COUNT(*) as jumlah 
FROM buku 
GROUP BY kategori;
 
-- 20. Group by kategori dengan sum stok
SELECT kategori, COUNT(*) as jumlah, SUM(stok) as total_stok 
FROM buku 
GROUP BY kategori 
ORDER BY jumlah DESC;
 
-- 21. Buku terbaru (tahun 2024)
SELECT * FROM buku WHERE tahun_terbit = 2024;
 
-- 22. Buku habis (stok = 0)
SELECT * FROM buku WHERE stok = 0;
 
-- 23. Buku tersedia (stok > 0)
SELECT * FROM buku WHERE stok > 0;
 
-- 24. Format harga dengan alias
SELECT 
    judul,
    CONCAT('Rp ', FORMAT(harga, 0)) as harga_format,
    stok
FROM buku;
 
-- 25. Complex query
SELECT 
    kode_buku as 'Kode',
    judul as 'Judul Buku',
    pengarang as 'Pengarang',
    kategori as 'Kategori',
    CONCAT('Rp ', FORMAT(harga, 0)) as 'Harga',
    stok as 'Stok',
    CASE 
        WHEN stok = 0 THEN 'Habis'
        WHEN stok < 5 THEN 'Menipis'
        ELSE 'Tersedia'
    END as 'Status'
FROM buku
ORDER BY harga DESC;