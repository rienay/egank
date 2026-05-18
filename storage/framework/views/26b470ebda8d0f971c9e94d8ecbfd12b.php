

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-0">Laporan & Export Data</h3>
            <p class="text-muted small">Cetak atau unduh data pengajuan magang mahasiswa</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-lg mb-4" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form action="<?php echo e(route('export.index')); ?>" method="GET" class="row align-items-end">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="font-weight-bold small text-muted">Tanggal Pengajuan (Dari)</label>
                    <input type="date" name="start_date" class="form-control shadow-sm" value="<?php echo e(request('start_date')); ?>" required>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="font-weight-bold small text-muted">Tanggal Pengajuan (Sampai)</label>
                    <input type="date" name="end_date" class="form-control shadow-sm" value="<?php echo e(request('end_date')); ?>" required>
                </div>
                <div class="col-md-4">
                    <div class="d-flex">
                        <button type="submit" class="btn text-white font-weight-bold px-4 shadow-sm flex-grow-1 mr-2" style="background:linear-gradient(135deg,#ff6b00,#ff8533); border-radius:10px;">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <a href="<?php echo e(route('export.index')); ?>" class="btn btn-light border shadow-sm" style="border-radius:10px;" title="Reset Filter">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body">
            <?php if(request('start_date') && request('end_date')): ?>
            <div class="alert border-0 shadow-sm mb-4" style="border-radius: 10px; background-color: #fff5f0; color: #ff6600;">
                <i class="fas fa-info-circle mr-2"></i> Menampilkan data pengajuan magang dari tanggal <b><?php echo e(\Carbon\Carbon::parse(request('start_date'))->format('d M Y')); ?></b> sampai <b><?php echo e(\Carbon\Carbon::parse(request('end_date'))->format('d M Y')); ?></b>.
            </div>
            <?php endif; ?>

            <div class="table-responsive mt-2">
                <table id="example1" class="table table-bordered table-striped table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Tgl Pengajuan</th>
                            <th>NIM / Mahasiswa</th>
                            <th>Prodi & Angkatan</th>
                            <th>Perusahaan Tujuan</th>
                            <th>Alamat Perusahaan</th>
                            <th>Jadwal Magang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($index + 1); ?></td>
                            <td><?php echo e($data->created_at->format('d/m/Y')); ?></td>
                            <td>
                                <span class="font-weight-bold text-dark"><?php echo e($data->nim); ?></span><br>
                                <?php echo e($data->nama); ?>

                            </td>
                            <td>
                                <?php echo e($data->prodi); ?> <span class="text-muted small">(A.<?php echo e($data->angkatan); ?>)</span>
                            </td>
                            <td class="font-weight-bold" style="color: #ff6b00;"><?php echo e($data->perusahaan); ?></td>
                            <td><?php echo e($data->alamat); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($data->tgl_mulai)->format('d/m/Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($data->tgl_selesai)->format('d/m/Y')); ?></td>
                            <td>
                                <?php
                                $statusMagang = $data->status_magang;
                                $statusLabel = 'Belum Validasi';
                                $statusClass = 'badge-secondary';

                                if ($statusMagang === 'Sedang Magang') {
                                $statusLabel = 'Sedang Magang';
                                $statusClass = 'badge-primary';
                                } elseif ($statusMagang === 'Selesai') {
                                $statusLabel = 'Selesai Magang';
                                $statusClass = 'badge-dark';
                                } elseif ($data->status === 'disetujui') {
                                $statusLabel = 'Sedang Magang';
                                $statusClass = 'badge-primary';
                                } elseif ($data->status === 'Menunggu Validasi' || $statusMagang === 'Belum Konfirmasi') {
                                $statusLabel = 'Belum Validasi';
                                $statusClass = 'badge-secondary';
                                }
                                ?>
                                <span class="badge <?php echo e($statusClass); ?> px-3 py-2"><?php echo e($statusLabel); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/export/index.blade.php ENDPATH**/ ?>