<h3>Halo, {{ $pengajuan->mahasiswa->name }}</h3>
<p>Surat pengajuanmu dengan keperluan <strong>{{ $pengajuan->keperluan }}</strong> telah <b>DISETUJUI</b>.</p>
<p>Nomor Surat: <strong>{{ $pengajuan->nomor_surat }}</strong></p>
<p>Kamu sudah dapat mengunduh surat yang telah dibubuhi tanda tangan elektronik (QR Code) melalui sistem e-Gang.</p>
<p><a href="{{ route('pengajuan_surat.pdf', $pengajuan->id) }}">Klik di sini untuk mengunduh PDF</a></p>
<p>Terima kasih.</p>