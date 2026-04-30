<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Sistem Informasi Akademik - PNC</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/pnc.jpg') }}">
    <link href="https://assets.siakadcloud.com/assets/v1/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        /* Reset & Base Style */
        * {
            box-sizing: border-box;
        }

        body.login-page {
            background-color: #f4f7f6;
            background-image: url('https://www.transparenttextures.com/patterns/always-grey.png');
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: center;
        }

        .form-box {
            display: flex;
            flex-direction: row;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            min-height: 550px;
        }

        /* Sisi Kiri: Identitas Kampus */
        .univ-identity-box {
            flex: 1.2;
            background: #8ba2b5;
            background-image: linear-gradient(rgba(139, 162, 181, 0.8), rgba(44, 62, 80, 0.9)), url("{{ asset('img/logopnc.png') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 40px;
            color: white;
        }

        .univ-text h4 { margin-bottom: 5px; opacity: 0.9; font-weight: 300; }
        .univ-text h2 { margin: 0; font-size: 28px; line-height: 1.2; }
        .univ-text h3 { margin: 5px 0 0 0; font-size: 22px; }

        /* Sisi Kanan: Form Login */
        .form-login {
            flex: 0.8;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        .form-login .logo {
            width: 80px;
            height: auto;
            margin: 0 auto 20px auto;
            display: block;
        }

        /* Form Components */
        .title-login-email {
            position: relative;
            text-align: center;
            margin: 25px 0;
        }
        .title-line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #eee;
            z-index: 1;
        }
        .title-text {
            position: relative;
            background-color: #fff;
            padding: 0 15px;
            color: #999;
            font-size: 13px;
            z-index: 2;
        }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; color: #333; }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #8ba2b5;
        }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.2s;
        }
        .btn-google:hover { background: #f9f9f9; }

        .btn-submit {
            width: 100%;
            background: #2c3e50;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit:hover { background: #1a252f; }

        /* Media Queries (Responsive) */
        @media (max-width: 850px) {
            .form-box {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
            }
            .univ-identity-box {
                padding: 30px;
                min-height: 200px;
                text-align: center;
                justify-content: center;
            }
            .form-login { padding: 40px 25px; }
            .univ-text h2 { font-size: 22px; }
            .univ-text h3 { font-size: 18px; }
        }

        @media (max-width: 480px) {
            body.login-page { padding: 10px; }
            .form-login { padding: 30px 15px; }
            .form-control { font-size: 16px; } /* Mencegah auto-zoom di iOS */
        }
    </style>
</head>

<body class="login-page">
    <div class="container">
        <div class="form-box">
            <div class="univ-identity-box">
                <div class="univ-text">
                    <h4>Selamat Datang</h4>
                    <h2>Sistem Informasi Pengajuan Magang</h2>
                    <h3><b>Politeknik Negeri Cilacap</b></h3>
                </div>
            </div>

            <div class="form-login">
                <img src="{{ asset('img/logopnc.png') }}" class="logo" alt="Logo PNC">
                
                <span style="font-size:20px; font-weight: 700; display: block; text-align: center; color: #2c3e50;">Masuk dan Verifikasi</span>
                
                <p style="margin: 10px 0 25px 0; text-align: center; font-size: 13px; color: #777; line-height: 1.5;">
                    Sistem Informasi Layanan Surat Pengantaran Magang
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <a href="#" class="btn-google">
                        <img src="https://quantum.sevima.com/assets/images/logo-google.svg" width="18" alt="Google Logo"> 
                        Masuk dengan Google
                    </a>

                    <div class="title-login-email">
                        <span class="title-line"></span>
                        <span class="title-text">atau gunakan email</span>
                    </div>

                    <div class="form-group">
                        <label><strong>Email/NIM</strong><span style="color:red">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="contoh: user@pnc.ac.id" required autofocus value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label><strong>Password</strong><span style="color:red">*</span></label>
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                            <span id="iconshow" onclick="showPass()" class="fa fa-eye-slash" style="position: absolute; right: 12px; top: 14px; cursor: pointer; color: #aaa;"></span>
                        </div>
                    </div>

                @if (Route::has('password.request'))
                    <div style="text-align: right; margin-bottom: 20px;">
                        <a href="{{ route('password.request') }}" style="font-size: 12px; color: #8ba2b5; text-decoration: none; font-weight: 600;">Lupa kata sandi?</a>
                    </div>
                @endif

                    <button type="submit" class="btn-submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showPass() {
            const passInput = document.getElementById("password");
            const icon = document.getElementById("iconshow");
            
            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passInput.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>
</html>