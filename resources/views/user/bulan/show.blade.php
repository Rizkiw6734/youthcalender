@extends('layouts.app')

@section('title', 'Bulan ' . $bulan->nama_bulan)
@section('menu-bulan', 'active')

@section('content')
    <div class="container">
        <a href="{{ url('/bulan') }}" class="btn-back mb-4 d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali
        </a>

        <div class="text-center mb-5">
            <h2 class="fw-bold mb-1">Bulan {{ $bulan->nama_bulan }}</h2>
            <p class="subtitle">
                Jelajahi konten menarik seputar bulan {{ $bulan->nama_bulan }}
            </p>
        </div>

        <div class="row justify-content-center g-4">

            {{-- ARTIKEL --}}
            <div class="col-12 col-md-4">
                <a href="{{ route('user.artikel', $bulan->id) }}" class="menu-card text-decoration-none">
                    <div class="card h-100 text-center">
                        <div class="icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h5>Artikel</h5>
                        <p class="text-muted mb-0">
                            Baca artikel menarik seputar bulan ini
                        </p>
                    </div>
                </a>
            </div>

            {{-- INFORMASI --}}
            <div class="col-12 col-md-4">
                <a href="{{ route('user.informasi', $bulan->id) }}" class="menu-card text-decoration-none">
                    <div class="card h-100 text-center">
                        <div class="icon">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h5>Informasi</h5>
                        <p class="text-muted mb-0">
                            Informasi penting & terbaru
                        </p>
                    </div>
                </a>
            </div>

            {{-- PILIHAN PERJALANAN --}}
            <div class="col-12 col-md-4">
                <a href="{{ route('user.pilihan', $bulan->id) }}" class="menu-card text-decoration-none">
                    <div class="card h-100 text-center">
                        <div class="icon">
                            <i class="bi bi-map"></i>
                        </div>
                        <h5>Pilihan Perjalanan</h5>
                        <p class="text-muted mb-0">
                            Rekomendasi perjalanan terbaik
                        </p>
                    </div>
                </a>
            </div>

        </div>
    </div>

    {{-- CSS KHUSUS HALAMAN INI --}}
    <style>
        .subtitle {
            color: #6b7280;
        }

        body.dark .subtitle {
            color: #9ca3af;
        }

        .menu-card .card {
            border: none;
            border-radius: 18px;
            padding: 40px 20px;
            transition: all .25s ease;
            background-color: #ffffff;
        }

        body.dark .menu-card .card {
            background-color: #020617;
            color: #e5e7eb;
        }

        .menu-card .icon {
            font-size: 36px;
            color: #6366f1;
            margin-bottom: 15px;
        }

        .menu-card h5 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .menu-card .text-muted {
            font-size: 14px;
        }

        body.dark .menu-card .text-muted {
            color: #9ca3af !important;
        }

        .menu-card .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
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
            background-color: rgba(99, 102, 241, 0.1);
        }

        body.dark .btn-back {
            color: #a5b4fc;
        }

        body.dark .btn-back:hover {
            background-color: rgba(165, 180, 252, 0.12);
        }

        .btn-back i {
            font-size: 1.2rem;
        }
    </style>
@endsection
