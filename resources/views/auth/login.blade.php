<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Akademik - PNC</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Sistem Informasi Akademik solusi terbaik Universitas.">
    
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/pnc.jpg') }}">
    
    <link href="https://assets.siakadcloud.com/assets/v1/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://assets.siakadcloud.com/assets/v1/css/customs/login-v2.css" rel="stylesheet" type="text/css">

    <style>
        body.login-page {
            background-image: url(img/logopnc.png); 
            background-image: url('https://www.transparenttextures.com/patterns/always-grey.png');
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .form-box {
            display: flex ; 
            flex-wrap: nowrap ; 
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            overflow: hidden;
            padding: 0 ; 
            
            height: 90% ; 
            width: 100% ;
            max-width: 70% ; 
        }

        .univ-identity-box {
            width: 58% ;
            flex: 0 0 58% ; 
            box-sizing: border-box !important; 
            background: #8ba2b5;
            background-size: cover !important; 
            
            display: flex !important;
            flex-direction: column;
            padding: 40px !important;
        }

        .univ-identity-box .univ-text {
            margin-top: auto; 
            position: relative;
            z-index: 2;
        }

        .form-login {
            width: 42% !important;
            flex: 0 0 42% !important; 
            background-color: #fff;
            box-sizing: border-box !important;

            display: flex !important;
            flex-direction: column;
            justify-content: center; 
            padding: 0 40px !important;
        }
        
        .form-login .logo {
            width: auto;
            max-width: 100px;
            border-radius: 0;
            margin: 0 auto 20px auto !important;
        }

        .title-login-email {
            position: relative;
            text-align: center;
            margin: 20px 0; 
            z-index: 1; 
        }
        .title-line {
            position: absolute;
            top: 50%; 
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #e0e0e0; 
            z-index: -1; 
        }
        .title-text {
            display: inline-block;
            background-color: #ffffff; 
            padding: 0 15px; 
            color: #8ba2b5; 
            margin: 0;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            body.login-page { padding: 20px; }
            .form-box {
                flex-direction: column !important;
                height: auto !important; 
            }
            .univ-identity-box, .form-login {
                width: 100% !important;
                flex: 0 0 100% !important;
            }
            .univ-identity-box { min-height: 250px !important; }
            .form-login { padding: 30px 20px !important; }
        }
    </style>
</head>

<body class="login-page">
    <div class="container">
        <div style="width: 100%; margin: 0; display: flex; justify-content: center;">
            <div class="form-box">
                
                <div class="univ-identity-box">
                    <div class="univ-text">
                        <h4 class="welcome text-light">Selamat Datang</h4>
                        <div class="clearfix"></div>
                        <h2 class="no-margin text-light">Sistem Informasi Akademik</h2>
                        <h3 class="no-margin"><b>Politeknik Negeri Cilacap</b></h3>
                    </div>
                </div>

                <div class="form-login" align="center">
                    <img src="{{ asset('img/logopnc.png') }}" class="logo" alt="Logo PNC">
                    
                    <b>
                        <span class="text-center" style="font-size:20px; font-weight: 600; display: block">Masuk dan Verifikasi</span>
                    </b>
                    <p style="margin-bottom: 15px;">
                        <strong>Baru!</strong> Nikmati kemudahan sistem autentikasi tunggal untuk mengakses semua layanan dengan satu akun.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable" style="text-align: left;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span>Email atau Password salah.</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="form-login" style="width: 100%;">
                        @csrf
                        <div class="login">
                            
                            <div style="margin: 0 0 20px 0;">
                                <a href="#" class="btn btn-default btn-block" style="font-weight: 600;">
                                    <img src="https://quantum.sevima.com/assets/images/logo-google.svg" alt=""> Google
                                </a>
                            </div>
                            
                            <div class="title-login-email">
                                <span class="title-line"></span>
                                <p class="title-text">atau lanjutkan dengan</p>
                            </div>
                            
                            <div class="form-group" style="text-align: left">
                                <span><strong>Email/akun pengguna</strong></span><span style="color:red">*</span>
                                <input type="email" name="email" id="email" class="form-control input-line" placeholder="Masukkan email yang terdaftar" required autofocus value="{{ old('email') }}">
                            </div>

                            <div class="form-group" style="text-align: left; margin-bottom: -5px;">
                                <span><strong>Password</strong></span><span style="color:red">*</span>
                                <div class="password" style="position: relative;">
                                    <input type="password" id="password" name="password" class="form-control input-line" placeholder="Masukkan password" required>
                                    <span id="iconshow" onclick="showPass()" class="fa fa-eye-slash" style="position: absolute; right: 10px; top: 12px; cursor: pointer;"></span>
                                </div>
                            </div>

                            @if (Route::has('password.request'))
                                <a style="font-size: 13px; padding: 10px 0px 25px 0px; text-decoration-line: underline; font-weight: 600;" href="{{ route('password.request') }}" class="text-center pull-right">Lupa kata sandi?</a>
                            @endif
                            <div class="clearfix"></div>

                            <div class="form-group" align="center">
                                <button type="submit" class="btn btn-flat btn-primary btn-block btn-login">Masuk</button>
                            </div>
                        </div>
                    </form>

                    <!-- <div style="margin-top: 30px; font-size: 14px">
                        <small>
                            <span class="text-center text-muted">Powered By</span>
                        </small>
                        <span class="text-center text-grey">
                            <a href="#" target="_blank"><img width="120" src="https://assets.siakadcloud.com/assets/v1/img/logo-sevima-platform-200.png" alt="Sevima"></a>
                        </span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://assets.siakadcloud.com/assets/v1/js/external/jquery.min.js"></script>
    <script type="text/javascript">
        function showPass() {
            var passInput = document.getElementById("password");
            var icon = document.getElementById("iconshow");
            
            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>