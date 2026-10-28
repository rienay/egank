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
            width: 880px;
            max-width: 100%;
            min-height: 520px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255, 255, 255, .97);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 20px 60px rgba(15, 23, 42, .25),
                0 0 0 1px rgba(255, 255, 255, .2);
            position: relative;
            z-index: 2;
        }

        .left {
            position: relative;
            padding: 40px 36px;
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
            gap: 12px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .18);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .15);
            font-size: 18px;
        }

        .hero-text h1 {
            font-size: 32px;
            line-height: 1.15;
            margin-bottom: 12px;
            font-weight: 800;
        }

        .hero-text p {
            font-size: 13.5px;
            line-height: 1.6;
            max-width: 360px;
            opacity: .92;
        }

        .feature-box {
            margin-top: 24px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .feature {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .15);
            backdrop-filter: blur(12px);
            padding: 9px 13px;
            border-radius: 12px;
            font-size: 12.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .right {
            padding: 44px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .badge {
            width: max-content;
            background: #dbeafe;
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .header h2 {
            font-size: 26px;
            color: var(--text);
            margin-bottom: 6px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .header p {
            color: var(--text-soft);
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .error-box {
            background: var(--danger-bg);
            border: 1px solid #fecaca;
            color: var(--danger);
            padding: 11px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: var(--text);
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
            transition: .3s;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            transition: .3s;
            font-size: 14px;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        input {
            width: 100%;
            height: 46px;
            border-radius: 12px;
            border: 1.6px solid #e2e8f0;
            background: #f8fafc;
            padding: 0 42px 0 42px;
            font-size: 14px;
            transition: .3s;
            color: var(--text);
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -2px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
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
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .25);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(37, 99, 235, .32);
        }

        .footer-note {
            margin-top: 20px;
            text-align: center;
            color: var(--text-soft);
            font-size: 12.5px;
            line-height: 1.5;
        }

        .footer-note strong {
            color: var(--text);
        }

        @media(max-width:960px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 460px;
            }

            .left {
                display: none;
            }

            .right {
                padding: 36px 24px;
            }

            .header h2 {
                font-size: 24px;
            }
        }

        @media(max-width:480px) {
            body {
                padding: 14px;
            }

            .right {
                padding: 28px 18px;
            }

            .header h2 {
                font-size: 22px;
            }

            input {
                height: 44px;
            }

            .btn {
                height: 44px;
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
                    <label>Email / NIM</label>

                    <div class="input-wrapper">
                        <i class="fa-solid fa-user input-icon"></i>

                        <input
                            type="text"
                            name="email"
                            placeholder="Masukkan email atau NIM"
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
                        <input type="checkbox" name="remember" id="remember">
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