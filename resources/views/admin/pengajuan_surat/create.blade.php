<form action="{{ route('pengajuan_surat.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if(request('magang_id'))
        <!-- Tangkap magang_id dari parameter URL tombol "Buat Surat" -->
        <input type="hidden" name="magang_id" value="{{ request('magang_id') }}">
    @else
        <!-- Jika dibuat manual dari tombol tambah, wajib pilih data magang -->
        <div class="alert alert-warning mb-4 border-0" style="border-radius: 12px; background-color: #fffaf0;">
            <label class="form-label fw-semibold small text-dark">Pilih Data Pengajuan Magang <span class="text-danger">*</span></label>
            <select name="magang_id" class="form-select" required>
                <option value="">-- Pilih Mahasiswa yang Disetujui --</option>
                @foreach($magangList as $magang)
                    <option value="{{ $magang->id }}">{{ $magang->nim }} - {{ $magang->nama }} ({{ $magang->perusahaan }})</option>
                @endforeach
            </select>
        </div>
    @endif

    <!-- Alert Info -->
    <div class="alert alert-sm p-3 mb-4 border-0" style="background-color: #fff5f0; border-radius: 12px;">
        <div class="d-flex align-items-center">
            <i class="bi bi-person-plus-fill me-2" style="color: #ff6600;"></i>
            <i class="bi bi-person-plus-fill me-2" style="color: #f97316;"></i>
            <span class="small text-muted">Admin: Masukkan data mahasiswa dan perusahaan secara manual untuk menerbitkan surat resmi.</span>
        </div>
    </div>

    <!-- DATA MAHASISWA -->
    <div class="row g-3 mb-4">
        <div class="col-12"><h6 class="fw-bold text-primary mb-2">I. Data Mahasiswa</h6></div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold small">NIM <span class="text-danger">*</span></label>
            <input type="text" name="nim" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: 240102122" required>
        </div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Nama Lengkap Mahasiswa" required>
        </div>

        <div class="col-md-12">
            <label class="form-label fw-semibold small">Email Mahasiswa <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="nama@pnc.ac.id" required>
        </div>

        <div class="col-md-8">
            <label class="form-label fw-semibold small">Program Studi <span class="text-danger">*</span></label>
            <input type="text" name="prodi" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: Teknik Informatika" required>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-semibold small">Angkatan <span class="text-danger">*</span></label>
            <input type="number" name="angkatan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="2024" required>
        </div>
    </div>

    <!-- DATA PERUSAHAAN -->
    <div class="row g-3 mb-4">
        <div class="col-12"><h6 class="fw-bold text-primary mb-2">II. Data Perusahaan & Magang</h6></div>
        
        <div class="col-md-12">
            <label class="form-label fw-semibold small">Nama Perusahaan/Instansi <span class="text-danger">*</span></label>
            <input type="text" name="perusahaan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: PT. Teknologi Maju" required>
        </div>

        <div class="col-md-12">
            <label class="form-label fw-semibold small">Alamat Perusahaan <span class="text-danger">*</span></label>
            <textarea name="alamat" class="form-control border-0 py-2 px-3" rows="2" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Jl. Raya No. 123..." required></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold small">Tanggal Mulai <span class="text-danger">*</span></label>
            <input type="date" name="tgl_mulai" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold small">Tanggal Selesai <span class="text-danger">*</span></label>
            <input type="date" name="tgl_selesai" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
        </div>
    </div>

    <!-- JENIS SURAT & KEPERLUAN -->
    <div class="row g-3 mb-4">
        <div class="col-12"><h6 class="fw-bold text-primary mb-2">III. Jenis & Keperluan Surat</h6></div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold small">Jenis Surat <span class="text-danger">*</span></label>
            <select name="jenis_surat" class="form-select border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
                <option value="">Pilih Jenis</option>
                <option value="Surat Pengantar Magang">Surat Pengantar Magang</option>
                <option value="Surat Keterangan Magang">Surat Keterangan Magang</option>
                <option value="Surat Tugas">Surat Tugas</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold small">Keperluan <span class="text-danger">*</span></label>
            <input type="text" name="keperluan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: Pengajuan Magang Industri" required>
        </div>

        <!-- Optional: Upload file oleh admin jika ada -->
        <div class="col-md-12">
            <label class="form-label fw-semibold small">Upload File Pendukung (Opsional)</label>
            <input type="file" name="file_pendukung[]" multiple class="form-control border-0 px-3" style="background-color: #f3f4f6; border-radius: 8px;">
        </div>
    </div>

    <!-- Footer Buttons -->
    <div class="row g-3 pt-3 border-top mt-4">
        <div class="col-6">
            <button type="button" class="btn btn-outline-secondary w-100 py-2 fw-semibold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
        </div>
        <div class="col-6">
            <button type="submit" class="btn text-white w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" 
                    style="background-color: #ff6b00; border-radius: 10px;">
                    style="background-color: #3b82f6; border-radius: 10px; border: none;">
                <i class="bi bi-save"></i> Simpan & Buat Surat
            </button>
        </div>
    </div>
</form>