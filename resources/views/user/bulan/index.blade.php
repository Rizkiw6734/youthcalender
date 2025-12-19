@extends('layouts.app')

@section('title', 'Bulan')
@section('menu-bulan', 'active')

@section('content')
<div class="container">

    {{-- JUDUL --}}
    <div class="mb-4 text-center">
        <h2 class="fw-bold">Bulan</h2>
        <p class="subtitle mb-0">Jelajahi bulan dan informasi menarik di dalamnya</p>
    </div>

    <div class="row g-4">
        @forelse ($bulan as $b)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('user.bulan.show', $b->slug) }}"
                   class="text-decoration-none text-dark">

                    <div class="card border-0 shadow-sm bulan-card h-100">
                        <div class="bulan-img-wrapper">
                            <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->nama_bulan }}">
                            <div class="bulan-overlay">
                                <h6 class="mb-0">{{ $b->nama_bulan }}</h6>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                Belum ada data bulan
            </div>
        @endforelse
    </div>

</div>

{{-- STYLE KHUSUS HALAMAN BULAN --}}
<style>
    .bulan-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .bulan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,.15);
    }

    .bulan-img-wrapper {
        position: relative;
        height: 180px;
    }

    .bulan-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .bulan-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,0,0,.6),
            rgba(0,0,0,.1)
        );
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 15px;
        color: #fff;
        text-align: center;
        font-weight: 600;
        letter-spacing: .5px;
    }

    body.dark .bulan-card {
        background-color: #020617;
    }

    .subtitle {
    color: #6b7280;
}

body.dark .subtitle {
    color: #9ca3af;
}

</style>
@endsection
