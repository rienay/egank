<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - PNC</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .box { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #2c3e50; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #2c3e50; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .error { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Daftar Akun Baru</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <input type="email" name="email" placeholder="Email (Contoh: mhs@pnc.ac.id)" value="{{ old('email') }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <input type="password" name="password" placeholder="Password (Minimal 8 karakter)" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror

            <input type="password" name="password_confirmation" placeholder="Ulangi Password" required>

            <button type="submit">Daftar Sekarang</button>
        </form>

        <p style="text-align: center; font-size: 13px; margin-top: 20px;">
            Sudah punya akun? <a href="{{ route('login.form') }}">Login di sini</a>
        </p>
    </div>
</body>
</html>