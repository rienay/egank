<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Surat Disetujui</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background-color: #28a745; color: white; padding: 10px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .content p { margin-bottom: 15px; }
        .details { background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; }
        .button { display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pengajuan Surat Disetujui</h2>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $pengajuan->mahasiswa?->name ?? 'Mahasiswa' }}</strong>,</p>
            <p>Kabar baik! Pengajuan surat Anda untuk keperluan magang di <strong>{{ $pengajuan->magang?->perusahaan ?? 'Perusahaan' }}</strong> telah <strong>DISETUJUI</strong>.</p>
            
            <div class="details">
                <p style="margin-bottom: 5px;"><strong>Nomor Surat:</strong></p>
                <p style="margin-top: 0;">{{ $pengajuan->nomor_surat }}</p>
            </div>

            <p style="margin-top: 20px;">Anda dapat mengunduh surat resmi yang telah dilengkapi dengan QR Code validasi melalui tautan di bawah ini atau melalui halaman riwayat di sistem e-Gang.</p>
            
            <p style="text-align: center; margin-top: 25px; margin-bottom: 25px;">
                <a href="{{ route('pengajuan_surat.pdf', $pengajuan->id) }}" class="button">Unduh Surat PDF</a>
            </p>
        </div>
        <div class="footer">
            <p>Sistem e-Gang &copy; {{ date('Y') }} Politeknik Negeri Cilacap</p>
        </div>
    </div>
</body>
</html>