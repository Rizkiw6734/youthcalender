<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            background: #1e293b;
            min-height: 100vh;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #334155;
            color: #fff;
        }

        .sidebar h5 {
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Card */
        .card {
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,.05);
        }
    </style>
</head>
<body>

{{-- TOPBAR (MOBILE) --}}
<nav class="navbar navbar-light bg-white shadow-sm d-md-none">
    <div class="container-fluid">
        <button class="btn btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
            <i class="bi bi-list"></i>
        </button>
        <span class="fw-semibold">Admin Panel</span>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR DESKTOP --}}
        <div class="col-md-2 d-none d-md-block sidebar p-3">
            <h5 class="text-white text-center mb-4">ADMIN</h5>

            <a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('bulan.index') }}">
                <i class="bi bi-calendar-event"></i> Bulan
            </a>
            <a href="{{ route('artikel.index') }}">
                <i class="bi bi-file-text"></i> Artikel
            </a>
            <a href="{{ route('informasi.index') }}">
                <i class="bi bi-info-circle"></i> Informasi
            </a>
            <a href="{{ route('pilihan.index') }}">
                <i class="bi bi-geo-alt"></i> Perjalanan
            </a>

            <hr class="text-secondary">

            <a href="#" onclick="confirmLogout(event)">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>

        {{-- CONTENT --}}
        <div class="col-md-10 col-12 p-4">
            @yield('content')
        </div>

    </div>
</div>

{{-- SIDEBAR MOBILE (OFFCANVAS) --}}
<div class="offcanvas offcanvas-start sidebar text-white" tabindex="-1" id="sidebarMobile">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">ADMIN</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">

        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('bulan.index') }}">
            <i class="bi bi-calendar-event"></i> Bulan
        </a>
        <a href="{{ route('artikel.index') }}">
            <i class="bi bi-file-text"></i> Artikel
        </a>
        <a href="{{ route('informasi.index') }}">
            <i class="bi bi-info-circle"></i> Informasi
        </a>
        <a href="{{ route('pilihan.index') }}">
            <i class="bi bi-geo-alt"></i> Perjalanan
        </a>

        <hr class="text-secondary">

        <a href="#" onclick="confirmLogout(event)">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- SweetAlert SUCCESS --}}
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

{{-- SweetAlert LOGOUT --}}
<script>
function confirmLogout(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Logout?',
        text: 'Yakin ingin keluar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('admin.logout') }}";
        }
    });
}
</script>

</body>
</html>
