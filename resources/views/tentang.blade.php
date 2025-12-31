@extends('layouts.app')

@section('title', 'Tentang Kami')
@section('menu-tentang', 'active')

@section('content')

<style>
    /* === KHUSUS KONTEN ABOUT === */
    .about-wrapper {
        max-width: 900px;
        margin: auto;
        text-align: center;
        padding: 40px 20px;
    }

    .profile-img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #272a38;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .35);
    }

    .social-btn {
        background: #1a1d27;
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #272a38;
        color: #e5e5e5;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: .25s;
    }

    .social-btn:hover {
        background: #0d6efd;
        color: #fff;
        transform: translateY(-3px);
    }

    /* LIGHT MODE */
    .light-mode .social-btn {
        background: #ffffff;
        color: #222;
        border: 1px solid #ddd;
    }

    .light-mode .social-btn:hover {
        background: #0d6efd;
        color: #fff;
    }
</style>

<div class="about-wrapper">

    <img src="{{ asset('images/logo.jpg') }}" alt="YouthMedia Logo" class="profile-img mb-3">

    <h2 class="fw-bold">YouthMedia</h2>

    <p class="mt-3 mb-4 mx-auto" style="max-width:600px; line-height:1.7;">
        Website ini dibuat sebagai pelengkap dari kalender fisik, dengan menyediakan
        informasi tambahan seperti hari-hari besar nasional dan internasional,
        pembaruan terbaru bila ada libur tambahan atau pengumuman resmi dari pemerintah,
        serta rekomendasi waktu terbaik untuk mengunjungi berbagai negara di setiap bulan.
        Selain itu, tersedia juga jadwal Piala Dunia 2026.
    </p>

    <h4 class="mt-5 mb-3">Hubungi Kami</h4>

    <div class="d-flex flex-column align-items-center gap-3 mx-auto" style="max-width:350px;">
        <a href="https://wa.me/6289509642432" class="social-btn w-100">
            <i class="bi bi-whatsapp"></i> WhatsApp
        </a>

        <a href="https://www.instagram.com/youthmedia.apparel" class="social-btn w-100">
            <i class="bi bi-instagram"></i> Instagram
        </a>

        <a href="https://tiktok.com/@youthmedia" class="social-btn w-100">
            <i class="bi bi-tiktok"></i> TikTok
        </a>
    </div>

</div>

@endsection
