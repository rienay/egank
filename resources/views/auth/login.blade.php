<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - SIPM PNC</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #60a5fa;
            --bg: #eff6ff;
            --white: #ffffff;
            --text: #0f172a;
            --text-soft: #64748b;
            --border: #dbeafe;
            --danger-bg: #fef2f2;
            --danger: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, .25), transparent 25%),
                radial-gradient(circle at bottom right, rgba(37, 99, 235, .2), transparent 25%),
                linear-gradient(135deg, #1e3a8a 0%, #2563eb 45%, #3b82f6 100%);
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, .08);
            border-radius: 50%;
            top: -180px;
            right: -180px;
            filter: blur(10px);
        }

        body::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            background: rgba(255, 255, 255, .06);
            border-radius: 50%;
            bottom: -120px;
            left: -120px;
        }

        .container {
            width: 1100px;
            max-width: 100%;
            min-height: 680px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            background: rgba(255, 255, 255, .97);
            backdrop-filter: blur(10px);
            border-radius: 32px;
            overflow: hidden;
            box-shadow:
                0 20px 60px rgba(15, 23, 42, .25),
                0 0 0 1px rgba(255, 255, 255, .2);
            position: relative;
            z-index: 2;
        }

        .left {
            position: relative;
            padding: 60px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(rgba(15, 23, 42, .72), rgba(37, 99, 235, .78)),
            url('{{ asset("img/logindepan.png") }}');
            background-size: cover;
            background-position: center;
        }

        .overlay-blur {
            position: absolute;
            inset: 0;
            backdrop-filter: blur(2px);
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .18);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .15);
            font-size: 22px;
        }

        .hero-text h1 {
            font-size: 52px;
            line-height: 1.1;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .hero-text p {
            font-size: 17px;
            line-height: 1.8;
            max-width: 420px;
            opacity: .92;
        }

        .feature-box {
            margin-top: 35px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .feature {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .15);
            backdrop-filter: blur(12px);
            padding: 14px 18px;
            border-radius: 16px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .right {
            padding: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .badge {
            width: max-content;
            background: #dbeafe;
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .header h2 {
            font-size: 40px;
            color: var(--text);
            margin-bottom: 10px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .header p {
            color: var(--text-soft);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 38px;
        }

        .error-box {
            background: var(--danger-bg);
            border: 1px solid #fecaca;
            color: var(--danger);
            padding: 16px 18px;
            border-radius: 16px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: var(--text);
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
            transition: .3s;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            transition: .3s;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        input {
            width: 100%;
            height: 60px;
            border-radius: 18px;
            border: 1.8px solid #e2e8f0;
            background: #f8fafc;
            padding: 0 50px 0 52px;
            font-size: 15px;
            transition: .3s;
            color: var(--text);
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 5px rgba(37, 99, 235, .12);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -6px;
            margin-bottom: 28px;
            font-size: 14px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-soft);
        }

        .remember input {
            width: auto;
            height: auto;
        }

        .forgot {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            border: none;
            height: 60px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
            box-shadow: 0 15px 30px rgba(37, 99, 235, .25);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 35px rgba(37, 99, 235, .35);
        }

        .footer-note {
            margin-top: 35px;
            text-align: center;
            color: var(--text-soft);
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-note strong {
            color: var(--text);
        }

        @media(max-width:960px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 560px;
            }

            .left {
                display: none;
            }

            .right {
                padding: 45px 30px;
            }

            .header h2 {
                font-size: 32px;
            }
        }

        @media(max-width:480px) {
            body {
                padding: 16px;
            }

            .right {
                padding: 35px 22px;
            }

            .header h2 {
                font-size: 28px;
            }

            input {
                height: 56px;
            }

            .btn {
                height: 56px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="left">
            <div class="overlay-blur"></div>

            <div class="left-content">
                <div class="brand">
                    <div class="brand-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    SIPM PNC
                </div>
            </div>

            <div class="left-content hero-text">
                <h1>
                    Sistem Informasi<br>
                    Pengajuan Magang
                </h1>

                <p>
                    Platform terintegrasi untuk mempermudah pengajuan surat
                    pengantar magang mahasiswa Politeknik Negeri Cilacap.
                </p>

                <div class="feature-box">
                    <div class="feature">
                        <i class="fa-solid fa-shield-halved"></i>
                        Aman & Terintegrasi
                    </div>

                    <div class="feature">
                        <i class="fa-solid fa-clock"></i>
                        Proses Cepat
                    </div>

                    <div class="feature">
                        <i class="fa-solid fa-file-signature"></i>
                        Pengajuan Online
                    </div>
                </div>
            </div>
        </div>

        <div class="right">

            <div class="badge">
                Portal Mahasiswa PNC
            </div>

            <div class="header">
                <h2>Selamat Datang</h2>
                <p>
                    Silakan login menggunakan akun mahasiswa Anda untuk
                    mengakses sistem pengajuan surat magang.
                </p>
            </div>

            @if($errors->any())
            <div class="error-box">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>

                    <div class="input-wrapper">
                        <i class="fa-solid fa-user input-icon"></i>

                        <input
                            type="text"
                            name="email"
                            placeholder="Masukkan email"
                            required
                            value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kata Sandi</label>

                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            required>

                        <i class="fa-solid fa-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox">
                        Ingat saya
                    </label>

                    <a href="#" class="forgot">
                        Lupa password?
                    </a>
                </div>

                <button type="submit" class="btn">
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="footer-note">
                <strong>Butuh bantuan?</strong><br>
                Hubungi Admin Jurusan atau UPT Komputer PNC.
            </div>

        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ?
                'text' :
                'password';

            password.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>