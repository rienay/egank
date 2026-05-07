<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIPM PNC</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --bg-soft: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', -apple-system, sans-serif; }
        
        body { 
            display: grid; 
            place-items: center; 
            min-height: 100vh; 
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 20px;
        }
        
        .container { 
            display: grid; 
            grid-template-columns: 1.1fr 1fr; 
            width: 1100px; 
            max-width: 98%; 
            min-height: 650px;
            background: #fff; 
            border-radius: 30px; 
            overflow: hidden; 
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.35);
        }

        .left { 
            background: linear-gradient(rgba(30, 64, 175, 0.85), rgba(37, 99, 235, 0.8)), 
                        url('{{ asset("img/logindepan.png") }}');
            background-size: cover; 
            background-position: center;
            padding: 60px; 
            color: #fff; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .right { 
            padding: 70px; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            background: #fff;
        }
        
        .header-text h2 { color: var(--text-dark); font-size: 36px; font-weight: 800; letter-spacing: -1px; }
        .header-text p { color: var(--text-light); font-size: 16px; margin: 10px 0 40px; line-height: 1.6; }

        .form-group { margin-bottom: 28px; }
        label { display: block; font-size: 14px; font-weight: 700; margin-bottom: 10px; color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.5px; }
        
        .input-wrapper { position: relative; }
        .input-wrapper .prefix-icon { 
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%); 
            color: #94a3b8; font-size: 18px; transition: color 0.3s;
        }

        .toggle-password {
            position: absolute; right: 18px; top: 50%; transform: translateY(-50%); 
            color: #94a3b8; cursor: pointer; font-size: 18px; transition: color 0.3s;
            z-index: 10;
        }

        .toggle-password:hover { color: var(--primary); }
        
        input { 
            width: 100%; padding: 18px 50px 18px 55px; 
            border: 2px solid #e2e8f0; border-radius: 15px; 
            font-size: 16px; outline: none; transition: all 0.3s ease;
            background: var(--bg-soft);
        }
        
        input:focus { 
            border-color: var(--primary); 
            background: #fff; 
            box-shadow: 0 0 0 5px rgba(37, 99, 235, 0.15); 
        }
        
        input:focus + .prefix-icon { color: var(--primary); }

        .btn { 
            background: var(--primary); color: #fff; border: none; padding: 20px; 
            width: 100%; border-radius: 15px; font-size: 18px; font-weight: 700; 
            cursor: pointer; transition: all 0.3s;
            box-shadow: 0 8px 20px -5px rgba(37, 99, 235, 0.4);
            margin-top: 10px;
        }

        .btn:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5); }

        .footer-note {
            margin-top: 40px; padding-top: 30px; border-top: 2px solid #f8fafc;
            font-size: 14px; color: var(--text-light); line-height: 1.6;
        }

        @media (max-width: 850px) {
            .container { grid-template-columns: 1fr; width: 500px; min-height: auto; }
            .left { display: none; }
            .right { padding: 50px 35px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="left">
        <div>
            <div style="font-weight: 900; font-size: 24px; display: flex; align-items: center; gap: 12px;">
                <div style="background: rgba(255,255,255,0.25); width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px; backdrop-filter: blur(5px);">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                SIPM PNC
            </div>
        </div>
        <div>
            <h1 style="font-size: 48px; font-weight: 800; line-height: 1.1; margin-bottom: 20px;">
                Melangkah Maju <br>Bersama PNC.
            </h1>
            <p style="opacity: 0.95; font-size: 18px; font-weight: 400; max-width: 350px; line-height: 1.6;">
                Sistem Informasi Layanan Surat Pengantaran Magang Terintegrasi.
            </p>
        </div>
    </div>

    <div class="right">
        <div class="header-text">
            <h2>Selamat Datang</h2>
            <p>Akses dashboard magang Anda dengan mudah dan aman.</p>
        </div>

        @if($errors->any()) 
            <div style="background: #fef2f2; color: #b91c1c; padding: 15px 20px; border-radius: 12px; font-size: 14px; margin-bottom: 30px; border: 1px solid #fee2e2; display: flex; align-items: center; gap: 10px;">
                <i class="fa fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email atau NIM</label>
                <div class="input-wrapper">
                    <input type="text" name="email" placeholder="Masukkan Email atau NIM Anda" required value="{{ old('email') }}">
                    <i class="fa fa-user prefix-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label>Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi Anda" required>
                    <i class="fa fa-lock prefix-icon"></i>
                    <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
                </div>
            </div>

            <button type="submit" class="btn">Masuk Sekarang</button>
        </form>
        
        <div class="footer-note">
            <p><strong>Butuh bantuan masuk?</strong></p>
            <p>Hubungi Unit Pelaksana Teknis (UPT) Komputer atau Admin Jurusan Anda.</p>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // Switch type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>