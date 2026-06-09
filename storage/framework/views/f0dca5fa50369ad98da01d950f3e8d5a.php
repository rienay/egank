

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-4">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-dark mb-1">Surat Pengantar Magang</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active text-primary fw-medium" aria-current="page">Surat Pengantar</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <?php
        $stats = [
        ['label' => 'Total Pengajuan', 'value' => $pengajuans->total(), 'color' => '#0d6efd', 'bg' => '#f0f7ff', 'icon' => 'bi-files'],
        ['label' => 'Menunggu', 'value' => $total_pending ?? 0, 'color' => '#fd7e14', 'bg' => '#fffaf0', 'icon' => 'bi-clock-history'],
        ['label' => 'Disetujui', 'value' => $total_disetujui ?? 0, 'color' => '#198754', 'bg' => '#f0fff4', 'icon' => 'bi-check-circle'],
        ['label' => 'Ditolak', 'value' => $total_ditolak ?? 0, 'color' => '#dc3545', 'bg' => '#fff5f5', 'icon' => 'bi-x-octagon']
        ];
        ?>

        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $cardStyle = "background-color: {$stat['bg']}; border-bottom: 3px solid {$stat['color']} !important;";
        $textStyle = "color: {$stat['color']};";
        ?>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 stat-card" style="<?php echo e($cardStyle); ?>">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="fw-semibold small mb-1" style="<?php echo e($textStyle); ?>"><?php echo e($stat['label']); ?></p>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo e($stat['value']); ?></h3>
                    </div>
                    <div class="icon-shape rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; <?php echo e($textStyle); ?>">
                        <i class="bi <?php echo e($stat['icon']); ?> fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="card-header bg-white py-3 border-0">
            <form action="<?php echo e(route('pengajuan_surat.index')); ?>" method="GET">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-0"
                                placeholder="Cari berdasarkan NIM, Nama, atau Perusahaan..."
                                value="<?php echo e(request('search')); ?>" style="font-size: 0.9rem;">
                            <button type="submit" class="btn btn-primary px-3" style="background-color: #ff6b00; border: none;">Cari</button>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end d-flex gap-2 justify-content-md-end">
                        <select name="status" class="form-select border-light bg-light d-inline-block w-auto"
                            style="font-size: 0.9rem;" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="disetujui" <?php echo e(request('status') == 'disetujui' ? 'selected' : ''); ?>>Disetujui</option>
                            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Menunggu</option>
                            <option value="ditolak" <?php echo e(request('status') == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                        </select>

                        <?php if(request('search') || request('status')): ?>
                        <a href="<?php echo e(route('pengajuan_surat.index')); ?>" class="btn btn-light border-0 text-muted" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <?php if($pengajuans->count() > 0): ?>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4" style="width: 50px;">#</th>
                            <th>Detail Mahasiswa</th>
                            <th>Perusahaan</th>
                            <th>Periode Magang</th>
                            <th style="width: 150px;">Status</th>
                            <th class="pe-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengajuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="ps-4 text-muted"><?php echo e($pengajuans->firstItem() + $loop->index); ?></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark mb-0"><?php echo e($pengajuan->magang?->nama ?? 'N/A'); ?></span>
                                    <span class="text-muted extra-small"><?php echo e($pengajuan->magang?->nim); ?> | <?php echo e($pengajuan->magang?->prodi); ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium text-dark"><?php echo e($pengajuan->magang?->perusahaan ?? '-'); ?></span>
                            </td>
                            <td>
                                <div class="badge bg-light text-dark fw-normal border">
                                    <i class="bi bi-calendar3 me-1 text-primary"></i>
                                    <?php if($pengajuan->magang?->tgl_mulai): ?>
                                    <?php echo e(\Carbon\Carbon::parse($pengajuan->magang->tgl_mulai)->format('d M')); ?> - <?php echo e(\Carbon\Carbon::parse($pengajuan->magang->tgl_selesai)->format('d M Y')); ?>

                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <button type="button" 
                                    class="btn btn-sm w-100 d-flex justify-content-between align-items-center fw-medium status-btn <?php echo e($pengajuan->status); ?>"
                                    onclick="openStatusModal(<?php echo e($pengajuan->id); ?>, '<?php echo e($pengajuan->status); ?>', <?php echo e(Js::from($pengajuan->magang?->nama ?? 'N/A')); ?>)">
                                    <span>
                                        <?php if($pengajuan->status === 'pending'): ?> ⏳ Menunggu
                                        <?php elseif($pengajuan->status === 'disetujui'): ?> ✅ Disetujui
                                        <?php else: ?> ❌ Ditolak
                                        <?php endif; ?>
                                    </span>
                                    <i class="bi bi-chevron-down ms-2 opacity-50"></i>
                                </button>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                                    <a href="<?php echo e(route('pengajuan_surat.show', $pengajuan->id)); ?>" class="btn btn-white btn-sm border" title="Lihat"><i class="bi bi-eye text-primary"></i></a>
                                    <a href="<?php echo e(route('pengajuan_surat.edit', $pengajuan->id)); ?>" class="btn btn-white btn-sm border" title="Edit"><i class="bi bi-pencil text-secondary"></i></a>
                                    <?php if($pengajuan->status === 'disetujui'): ?>
                                    <a href="<?php echo e(route('pengajuan_surat.pdf', $pengajuan->id)); ?>" class="btn btn-white btn-sm border" title="Unduh"><i class="bi bi-download text-success"></i></a>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('pengajuan_surat.destroy', $pengajuan->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button onclick="return confirm('Hapus pengajuan ini?')" class="btn btn-white btn-sm border" title="Hapus"><i class="bi bi-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3 border-top bg-light-subtle">
                <div class="row align-items-center">
                    <div class="col-sm-6 text-center text-sm-start mb-2 mb-sm-0 text-muted small">
                        Menampilkan <strong><?php echo e($pengajuans->firstItem()); ?></strong> - <strong><?php echo e($pengajuans->lastItem()); ?></strong> dari <strong><?php echo e($pengajuans->total()); ?></strong> pengajuan
                    </div>
                    <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end">
                        <?php echo e($pengajuans->appends(request()->input())->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>

            <?php else: ?>
            <div class="py-5 text-center bg-white">
                <i class="bi bi-inbox text-muted opacity-25" style="font-size: 4rem;"></i>
                <h5 class="text-muted fw-semibold mt-3">Data Tidak Ditemukan</h5>
                <p class="text-muted small">Coba sesuaikan kata kunci pencarian atau filter Anda.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <form id="statusForm" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Update Status Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4">Pilih status baru untuk pengajuan surat atas nama <strong id="statusStudentName"></strong>.</p>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-4">
                            <input type="radio" class="btn-check status-radio" name="status_pilihan" id="status_pending" value="pending" autocomplete="off">
                            <label class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center p-3 rounded-3 border-2" for="status_pending">
                                <i class="bi bi-clock-history fs-3 mb-2"></i>
                                <span class="fw-semibold small">Pending</span>
                            </label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="btn-check status-radio" name="status_pilihan" id="status_disetujui" value="disetujui" autocomplete="off">
                            <label class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center p-3 rounded-3 border-2" for="status_disetujui">
                                <i class="bi bi-check-circle fs-3 mb-2"></i>
                                <span class="fw-semibold small">Disetujui</span>
                            </label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="btn-check status-radio" name="status_pilihan" id="status_ditolak" value="ditolak" autocomplete="off">
                            <label class="btn btn-outline-danger w-100 h-100 d-flex flex-column align-items-center p-3 rounded-3 border-2" for="status_ditolak">
                                <i class="bi bi-x-circle fs-3 mb-2"></i>
                                <span class="fw-semibold small">Ditolak</span>
                            </label>
                        </div>
                    </div>

                    <div id="alasanPenolakanContainer" class="mt-3 d-none">
                        <label class="form-label small fw-bold text-danger">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control bg-light border-0" rows="3" placeholder="Masukkan alasan mengapa surat ini ditolak..."></textarea>
                    </div>
                </div>
                
                <div id="statusFooter" class="modal-footer border-0 bg-light p-3 d-none justify-content-end rounded-bottom-3" style="border-radius: 0 0 12px 12px;">
                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold" id="btnSubmitStatus">
                        <!-- Text Tombol Dinamis -->
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }

    .extra-small {
        font-size: 0.75rem;
    }

    .stat-card {
        transition: transform 0.2s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .table thead th {
        background-color: #fcfcfc;
        border-bottom: 1px solid #eee;
        color: #888;
        letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
        background-color: #fafafa;
    }

    .status-btn {
        border: 1px solid #eee;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        text-align: left;
    }

    .status-btn.disetujui {
        color: #198754;
        background-color: #f0fff4;
        border-color: #19875444;
    }

    .status-btn.pending {
        color: #fd7e14;
        background-color: #fffaf0;
        border-color: #fd7e1444;
    }

    .status-btn.ditolak {
        color: #dc3545;
        background-color: #fff5f5;
        border-color: #dc354544;
    }

    .status-btn:hover {
        filter: brightness(0.95);
    }

    .btn-check:checked + .btn-outline-warning {
        color: #fff !important;
    }

    .btn-white {
        background: #fff;
        border: 1px solid #eee;
    }

    .btn-white:hover {
        background: #f8f9fa;
    }

    .pagination {
        margin-bottom: 0;
    }
</style>

<script>
    let currentPengajuanId = null;

    function openStatusModal(id, currentStatus, studentName) {
        currentPengajuanId = id;
        document.getElementById('statusStudentName').innerText = studentName;
        
        // Reset Modal ke kondisi default
        document.getElementById('statusForm').reset();
        document.querySelectorAll('.status-radio').forEach(r => r.checked = false);
        document.getElementById('alasanPenolakanContainer').classList.add('d-none');
        document.getElementById('statusFooter').classList.add('d-none');
        
        const modal = new bootstrap.Modal(document.getElementById('statusModal'));
        modal.show();
    }

    document.querySelectorAll('.status-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            // Tampilkan tombol batal & kirim begitu status dipilih
            document.getElementById('statusFooter').classList.remove('d-none');
            
            const form = document.getElementById('statusForm');
            const alasanContainer = document.getElementById('alasanPenolakanContainer');
            const alasanInput = document.getElementById('alasan_penolakan');
            const btnSubmit = document.getElementById('btnSubmitStatus');
            
            if (this.value === 'ditolak') {
                form.action = `/admin/pengajuan_surat/${currentPengajuanId}/reject`;
                alasanContainer.classList.remove('d-none');
                alasanInput.setAttribute('required', 'required');
                btnSubmit.className = 'btn btn-danger px-4 fw-semibold';
                btnSubmit.innerHTML = '<i class="bi bi-envelope-paper me-2"></i>Tolak & Kirim Email';
            } else if (this.value === 'disetujui') {
                form.action = `/admin/pengajuan_surat/${currentPengajuanId}/approve`;
                alasanContainer.classList.add('d-none');
                alasanInput.removeAttribute('required');
                btnSubmit.className = 'btn btn-success px-4 fw-semibold';
                btnSubmit.innerHTML = '<i class="bi bi-envelope-paper me-2"></i>Setujui & Kirim Email';
            } else {
                form.action = `/admin/pengajuan_surat/${currentPengajuanId}/resubmit`;
                alasanContainer.classList.add('d-none');
                alasanInput.removeAttribute('required');
                btnSubmit.className = 'btn btn-warning text-dark px-4 fw-semibold';
                btnSubmit.innerHTML = '<i class="bi bi-arrow-clockwise me-2"></i>Ubah ke Pending';
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/pengajuan_surat/index.blade.php ENDPATH**/ ?>