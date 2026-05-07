<!DOCTYPE html>
<html>
<head>
    <title>Validasi Surat PNC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow-lg border-0" style="width: 400px; border-radius: 15px;">
        <div class="card-body text-center p-5">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/Logo_Politeknik_Negeri_Cilacap.png" width="80" class="mb-4">
            
            @if($pengajuan->status == 'disetujui')
                <div class="text-success mb-3"><i class="fas fa-check-circle fa-4x"></i></div>
                <h4 class="font-weight-bold text-success">Surat SAH & VALID</h4>
                <hr>
                <p class="mb-1 text-muted">Nomor Surat</p>
                <h5 class="font-weight-bold text-dark">{{ $pengajuan->nomor_surat }}</h5>
                <p class="mb-1 mt-3 text-muted">Atas Nama</p>
                <h6 class="font-weight-bold text-dark">{{ $pengajuan->mahasiswa->name }} ({{ $pengajuan->mahasiswa->nim }})</h6>
            @elseif($pengajuan->status == 'ditolak')
                <div class="text-danger mb-3"><i class="fas fa-times-circle fa-4x"></i></div>
                <h4 class="font-weight-bold text-danger">Surat TIDAK SAH</h4>
                <hr>
                <p class="text-muted">Surat ini telah ditarik atau ditolak oleh sistem.</p>
            @else
                <div class="text-warning mb-3"><i class="fas fa-clock fa-4x"></i></div>
                <h4 class="font-weight-bold text-warning">Surat Masih Diproses</h4>
                <hr>
                <p class="text-muted">Surat ini belum mendapatkan persetujuan resmi.</p>
            @endif
            
            <div class="mt-4 pt-3 border-top text-muted small">
                Sistem e-Gang Politeknik Negeri Cilacap &copy; {{ date('Y') }}
            </div>
        </div>
    </div>
</body>
</html>