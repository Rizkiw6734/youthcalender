<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sedang Dalam Pengembangan</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon_256.png') }}">


    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e40af, #9333ea);
            background-size: 300% 300%;
            animation: gradientShift 10s ease infinite;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 45px;
            border-radius: 20px;
            max-width: 560px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        /* LOGO BULAT – DITENGAHKAN */
        .logo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 25px auto; /* ⬅ bagian ini membuat logo benar-benar center */
            display: block; /* ⬅ memastikan posisi logo bisa di-center */
            border: 4px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        h1 {
            font-size: 30px;
            font-weight: 700;
            color: #ffffff;
        }

        .date-launch {
            font-size: 20px;
            margin-top: 8px;
            color: #a5f3fc;
        }

        .desc {
            margin-top: 18px;
            font-size: 16px;
            opacity: 0.95;
            line-height: 1.6;
        }

    </style>
</head>
<body>

    <div class="card text-center">

        <!-- LOGO DITENGAH -->
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">

        <h1>Website Sedang Dalam Pengembangan</h1>
        <p class="date-launch">Akan diluncurkan pada <strong>1 Januari 2026</strong></p>

        <p class="desc">
            Terima kasih telah mengunjungi YouthKalender.<br>
            Kami sedang mempersiapkan konten terbaik mengenai kalender, artikel kalender,
            hari besar nasional & internasional, serta informasi penting lainnya.<br>
            Nantikan peluncurannya!
        </p>

    </div>

</body>
</html>
