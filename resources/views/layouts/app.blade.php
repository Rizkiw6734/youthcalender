<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Area')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">

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

        /* ===== GLOBAL ===== */
        body {
            margin: 0;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: .3s ease;
        }

        body.dark {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        /* ===== TOP HEADER ===== */
        .top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            padding: 0 20px;
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1050;
        }

        body.dark .top-header {
            background: rgba(2, 6, 23, .9);
        }

        /* BRAND */
        .brand-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        /* RIGHT ACTION */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        /* THEME BUTTON */
        .theme-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            /* 🔥 icon diperbesar */
            cursor: pointer;
            color: #0f172a;
        }

        body.dark .theme-btn {
            color: #ffffff;
            /* 🔥 matahari kuning, kelihatan */
        }

        /* TOGGLE SIDEBAR */
        .header-toggle-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: none;
            background: transparent;
            font-size: 24px;
            cursor: pointer;
            color: inherit;
        }

        /* ===== ICON BUTTON ===== */
        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.dark .icon-btn {
            border-color: #334155;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            width: 260px;
            height: calc(100vh - 64px);
            background: var(--sidebar-light);
            padding-top: 10px;
            transition: .3s ease;
            z-index: 1040;
        }

        body.dark .sidebar {
            background: var(--sidebar-dark);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            margin: 6px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: inherit;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: var(--primary);
            color: #fff;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-left: 260px;
            padding: 100px 30px 30px;
            transition: .3s ease;
        }

        /* ===== OVERLAY ===== */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 1030;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.show {
                left: 0;
            }

            .overlay.show {
                display: block;
            }

            .content {
                margin-left: 0;
                padding-top: 100px;
            }
        }


        /* BRAND AREA */
        .brand-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* LOGO */
        .brand-logo {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* TITLE */
        .brand-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .brand-area:hover .brand-title {
            opacity: .9;
        }

        .brand-area:hover .brand-logo {
            transform: scale(1.05);
            transition: .2s ease;
        }

        /* ===== SIDEBAR DESKTOP ===== */
        @media (min-width: 992px) {

            /* mode icon only */
            .sidebar.collapsed {
                width: 80px;
            }

            .sidebar.collapsed .link-text {
                display: none;
            }

            .sidebar.collapsed a {
                justify-content: center;
            }

            /* content ikut geser */
            .sidebar.collapsed~.content {
                margin-left: 80px;
            }
        }
    </style>
</head>

<body>

    <!-- ========== TOP HEADER ========== -->
    <div class="top-header">
        <div class="brand-area">
            <img src="{{ asset('images/logo2.jpg') }}" alt="Logo" class="brand-logo">
            <span class="brand-title">YOUTHKALENDER</span>
        </div>

        <div class="header-actions">
            <button id="themeToggle" class="theme-btn" onclick="toggleTheme()">
                <i class="bi bi-moon-fill" id="themeIcon"></i>
            </button>

            <button class="header-toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>



    <div class="wrapper">

        <!-- ===== SIDEBAR ===== -->
        <nav id="sidebar" class="sidebar">
            <a class="@yield('menu-bulan')" href="{{ url('/bulan') }}">
                <i class="bi bi-calendar"></i>
                <span class="link-text">Bulan</span>
            </a>

            <a class="@yield('menu-tentang')" href="{{ url('/tentang') }}">
                <i class="bi bi-info-circle"></i>
                <span class="link-text">Tentang</span>
            </a>
        </nav>

        <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>


    </div>


    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const themeIcon = document.getElementById('themeIcon');

        document.addEventListener('DOMContentLoaded', () => {
            const theme = localStorage.getItem('theme');

            if (theme === 'dark') {
                document.body.classList.add('dark');
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
            }
        });

        function toggleTheme() {
            document.body.classList.toggle('dark');

            if (document.body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill'); // 🌞 muncul saat gelap
            } else {
                localStorage.setItem('theme', 'light');
                themeIcon.classList.remove('bi-sun-fill');
                themeIcon.classList.add('bi-moon-fill'); // 🌙 muncul saat terang
            }
        }
        const sidebar = document.getElementById('sidebar');

        /* ===== INIT SAAT LOAD ===== */
        document.addEventListener('DOMContentLoaded', () => {

            // hanya berlaku desktop
            if (window.innerWidth >= 992) {
                const sidebarState = localStorage.getItem('sidebar');

                if (sidebarState === 'collapsed') {
                    sidebar.classList.add('collapsed');
                }
            }
        });

        /* ===== TOGGLE SIDEBAR ===== */
        function toggleSidebar() {

            // MOBILE
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('show');
                document.getElementById('overlay')?.classList.toggle('show');
                return;
            }

            // DESKTOP
            sidebar.classList.toggle('collapsed');

            // simpan state
            if (sidebar.classList.contains('collapsed')) {
                localStorage.setItem('sidebar', 'collapsed');
            } else {
                localStorage.setItem('sidebar', 'expanded');
            }
        }
    </script>

</body>

</html>
