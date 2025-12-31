<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>YouthMedia Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #0f1116;
            color: #e5e5e5;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            background: #15171f;
            border-bottom: 1px solid #1f2230;
        }

        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.8rem;
        }

        .hero p {
            margin-top: 15px;
            margin-bottom: 30px;
            color: #cfcfcf;
            max-width: 520px;
        }

        /* LIGHT MODE */
        .light-mode body {
            background: #f4f4f8;
            color: #222;
        }

        .light-mode .navbar {
            background: #ffffff;
            border-color: #ddd;
        }

        .light-mode .hero p {
            color: #555;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar fixed-top">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- BRAND -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('images/logo.jpg') }}" alt="YouthMedia Logo" height="28" class="rounded-circle">
                <span>YouthMedia</span>
            </a>


            <!-- THEME TOGGLE -->
            <button class="btn btn-sm btn-outline-light" id="themeToggle">
                <i class="bi bi-sun-fill"></i>
            </button>

        </div>
    </nav>


    <!-- HERO -->
    <div class="hero">
        <div>
            <h1>Selamat Datang</h1>
            <p>
                Kalender digital yang menyajikan artikel, informasi penting,
                dan rekomendasi perjalanan terbaik setiap waktu.
            </p>

            <a href="{{ url('/bulan') }}" class="btn btn-primary btn-lg">
                Mulai
            </a>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('themeToggle');
        const icon = toggle.querySelector('i');

        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-mode');
            icon.className = 'bi bi-moon-fill';
        }

        toggle.onclick = () => {
            document.documentElement.classList.toggle('light-mode');
            const isLight = document.documentElement.classList.contains('light-mode');
            icon.className = isLight ? 'bi bi-moon-fill' : 'bi bi-sun-fill';
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        };
    </script>

</body>

</html>
