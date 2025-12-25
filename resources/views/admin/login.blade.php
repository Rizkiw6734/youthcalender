<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0725be, #0d1c46);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 36px;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 25px 45px rgba(30, 64, 175, 0.15);
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-logo {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -70px auto 25px;
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.35);
        }

        .login-logo img {
            width: 70%;
            height: 70%;
            object-fit: contain;
            border-radius: 50%;
            background: #ffffff;
            padding: 6px;
        }


        .form-control {
            border-radius: 12px;
            padding-left: 44px;
            height: 48px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, 0.25);
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #3b82f6;
            font-size: 18px;
        }

        .form-group {
            position: relative;
        }

        .btn-login {
            border-radius: 12px;
            background: linear-gradient(135deg, #0725be, #0e2d85);
            border: none;
            font-weight: 600;
            transition: 0.3s;
            height: 48px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.35);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #3b82f6;
            font-size: 18px;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        @media (max-width: 576px) {

            .login-logo {
                margin: -40px auto 16px;
                width: 72px;
                height: 72px;
            }

            .login-card {
                padding: 24px 20px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-logo">
                <img src="{{ asset('images/logo2.jpg') }}" alt="Logo Admin">
            </div>


            <h4 class="text-center fw-bold mb-2">Admin Panel</h4>
            <p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>

            @if (session('error'))
                <div class="alert alert-danger text-center">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div class="mb-3 form-group">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>

                <div class="mb-4 form-group">
                    <i class="bi bi-lock input-icon"></i>

                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">

                    <span class="toggle-password" onclick="togglePassword()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                </div>


                <button class="btn btn-login w-100 text-white">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>

        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }
    </script>

</body>

</html>
