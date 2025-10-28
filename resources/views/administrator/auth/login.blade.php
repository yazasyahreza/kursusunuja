<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootcamp Laravel 2025 - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" />

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #ffffff;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 15px;
        }

        body::before {
            content: "";
            position: absolute;
            top: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: #f1f3f6;
            border-radius: 50%;
            z-index: 0;
        }

        body::after {
            content: "";
            position: absolute;
            bottom: -120px;
            right: -120px;
            width: 350px;
            height: 350px;
            background: #f1f3f6;
            border-radius: 50%;
            z-index: 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #fff;
            gap: 40px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .welcome-text {
            max-width: 300px;
        }

        .welcome-text h2 {
            font-size: 30px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }

        .welcome-text p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        .login-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 360px;
        }

        .login-card .icon {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .login-card .icon img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .login-card label {
            font-size: 14px;
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        .login-card input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            outline: none;
        }

        .login-card input:focus {
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
            outline: none;
        }

        .btn-primary {
            border-radius: 12px;
            font-size: 16px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
        }

        .form-control::placeholder {
            color: #6c757d !important;
            opacity: 0.5;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            body {
                overflow: hidden;
            }

            .login-card {
                padding: 25px;
            }

            .login-card h1 {
                font-size: 22px;
            }

            body::before,
            body::after {
                width: 180px;
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            .welcome-text h2 {
                font-size: 26px;
            }

            .welcome-text p {
                font-size: 13px;
            }

            .container {
                flex-direction: column;
                text-align: center;
                gap: 35px;
            }

            .welcome-text {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="welcome-text">
            <h2>Selamat datang kembali!</h2>
            <p>Silahkan login untuk melanjutkan proses.</p>
        </div>

        <div class="login-card text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" width="70" class="mb-3"
                alt="logo">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label">Email atau Username</label>
                    <input type="text" class="form-control" name="login" placeholder="Masukkan email atau username"
                        value="{{ old('login') }}" autocomplete="off">
                    @error('login')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password"
                        autocomplete="new-password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
