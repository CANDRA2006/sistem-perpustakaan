<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="bi bi-book-fill"></i>
            Perpustakaan
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('buku*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
                        <i class="bi bi-book"></i> Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('anggota*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                        <i class="bi bi-people"></i> Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-arrow-left-right"></i> Transaksi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
