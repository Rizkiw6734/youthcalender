<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Area')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-light: #f4f6f8;
            --bg-dark: #0f172a;
            --sidebar-light: #ffffff;
            --sidebar-dark: #020617;
            --text-light: #0f172a;
            --text-dark: #e5e7eb;
            --primary: #6366f1;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: all .3s ease;
        }

        body.dark {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--sidebar-light);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040; /* PASTI DI ATAS KONTEN */
            transition: all .3s ease;
        }

        body.dark .sidebar {
            background-color: var(--sidebar-dark);
        }

        .sidebar .brand {
            font-weight: 700;
            font-size: 20px;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        body.dark .sidebar .brand {
            border-color: #1e293b;
        }

        .sidebar .nav-link {
            padding: 12px 20px;
            color: inherit;
            border-radius: 10px;
            margin: 4px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: var(--primary);
            color: #fff;
        }

        /* TOPBAR */
        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 260px;
            height: 60px;
            background-color: rgba(255,255,255,0.85);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 20px;
            gap: 12px;
            z-index: 1030;
        }

        body.dark .topbar {
            background-color: rgba(2,6,23,0.85);
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: transparent;
            cursor: pointer;
        }

        body.dark .icon-btn {
            border-color: #334155;
            color: #e5e7eb;
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 90px 30px 30px;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.show {
                left: 0;
            }

            .topbar {
                left: 0;
            }

            .content {
                margin-left: 0;
                padding-top: 90px;
            }

        } 

        .brand-logo {
    width: 36px;
    height: 36px;
    border-radius: 50%;
}

    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="brand d-flex align-items-center justify-content-center gap-2">
    <img src="{{ asset('images/logo2.jpg') }}"alt="Logo" class="brand-logo">
    <span>YOUTHKALENDER</span>
</div>

    <nav class="nav flex-column mt-3">
        <a class="nav-link @yield('menu-dashboard')" href="#"><i class="bi bi-house"></i> Dashboard</a>
        <a class="nav-link @yield('menu-bulan')" href="{{ url('/bulan') }}"><i class="bi bi-calendar"></i> Bulan</a>
        <a class="nav-link @yield('menu-tentang')" href="#"><i class="bi bi-info-circle"></i> Tentang</a>
        <a class="nav-link @yield('menu-piala')" href="#"><i class="bi bi-trophy"></i> Piala Dunia</a>
    </nav>
</div>

<!-- TOPBAR -->
<div class="topbar">
    <button class="icon-btn d-lg-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <button class="icon-btn" onclick="toggleTheme()">
        <i class="bi bi-sun" id="themeIcon"></i>
    </button>
</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const themeIcon = document.getElementById('themeIcon');

    // INIT THEME SAAT HALAMAN LOAD
    document.addEventListener('DOMContentLoaded', () => {
        const theme = localStorage.getItem('theme');

        if (theme === 'dark') {
            document.body.classList.add('dark');
            themeIcon.classList.remove('bi-sun');
            themeIcon.classList.add('bi-moon');
        }
    });

    function toggleTheme() {
        document.body.classList.toggle('dark');

        if (document.body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            themeIcon.classList.remove('bi-sun');
            themeIcon.classList.add('bi-moon');
        } else {
            localStorage.setItem('theme', 'light');
            themeIcon.classList.remove('bi-moon');
            themeIcon.classList.add('bi-sun');
        }
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
