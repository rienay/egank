<h3>Halo, {{ $pengajuan->mahasiswa->name }}</h3>

<p>Mohon maaf, pengajuan <strong>{{ $pengajuan->jenis_surat }}</strong> Anda <strong>Ditolak</strong>.</p>

<ul>
    <li><strong>Keperluan:</strong> {{ $pengajuan->keperluan }}</li>
    <li><strong>Alasan Penolakan:</strong> <span style="color: red;">{{ $pengajuan->alasan_penolakan }}</span></li>
</ul>

<p>Silakan perbaiki persyaratan atau hubungi admin untuk informasi lebih lanjut.</p>
<p>Terima kasih.</p>
