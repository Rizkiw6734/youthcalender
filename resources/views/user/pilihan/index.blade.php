@extends('layouts.app')

@section('title', 'Informasi Bulan ' . $bulan->nama_bulan)
@section('menu-bulan', 'active')

@section('content')
    <div class="container">

        {{-- BACK --}}
        <a href="{{ route('user.bulan.show', $bulan->slug) }}" class="btn-back mb-4 d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali
        </a>

        {{-- HEADER --}}
        <div class="mb-4 text-center">
            <h2 class="fw-bold mb-1">Pilihan Perjalanan Bulan {{ $bulan->nama_bulan }}</h2>
            <p class="subtitle">Rekomendasi destinasi terbaik bulan ini</p>
        </div>

        @forelse($pilihan as $index => $p)
            {{-- LIST UTAMA --}}
            <div class="travel-item">

                <div class="travel-image">
                    <img src="{{ asset('storage/' . $p->gambar) }}">
                    <div class="travel-overlay"></div>
                </div>

                <div class="travel-content">
                    <button class="toggle-btn" onclick="toggleDesc({{ $index }}, this)">
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div class="travel-main">
                        <h4 class="country">{{ $p->negara }}</h4>
                        <p class="destination">{{ $p->nama_destinasi }}</p>
                    </div>

                    <div class="travel-date">
                        {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>


            {{-- LIST DESKRIPSI (TERSEMBUNYI) --}}
            <div class="travel-desc-wrapper" id="desc-{{ $index }}">
                <div class="travel-desc-box">
                    {{ $p->deskripsi }}
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <i class="bi bi-map mb-3"></i>
                    <h5 class="mb-1">Pilihan Perjalanan Masih Kosong</h5>
                    <p class="mb-0">
                        Belum ada Pilihan Perjalanan untuk bulan {{ $bulan->nama_bulan }}.
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- CSS --}}
    <style>
        .subtitle {
            color: #6b7280;
        }

        body.dark .subtitle {
            color: #9ca3af;
        }

        /* ITEM */
        .travel-item {
            display: flex;
            height: 140px;
            border-radius: 18px;
            overflow: hidden;
            background: #000;
            position: relative;
            margin-bottom: 16px;
        }


        body.dark .travel-item {
            background: #020617;
        }

        /* GAMBAR */
        .travel-image {
            width: 40%;
            position: relative;
        }

        .travel-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .travel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, 0.2) 0%,
                    rgba(0, 0, 0, 0.6) 40%,
                    rgba(0, 0, 0, 1) 100%);
        }


        /* KONTEN */
        .travel-content {
            width: 60%;
            padding: 20px;
            color: #fff;
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        body.dark .travel-content {
            background: linear-gradient(135deg,
                    #020617 0%,
                    #020617 50%,
                    #0f172a 100%);
        }


        /* TOGGLE */
        .toggle-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            border: none;
            background: transparent;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }


        /* MAIN */

        .travel-main {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
            pointer-events: none;
            /* biar klik toggle gak keganggu */
        }


        .country {
            font-size: 26px;
            font-weight: 800;
            line-height: 1.1;
        }

        body.dark .country {
            color: #9ca3af;
        }

        .destination {
            font-size: 16px;
            opacity: .85;
        }

        /* DATE */
        .travel-date {
            position: absolute;
            bottom: 16px;
            right: 20px;
            font-size: 13px;
            color: #6b7280;
        }

        body.dark .travel-date {
            color: #9ca3af;
        }

        /* DESKRIPSI */
        .travel-desc {
            margin-top: 18px;
            display: none;
            font-size: 14px;
            line-height: 1.7;
            color: #374151;
        }

        body.dark .travel-desc {
            color: #d1d5db;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .travel-item {
                height: 120px;
            }

            .country {
                font-size: 20px;
            }

            .destination {
                font-size: 14px;
            }
        }



        /* DESKRIPSI WRAPPER */
        .travel-desc-wrapper {
            display: none;
            margin-top: 14px;
            margin-bottom: 26px;
        }

        .travel-desc-box {
            background: #000;
            color: #fff;
            padding: 18px;
            border-radius: 14px;
            line-height: 1.7;
        }

        /* DARK MODE */
        body.dark .travel-desc-box {
            background: #020617;
            color: #d1d5db;
            border-color: #818cf8;
        }

        /* CLOSE BUTTON */
        body.dark .btn-close {
            filter: invert(1);
        }

        .btn-back i {
            font-size: 1.2rem;
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
            background-color: rgba(34, 197, 94, .12);
        }

        .btn-back:hover {
            background-color: rgba(34, 197, 94, .12);
        }

        body.dark .btn-back {
            color: #a5b4fc;
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
    </style>

    {{-- SCRIPT --}}
    <script>
        function toggleDesc(index, btn) {
            const box = document.getElementById('desc-' + index);
            const icon = btn.querySelector('i');

            if (box.style.display === 'block') {
                box.style.display = 'none';
                icon.classList.remove('bi-chevron-up');
                icon.classList.add('bi-chevron-down');
            } else {
                box.style.display = 'block';
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-up');
            }
        }
    </script>

@endsection
