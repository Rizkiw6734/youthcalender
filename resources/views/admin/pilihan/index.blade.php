@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="row align-items-center mb-4 g-2">

            <div class="col-12 col-md-4">
                <h4 class="fw-bold mb-0">Data Pilihan Perjalanan</h4>
            </div>

            {{-- Filter Bulan --}}
            <div class="col-12 col-md-4">
                <select id="filterBulan" class="form-select">
                    <option value="">Semua Bulan</option>
                    @foreach ($bulans as $b)
                        <option value="{{ $b->id }}" {{ request('bulan') == $b->id ? 'selected' : '' }}>
                            {{ $b->nama_bulan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Tambah --}}
            <div class="col-12 col-md-4 text-md-end">
                <a href="{{ route('pilihan.create') }}" class="btn btn-primary w-100 w-md-auto">
                    <i class="bi bi-plus-lg"></i> Tambah Perjalanan
                </a>
            </div>

        </div>

        {{-- SWEET ALERT SUCCESS --}}
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        {{-- LIST CARD --}}
        <div id="pilihanList" class="row g-3">

            @forelse ($data as $d)
                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        {{-- Gambar --}}
                        @if ($d->gambar)
                            <img src="{{ asset('storage/' . $d->gambar) }}" class="card-img-top"
                                style="height:200px;object-fit:cover;">
                        @endif

                        <div class="card-body d-flex flex-column">

                            {{-- Destinasi --}}
                            <h5 class="fw-bold mb-1">
                                {{ $d->nama_destinasi }}
                            </h5>

                            {{-- Negara --}}
                            {{-- Negara --}}
                            <div class="artikel-negara mb-2">
                                <i class="bi bi-geo-alt-fill me-1"></i>
                                <span>{{ $d->negara }}</span>
                            </div>


                            {{-- Meta --}}
                            <div class="small mb-3">
                                {{ $d->hari }} <br>
                                {{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}
                                <div>
                                    <span class="badge bg-secondary-subtle text-body mt-1">
                                        {{ $d->bulan->nama_bulan }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-auto"></div>

                            {{-- Aksi --}}
                            <div class="d-flex gap-2 mt-3">

                                {{-- Show --}}
                                <button class="btn btn-info btn-sm flex-fill" data-bs-toggle="modal"
                                    data-bs-target="#showPilihan{{ $d->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>

                                {{-- Edit --}}
                                <a href="{{ route('pilihan.edit', $d->id) }}" class="btn btn-warning btn-sm flex-fill">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('pilihan.destroy', $d->id) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm w-100 btn-hapus"
                                        data-nama="{{ $d->nama_destinasi }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- MODAL SHOW --}}
                <div class="modal fade" id="showPilihan{{ $d->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content bg-body text-body">

                            <div class="modal-header border-body">
                                <h5 class="modal-title fw-bold">
                                    {{ $d->nama_destinasi }} - {{ $d->negara }}
                                </h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                @if ($d->gambar)
                                    <img src="{{ asset('storage/' . $d->gambar) }}" class="img-fluid rounded mb-3">
                                @endif

                                <div class="text-body-secondary small mb-3">
                                    {{ $d->hari }}
                                    {{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}
                                </div>

                                <span class="badge bg-secondary-subtle text-body mb-3">
                                    {{ $d->bulan->nama_bulan }}
                                </span>

                                <hr class="border-body">

                                {{-- DESKRIPSI (HANYA DI SHOW) --}}
                                <div class="lh-lg artikel-isi">
                                    {!! nl2br(e($d->deskripsi)) !!}
                                </div>

                            </div>

                            <div class="modal-footer border-body">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        @if (request('bulan'))
                            @php
                                $namaBulan = $bulans->firstWhere('id', request('bulan'))?->nama_bulan;
                            @endphp
                            <h6 class="fw-semibold artikel-empty-title">
                                Tidak ada pilihan perjalanan pada bulan
                            </h6>
                            <span class="badge bg-secondary-subtle text-body mt-2">
                                {{ $namaBulan }}
                            </span>
                        @else
                            <span class="text-muted">
                                Belum ada informasi
                            </span>
                        @endif
                    </div>
                </div>
            @endforelse

        </div>
    </div>

    {{-- SCRIPT FILTER + DELETE --}}
    <script>
        document.getElementById('filterBulan').addEventListener('change', function() {
            const bulan = this.value;
            const url = new URL(window.location.href);

            bulan ? url.searchParams.set('bulan', bulan) :
                url.searchParams.delete('bulan');

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    document.getElementById('pilihanList').innerHTML =
                        doc.getElementById('pilihanList').innerHTML;
                    history.pushState({}, '', url);
                });
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-hapus')) {
                const btn = e.target.closest('.btn-hapus');
                const form = btn.closest('form');
                const nama = btn.dataset.nama;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Perjalanan "${nama}" akan dihapus permanen`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            }
        });
    </script>
@endsection
