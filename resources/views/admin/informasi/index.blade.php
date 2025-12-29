@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-4 g-2">

        {{-- Judul --}}
        <div class="col-12 col-md-4">
            <h4 class="fw-bold mb-0">Daftar Informasi</h4>
        </div>

        {{-- Filter Bulan --}}
        <div class="col-12 col-md-4">
            <select id="filterBulan" class="form-select">
                <option value="">Semua Bulan</option>
                @foreach ($bulans as $b)
                    <option value="{{ $b->id }}"
                        {{ request('bulan') == $b->id ? 'selected' : '' }}>
                        {{ $b->nama_bulan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <div class="col-12 col-md-4 text-md-end">
            <a href="{{ route('informasi.create') }}" class="btn btn-primary w-100 w-md-auto">
                <i class="bi bi-plus-lg"></i> Tambah Informasi
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

    <div id="informasiList" class="row g-3">

        @forelse ($informasis as $info)
            <div class="col-12 col-md-6 col-lg-4">

                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">

                        {{-- Judul --}}
                        <h5 class="fw-bold mb-2 artikel-judul">
                            {{ $info->judul }}
                        </h5>

                        {{-- Meta --}}
                        <div class="small mb-3 artikel-meta">
                            {{ $info->hari }}
                            {{ \Carbon\Carbon::parse($info->tanggal)->translatedFormat('d F Y') }} <br>
                            <span class="badge bg-secondary-subtle text-body mt-1">
                                {{ $info->bulan->nama_bulan }}
                            </span>
                        </div>

                        <div class="mt-auto"></div>

                        {{-- Aksi --}}
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn btn-info btn-sm flex-fill"
                                data-bs-toggle="modal"
                                data-bs-target="#showInformasi{{ $info->id }}">
                                <i class="bi bi-eye"></i>
                            </button>

                            <a href="{{ route('informasi.edit', $info->id) }}"
                               class="btn btn-warning btn-sm flex-fill">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('informasi.destroy', $info->id) }}"
                                  method="POST" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="btn btn-danger btn-sm w-100 btn-hapus"
                                    data-judul="{{ $info->judul }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{-- MODAL SHOW --}}
            <div class="modal fade" id="showInformasi{{ $info->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content bg-body text-body">

                        <div class="modal-header border-body">
                            <h5 class="modal-title fw-bold">{{ $info->judul }}</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="text-body-secondary small mb-3">
                                {{ $info->hari }}
                                {{ \Carbon\Carbon::parse($info->tanggal)->translatedFormat('d F Y') }}
                            </div>

                            <hr class="border-body">

                            <div class="lh-lg artikel-isi">
                                {!! nl2br(e($info->keterangan)) !!}
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
                            Tidak ada informasi pada bulan
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
document.getElementById('filterBulan').addEventListener('change', function () {
    const bulan = this.value;
    const url = new URL(window.location.href);

    bulan ? url.searchParams.set('bulan', bulan)
          : url.searchParams.delete('bulan');

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            document.getElementById('informasiList').innerHTML =
                doc.getElementById('informasiList').innerHTML;
            history.pushState({}, '', url);
        });
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.btn-hapus')) {
        const btn = e.target.closest('.btn-hapus');
        const form = btn.closest('form');
        const judul = btn.dataset.judul;

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Informasi "${judul}" akan dihapus permanen`,
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
