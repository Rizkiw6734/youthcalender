@extends('layouts.app')

@section('title', 'Informasi Bulan ' . $bulan->nama_bulan)
@section('menu-bulan', 'active')

@section('content')
<div class="container">

    {{-- BACK --}}
    <a href="{{ route('user.bulan.show', $bulan->slug) }}"
       class="btn-back mb-4 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali
    </a>

    {{-- HEADER --}}
    <div class="mb-4 text-center">
        <h2 class="fw-bold mb-1">Informasi Bulan {{ $bulan->nama_bulan }}</h2>
        <p class="subtitle">Informasi penting & terbaru bulan ini</p>
    </div>

    {{-- LIST INFORMASI --}}
    <div class="row g-4">
        @forelse ($informasis as $info)
            <div class="col-12 col-md-4">
                <div class="note-card informasi-item"
                     data-judul="{{ $info->judul }}"
                     data-isi="{{ e($info->keterangan) }}"
                     data-tanggal="{{ \Carbon\Carbon::parse($info->tanggal)->translatedFormat('l, d F Y') }}">

                    <small class="date">
                        {{ \Carbon\Carbon::parse($info->tanggal)->translatedFormat('l, d F') }}
                    </small>

                    <h5 class="mt-2">{{ $info->judul }}</h5>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <i class="bi bi-info-circle mb-3"></i>
                    <h5 class="mb-1">Informasi Masih Kosong</h5>
                    <p class="mb-0">
                        Belum ada informasi untuk bulan {{ $bulan->nama_bulan }}.
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- MODAL INFORMASI --}}
<div class="modal fade" id="modalInformasi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalJudul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <small class="modal-date d-block mb-3" id="modalTanggal"></small>
                <div id="modalIsi"></div>
            </div>

        </div>
    </div>
</div>

{{-- CSS --}}
<style>
    .subtitle {
        color: #6b7280;
    }
    body.dark .subtitle {
        color: #9ca3af;
    }

    .note-card {
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        cursor: pointer;
        transition: all .25s ease;
        border-left: 5px solid  #6366f1;
        height: 100%;
    }

    body.dark .note-card {
        background: #020617;
        color: #e5e7eb;
    }

    .note-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0,0,0,.1);
    }

    .note-card .date {
        font-size: 13px;
        color: #6b7280;
    }

    body.dark .note-card .date {
        color: #9ca3af;
    }

    .note-card h5 {
        font-weight: 600;
        margin-top: 8px;
    }

    .empty-state {
        border: 2px dashed #e5e7eb;
        border-radius: 18px;
        color: #6b7280;
    }

    body.dark .empty-state {
        border-color: #334155;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 48px;
        color: #6366f1;
    }

    .btn-back {
        text-decoration: none;
        font-weight: 500;
        color: #6366f1;
        padding: 8px 14px;
        border-radius: 10px;
        transition: all .2s ease;
    }

    .btn-back:hover {
        background-color: rgba(34,197,94,.12);
    }

    body.dark .btn-back {
        color: #a5b4fc;
    }

    .modal-date {
        color: #6b7280;
    }

    body.dark .modal-date {
        color: #9ca3af;
    }

     /* DARK MODE MODAL */
        body.dark .modal-content {
            background-color: #020617;
            color: #e5e7eb;
        }

        body.dark .modal-header {
            border-bottom: 1px solid #334155;
        }

        body.dark .modal-title {
            color: #f9fafb;
        }

        body.dark .modal-body {
            color: #e5e7eb;
        }

        /* TANGGAL MODAL */
        body.dark #modalTanggal {
            color: #9ca3af !important;
        }

        /* CLOSE BUTTON */
        body.dark .btn-close {
            filter: invert(1);
        }
</style>

{{-- SCRIPT --}}
<script>
    document.querySelectorAll('.informasi-item').forEach(item => {
        item.addEventListener('click', function () {
            document.getElementById('modalJudul').innerText   = this.dataset.judul;
            document.getElementById('modalIsi').innerHTML    = this.dataset.isi;
            document.getElementById('modalTanggal').innerText= this.dataset.tanggal;

            new bootstrap.Modal(
                document.getElementById('modalInformasi')
            ).show();
        });
    });
</script>
@endsection
