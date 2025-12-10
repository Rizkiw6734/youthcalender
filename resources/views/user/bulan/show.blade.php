<div class="container mt-4 text-center">
    <h3>Bulan: {{ $bulan->nama_bulan }}</h3>

    <div class="mt-4">
        <a href="{{ route('user.bulan.artikel', $bulan->slug) }}" class="btn btn-primary btn-lg w-100 mb-3">
            Artikel Bulan Ini
        </a>

        <a href="{{ route('user.bulan.informasi', $bulan->slug) }}" class="btn btn-success btn-lg w-100 mb-3">
            Informasi Bulan Ini
        </a>

        <a href="{{ route('user.bulan.perjalanan', $bulan->slug) }}" class="btn btn-warning btn-lg w-100">
            Pilihan Perjalanan
        </a>
    </div>
</div>
