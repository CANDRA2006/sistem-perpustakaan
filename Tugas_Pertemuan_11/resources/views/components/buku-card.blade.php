<div class="card h-100 shadow-sm">

    <div class="card-body">

        <div class="text-center mb-3">
            <i class="bi bi-book fs-1"></i>
        </div>

        <h5>{{ $buku->judul }}</h5>

        <p>
            <strong>Pengarang:</strong>
            {{ $buku->pengarang }}
        </p>

        <p>
            <strong>Harga:</strong>
            Rp {{ number_format($buku->harga,0,',','.') }}
        </p>

        <p>
            <strong>Stok:</strong>
            {{ $buku->stok }}
        </p>

        <span class="badge bg-primary">
            {{ $buku->kategori ?? 'Umum' }}
        </span>

        @if($buku->stok > 0)
            <span class="badge bg-success">
                Tersedia
            </span>
        @else
            <span class="badge bg-danger">
                Habis
            </span>
        @endif

    </div>

    @if($showActions)
    <div class="card-footer">

        <a href="#" class="btn btn-info btn-sm">
            Detail
        </a>

        <a href="#" class="btn btn-warning btn-sm">
            Edit
        </a>

    </div>
    @endif

</div>
