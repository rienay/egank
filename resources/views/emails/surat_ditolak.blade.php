<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Surat Ditolak</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background-color: #dc3545; color: white; padding: 10px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .content p { margin-bottom: 15px; }
        .reason { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pengajuan Surat Ditolak</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $pengajuan->mahasiswa?->name ?? 'Mahasiswa' }}</strong>,</p>
            <p>Dengan menyesal kami informasikan bahwa pengajuan surat Anda untuk keperluan magang di <strong>{{ $pengajuan->magang?->perusahaan ?? 'Perusahaan' }}</strong> telah <strong>DITOLAK</strong>.</p>
            
            <p><strong>Alasan Penolakan:</strong></p>
            <div class="reason">
                <p>{{ $pengajuan->alasan_penolakan }}</p>
            </div>

            <p>Silakan perbaiki data pengajuan Anda atau hubungi pihak administrasi jika memerlukan informasi lebih lanjut. Anda dapat melihat riwayat pengajuan Anda di sistem e-Gang.</p>
        </div>
        <div class="footer">
            <p>Sistem e-Gang &copy; {{ date('Y') }} Politeknik Negeri Cilacap</p>
        </div>
    </div>
</body>
</html>