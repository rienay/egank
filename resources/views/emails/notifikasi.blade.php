<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Berhasil</title>
</head>
<body style="font-family: 'Inter', Arial, sans-serif; color: #333; line-height: 1.6; background-color: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        
        <h2 style="color: #ea580c; margin-top: 0;">Halo, {{ $dataPengajuan['nama'] }}!</h2>
        
        <p style="color: #475569;">Pengajuan surat magang kamu melalui portal e-Surat Politeknik Negeri Cilacap telah <strong style="color: #16a34a;">berhasil kami terima</strong>.</p>
        
        <div style="background-color: #f8fafc; padding: 20px; border-radius: 8px; margin: 25px 0; border: 1px solid #e2e8f0;">
            <p style="margin: 0; font-size: 14px; color: #64748b;">NIM</p>
            <p style="margin: 0 0 15px 0; font-weight: bold; color: #1e293b;">{{ $dataPengajuan['nim'] }}</p>

            <p style="margin: 0; font-size: 14px; color: #64748b;">Tujuan Instansi</p>
            <p style="margin: 0 0 15px 0; font-weight: bold; color: #1e293b;">{{ $dataPengajuan['perusahaan'] }}</p>
            
            <p style="margin: 0; font-size: 14px; color: #64748b;">Status Saat Ini</p>
            <p style="margin: 0; font-weight: bold; color: #eab308;">Menunggu Validasi Admin ⏳</p>
        </div>

        <p style="color: #475569;">Surat kamu akan diproses dalam 2-3 hari kerja. Kami akan mengirimkan email notifikasi kembali jika surat sudah disetujui atau jika ada perbaikan berkas.</p>
        
        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">
        
        <p style="margin: 0; color: #64748b; font-size: 14px;">Salam hangat,</p>
        <p style="margin: 5px 0 0 0; font-weight: bold; color: #1e293b;">Koordinator Jurusan</p>
        <p style="margin: 0; color: #64748b; font-size: 12px;">Jurusan Komputer dan Bisnis</p>
    </div>
</body>
</html>