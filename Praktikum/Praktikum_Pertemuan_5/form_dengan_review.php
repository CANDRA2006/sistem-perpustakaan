<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form dengan Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Input Buku</h5>
                    </div>
                    <div class="card-body">
                        <form id="bukuForm">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="judul" placeholder="Masukkan judul buku">
                            </div>
                            
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori">
                                    <option value="">-- Pilih --</option>
                                    <option value="Programming">Programming</option>
                                    <option value="Database">Database</option>
                                    <option value="Web Design">Web Design</option>
                                    <option value="Networking">Networking</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" class="form-control" id="pengarang" placeholder="Nama pengarang">
                            </div>
                            
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" id="penerbit" placeholder="Nama penerbit">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="number" class="form-control" id="tahun" min="1900" max="<?php echo date('Y'); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" id="harga" min="10000" step="1000">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" min="0">
                            </div>
                            
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3"></textarea>
                            </div>
                            
                            <button type="button" class="btn btn-primary w-100" onclick="updatePreview()">
                                <i class="bi bi-eye"></i> Update Preview
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-eye"></i> Preview Data Buku</h5>
                    </div>
                    <div class="card-body">
                        <div id="preview">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Isi form di sebelah kiri dan klik "Update Preview" untuk melihat hasil.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function updatePreview() {
        // Ambil nilai dari form
        var judul = document.getElementById('judul').value;
        var kategori = document.getElementById('kategori').value;
        var pengarang = document.getElementById('pengarang').value;
        var penerbit = document.getElementById('penerbit').value;
        var tahun = document.getElementById('tahun').value;
        var harga = document.getElementById('harga').value;
        var stok = document.getElementById('stok').value;
        var deskripsi = document.getElementById('deskripsi').value;
        
        // Format harga
        var hargaFormat = harga ? 'Rp ' + parseInt(harga).toLocaleString('id-ID') : '-';
        
        // Tentukan badge kategori
        var badgeColor = 'secondary';
        if (kategori === 'Programming') badgeColor = 'primary';
        else if (kategori === 'Database') badgeColor = 'success';
        else if (kategori === 'Web Design') badgeColor = 'info';
        else if (kategori === 'Networking') badgeColor = 'warning';
        
        // Buat HTML preview
        var html = '<div class="card">';
        html += '<div class="card-header bg-primary text-white">';
        html += '<h5 class="mb-0">' + (judul || '(Judul Belum Diisi)') + '</h5>';
        html += '</div>';
        html += '<div class="card-body">';
        html += '<table class="table table-borderless">';
        html += '<tr><th width="120">Kategori</th><td>: <span class="badge bg-' + badgeColor + '">' + (kategori || '-') + '</span></td></tr>';
        html += '<tr><th>Pengarang</th><td>: ' + (pengarang || '-') + '</td></tr>';
        html += '<tr><th>Penerbit</th><td>: ' + (penerbit || '-') + '</td></tr>';
        html += '<tr><th>Tahun</th><td>: ' + (tahun || '-') + '</td></tr>';
        html += '<tr><th>Harga</th><td>: ' + hargaFormat + '</td></tr>';
        html += '<tr><th>Stok</th><td>: ' + (stok || '0') + ' buku</td></tr>';
        html += '</table>';
        
        if (deskripsi) {
            html += '<hr>';
            html += '<h6>Deskripsi:</h6>';
            html += '<p>' + deskripsi + '</p>';
        }
        
        html += '</div>';
        html += '</div>';
        
        // Update preview
        document.getElementById('preview').innerHTML = html;
    }
    
    // Auto update preview saat user mengetik (optional)
    document.querySelectorAll('#bukuForm input, #bukuForm select, #bukuForm textarea').forEach(function(element) {
        element.addEventListener('input', updatePreview);
        element.addEventListener('change', updatePreview);
    });
    </script>
</body>
</html>