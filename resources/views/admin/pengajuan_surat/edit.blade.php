@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Edit Pengajuan Surat</h2>
        <p class="text-muted small">Perbarui informasi lengkap mahasiswa, perusahaan, dan detail surat</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengajuan_surat.index') }}" class="text-decoration-none text-muted">Surat Pengantar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('pengajuan_surat.update', $pengajuan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-person me-2"></i>Data Mahasiswa</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">NIM <span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('nim', $pengajuan->magang?->nim) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('nama', $pengajuan->magang?->nama) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small text-dark">Email Mahasiswa <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('email', $pengajuan->magang?->email) }}" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold small text-dark">Program Studi <span class="text-danger">*</span></label>
                                <input type="text" name="prodi" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('prodi', $pengajuan->magang?->prodi) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-dark">Angkatan <span class="text-danger">*</span></label>
                                <input type="text" name="angkatan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('angkatan', $pengajuan->magang?->angkatan) }}" required>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-building me-2"></i>Data Perusahaan</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small text-dark">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" name="perusahaan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('perusahaan', $pengajuan->magang?->perusahaan) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small text-dark">Alamat Perusahaan <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" rows="2" required>{{ old('alamat', $pengajuan->magang?->alamat) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_mulai" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('tgl_mulai', $pengajuan->magang?->tgl_mulai) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_selesai" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('tgl_selesai', $pengajuan->magang?->tgl_selesai) }}" required>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-file-earmark-text me-2"></i>Detail Surat</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_surat" class="form-select border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
                                    <option value="Surat Pengantar Magang" {{ old('jenis_surat', $pengajuan->jenis_surat) == 'Surat Pengantar Magang' ? 'selected' : '' }}>Surat Pengantar Magang</option>
                                    <option value="Surat Keterangan Magang" {{ old('jenis_surat', $pengajuan->jenis_surat) == 'Surat Keterangan Magang' ? 'selected' : '' }}>Surat Keterangan Magang</option>
                                    <option value="Surat Tugas" {{ old('jenis_surat', $pengajuan->jenis_surat) == 'Surat Tugas' ? 'selected' : '' }}>Surat Tugas</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Keperluan <span class="text-danger">*</span></label>
                                <input type="text" name="keperluan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;"
                                    value="{{ old('keperluan', $pengajuan->keperluan) }}" required>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end mb-4">
                    <a href="{{ route('pengajuan_surat.index') }}" class="btn btn-light px-4 py-2 fw-semibold" style="border-radius: 8px;">Batal</a>
                    <button type="submit" class="btn text-white px-4 py-2 fw-semibold shadow-none" style="background-color: #ff6b00; border-radius: 8px;">
                        <i class="bi bi-save me-2"></i>Simpan Semua Perubahan
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 text-dark border-bottom pb-2">Status & Metadata</h6>

                        <div class="mb-3">
                            <label class="text-muted extra-small d-block mb-1 text-uppercase fw-bold">Status Saat Ini</label>
                            <span class="badge rounded-pill px-3 py-2 
                                {{ $pengajuan->status === 'disetujui' ? 'bg-success bg-opacity-10 text-success' : 
                                   ($pengajuan->status === 'pending' ? 'bg-warning bg-opacity-10 text-warning' : 
                                   'bg-danger bg-opacity-10 text-danger') }}">
                                {{ strtoupper($pengajuan->status) }}
                            </span>
                        </div>

                        @if($pengajuan->nomor_surat)
                        <div class="mb-3">
                            <label class="text-muted extra-small d-block mb-1 text-uppercase fw-bold">Nomor Surat</label>
                            <p class="fw-bold text-primary mb-0">{{ $pengajuan->nomor_surat }}</p>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="text-muted extra-small d-block mb-1 text-uppercase fw-bold">Waktu Pengajuan</label>
                            <p class="text-dark small mb-0">{{ $pengajuan->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted extra-small d-block mb-1 text-uppercase fw-bold">Terakhir Diubah</label>
                            <p class="text-dark small mb-0">{{ $pengajuan->updated_at->format('d F Y, H:i') }} WIB</p>
                        </div>

                        @if($pengajuan->alasan_penolakan)
                        <div class="p-3 bg-danger bg-opacity-10 rounded-3 mt-4">
                            <label class="text-danger extra-small d-block mb-1 text-uppercase fw-bold">Alasan Penolakan</label>
                            <p class="text-danger small mb-0 fst-italic">"{{ $pengajuan->alasan_penolakan }}"</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .extra-small {
        font-size: 0.7rem;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        border: 1px solid #ff6b0044 !important;
        background-color: #fff !important;
    }

    hr {
        border-top: 1px solid #eee;
    }
</style>
@endsection