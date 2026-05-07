<!DOCTYPE html>
<html>
<head>
    <title>Informasi Akun e-Gang</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Halo, {{ $user->name }}!</h2>
    <p>Akun mahasiswa Anda untuk sistem pengajuan magang <strong>e-Gang</strong> telah berhasil dibuat oleh Administrator.</p>
    
    <p>Berikut adalah detail login Anda:</p>
    <ul>
        <li><strong>Username (NIM) :</strong> {{ $user->nim }}</li>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Password :</strong> {{ $password }}</li>
    </ul>
    
    <p>Silakan login menggunakan NIM atau Email Anda, dan kami sangat menyarankan Anda untuk segera mengubah password setelah berhasil masuk demi keamanan.</p>
    <p>Terima kasih,<br>Admin e-Gang</p>
</body>
</html>