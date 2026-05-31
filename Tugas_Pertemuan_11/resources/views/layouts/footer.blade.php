<footer class="bg-light border-top">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-6">
                <h5><i class="bi bi-book-fill text-primary"></i> Sistem Perpustakaan</h5>
                <p class="text-muted mb-0">
                    Sistem Manajemen Perpustakaan menggunakan Laravel 12
                </p>
            </div>
            <div class="col-md-3">
                <h6>Menu</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li><a href="{{ route('buku.index') }}" class="text-decoration-none">Buku</a></li>
                    <li><a href="{{ route('anggota.index') }}" class="text-decoration-none">Anggota</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Kontak</h6>
                <p class="text-muted small mb-0">
                    <i class="bi bi-envelope"></i> perpustakaan@example.com<br />
                    <i class="bi bi-telephone"></i> (021) 1234-5678
                </p>
            </div>
        </div>
        <div class="row border-top pt-3">
            <div class="col text-center text-muted small">
                <p class="mb-0">
                    &copy; {{ date('Y') }} Sistem Perpustakaan.
                    Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel 12.
                </p>
            </div>
        </div>
    </div>
</footer>
