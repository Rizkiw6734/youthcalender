<div class="container mt-4">
    <h3 class="text-center mb-4">Pilih Bulan</h3>

    <div class="row">
        @foreach ($bulan as $b)
            <div class="col-6 col-md-3 mb-4">
                <a href="{{ route('user.bulan.show', $b->slug) }}" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $b->gambar) }}" class="card-img-top" height="140" style="object-fit: cover;">
                        <div class="card-body text-center">
                            <strong>{{ $b->nama_bulan }}</strong>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
