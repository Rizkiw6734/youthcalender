<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
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
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: -70px auto 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            border-radius: 10px;
            padding-left: 42px;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .form-group {
            position: relative;
        }

        .btn-login {
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
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

<div class="login-card">

    <div class="login-icon">
        <i class="bi bi-shield-lock"></i>
    </div>

    <h4 class="text-center fw-bold mb-3">Admin Panel</h4>
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
            <input type="text" name="username" class="form-control" placeholder="Username" >
        </div>

        <div class="mb-4 form-group">
            <i class="bi bi-lock input-icon"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" >
        </div>

        <button class="btn btn-login w-100 text-white py-2">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </button>
    </form>

</div>

</body>
</html>
