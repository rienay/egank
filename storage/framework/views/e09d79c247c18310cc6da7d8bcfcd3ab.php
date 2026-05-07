

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark mb-1">Detail Pengajuan Surat Magang</h2>
            <p class="text-muted small">Informasi lengkap pengajuan dari mahasiswa</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('pengajuan_surat.index')); ?>" class="text-decoration-none text-muted">Surat Pengantar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-3">
        <!-- Kolom Utama: Data Detail -->
        <div class="col-lg-8">
            
            <!-- 1. Informasi Status & Surat -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-info-circle me-2"></i>Informasi Pengajuan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <th width="200">Status</th>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2
                                        <?php echo e($pengajuan->status == 'disetujui' ? 'bg-success bg-opacity-10 text-success' : 
                                           ($pengajuan->status == 'ditolak' ? 'bg-danger bg-opacity-10 text-danger' : 
                                           'bg-warning bg-opacity-10 text-warning')); ?>">
                                        <?php echo e(strtoupper($pengajuan->status)); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor Surat</th>
                                <td><strong class="text-dark"><?php echo e($pengajuan->nomor_surat ?? 'Menunggu Persetujuan'); ?></strong></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kirim</th>
                                <td><?php echo e($pengajuan->created_at->format('d F Y, H:i')); ?> WIB</td>
                            </tr>
                            <?php if($pengajuan->status == 'ditolak'): ?>
                            <tr class="bg-danger bg-opacity-10">
                                <th class="text-danger">Alasan Penolakan</th>
                                <td class="text-danger fw-bold"><?php echo e($pengajuan->alasan_penolakan); ?></td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 2. Data Mahasiswa & Perusahaan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-person-workspace me-2"></i>Data Mahasiswa & Magang</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tr class="bg-light"><th colspan="2" class="px-4 py-2">Identitas Mahasiswa</th></tr>
                            <tr>
                                <th width="200" class="ps-4">NIM</th>
                                <td><?php echo e($pengajuan->magang?->nim); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-4">Nama Lengkap</th>
                                <td><?php echo e($pengajuan->magang?->nama); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-4">Email</th>
                                <td><?php echo e($pengajuan->magang?->email); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-4">Prodi / Angkatan</th>
                                <td><?php echo e($pengajuan->magang?->prodi); ?> / <?php echo e($pengajuan->magang?->angkatan); ?></td>
                            </tr>

                            <tr class="bg-light"><th colspan="2" class="px-4 py-2">Detail Tempat Magang</th></tr>
                            <tr>
                                <th class="ps-4">Nama Perusahaan</th>
                                <td><strong><?php echo e($pengajuan->magang?->perusahaan); ?></strong></td>
                            </tr>
                            <tr>
                                <th class="ps-4">Alamat Perusahaan</th>
                                <td><?php echo e($pengajuan->magang?->alamat); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-4">Periode</th>
                                <td>
                                    <?php echo e(\Carbon\Carbon::parse($pengajuan->magang?->tgl_mulai)->format('d M Y')); ?> 
                                    s/d 
                                    <?php echo e(\Carbon\Carbon::parse($pengajuan->magang?->tgl_selesai)->format('d M Y')); ?>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 3. File Lampiran / Surat Pendukung -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="bi bi-paperclip me-2"></i>Dokumen Lampiran</h5>
                </div>
                <div class="card-body">
                    <?php
                        // Asumsi file_pendukung disimpan sebagai array/JSON di database
                        $files = is_array($pengajuan->magang?->file_pendukung) 
                                 ? $pengajuan->magang->file_pendukung 
                                 : json_decode($pengajuan->magang?->file_pendukung ?? '[]', true);
                    ?>

                    <?php if(count($files) > 0): ?>
                    <div class="row g-3">
                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0 me-3">
                                    <?php $ext = pathinfo($file, PATHINFO_EXTENSION); ?>
                                    <?php if(in_array($ext, ['jpg','jpeg','png'])): ?>
                                        <i class="bi bi-file-earmark-image text-primary fs-2"></i>
                                    <?php else: ?>
                                        <i class="bi bi-file-earmark-pdf text-danger fs-2"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <p class="text-dark fw-semibold text-truncate mb-1"><?php echo e(basename($file)); ?></p>
                                    <div class="d-flex gap-2">
                                        <a href="<?php echo e(asset('storage/' . $file)); ?>" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2">Lihat</a>
                                        <a href="<?php echo e(asset('storage/' . $file)); ?>" download class="btn btn-sm btn-outline-secondary py-0 px-2">Unduh</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Tidak ada file lampiran yang diunggah.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar Aksi (Kanan) -->
        <div class="col-lg-4">
            <!-- QR Code (Hanya jika disetujui) -->
            <?php if($pengajuan->status == 'disetujui' && $pengajuan->qr_code): ?>
            <div class="card shadow-sm border-0 mb-3 text-center">
                <div class="card-body">
                    <p class="fw-bold mb-2 small">QR Code Surat</p>
                    <img src="<?php echo e(asset('storage/' . $pengajuan->qr_code)); ?>" class="img-fluid border p-2 mb-2" style="max-width: 150px;">
                    <p class="text-muted extra-small mb-0">Digunakan untuk validasi dokumen</p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Panel Aksi -->
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Aksi Admin</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <?php if($pengajuan->status == 'pending'): ?>
                    <form action="<?php echo e(route('pengajuan_surat.approve', $pengajuan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success w-100 mb-2 py-2" onclick="return confirm('Setujui surat ini?')">
                            <i class="bi bi-check2-circle me-1"></i> Setujui & Beri Nomor
                        </button>
                    </form>

                    <button type="button" class="btn btn-danger py-2" data-toggle="modal" data-target="#rejectModal">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengajuan
                    </button>
                    <?php endif; ?>

                    <?php if($pengajuan->status == 'disetujui'): ?>
                    <a href="<?php echo e(route('pengajuan_surat.pdf', $pengajuan->id)); ?>" target="_blank" class="btn btn-primary py-2">
                        <i class="bi bi-printer me-1"></i> Cetak Surat Pengantar
                    </a>
                    <?php endif; ?>

                    <hr class="my-3">

                    <a href="<?php echo e(route('pengajuan_surat.edit', $pengajuan->id)); ?>" class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit Data
                    </a>

                    <form action="<?php echo e(route('pengajuan_surat.destroy', $pengajuan->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 mt-2" onclick="return confirm('Hapus data pengajuan?')">
                            <i class="bi bi-trash me-1"></i> Hapus Pengajuan
                        </button>
                    </form>

                    <a href="<?php echo e(route('pengajuan_surat.index')); ?>" class="btn btn-light btn-sm mt-3">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak (Wajib isi alasan) -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Penolakan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('pengajuan_surat.reject', $pengajuan->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <label class="form-label fw-bold small">Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea name="alasan_penolakan" class="form-control" rows="4" placeholder="Sebutkan alasan (misal: File pendukung tidak terbaca atau data tidak sesuai)" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/pengajuan_surat/show.blade.php ENDPATH**/ ?>