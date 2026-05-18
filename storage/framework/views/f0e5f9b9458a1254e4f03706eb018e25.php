

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-orange: #ff782d;
        --light-orange: #fff4ed;
        --soft-gray: #f8f9fa;
        --text-dark: #2d3748;
    }

    .card-modern {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
    }

    .content-header-modern {
        padding: 1.5rem 0;
    }

    .table thead th {
        background-color: var(--soft-gray);
        color: #8a92a6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1.2rem 1rem;
    }

    .table tbody td {
        padding: 1.2rem 1rem;
        border-bottom: 1px solid #f1f1f1;
        color: #495057;
        vertical-align: middle;
    }

    .avatar-circle {
        width: 42px !important;
        height: 42px !important;
        background-color: var(--light-orange) !important;
        color: var(--primary-orange) !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 10px !important;
        font-weight: 700;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .nim-badge {
        background: #f1f2f4;
        color: #5e6c84;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 0.85rem;
    }

    .btn-orange {
        background-color: var(--primary-orange);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-orange:hover {
        background-color: #e6631f;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 120, 45, 0.3);
    }

    .action-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin: 0 2px;
        transition: all 0.2s ease-in-out;
        border: none;
        background: var(--soft-gray);
        color: #6c757d;
        font-size: 1.1rem;
    }

    .action-btn:hover {
        background: var(--light-orange);
        color: var(--primary-orange);
        transform: scale(1.1);
    }

    .btn-reset:hover {
        background: #fff9db !important;
        color: #f59e0b !important;
    }

    .btn-delete:hover {
        background: #fff0f0 !important;
        color: #dc3545 !important;
    }

    .alert-modern {
        background-color: #ffffff !important;
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05) !important;
        padding: 1rem 1.5rem !important;
        border-left: 5px solid var(--primary-orange) !important;
    }

    .alert-icon-box {
        width: 40px !important;
        height: 40px !important;
        background-color: var(--light-orange) !important;
        color: var(--primary-orange) !important;
        border-radius: 10px !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .btn-close-modern {
        background: none;
        border: none;
        color: #ced4da;
        font-size: 1.2rem;
        padding: 0;
        line-height: 1;
        transition: color 0.2s;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-close-modern:hover {
        color: var(--primary-orange);
    }
</style>

<div class="container-fluid px-4">
    <div class="content-header-modern d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold m-0" style="color: var(--text-dark);">Data Mahasiswa</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    <li class="breadcrumb-item small"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item active text-orange small fw-bold" style="color: var(--primary-orange) !important;">Mahasiswa</li>
                </ol>
            </nav>
        </div>
        <a href="<?php echo e(route('user.create')); ?>" class="btn btn-orange shadow-sm d-flex align-items-center">
            <i class="bi bi-plus-lg me-2"></i> Tambah Mahasiswa
        </a>
    </div>

    <?php if(session()->has('success')): ?>
        <div id="success-alert" class="alert alert-modern alert-dismissible fade show mb-4 border-0" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box me-3">
                    <i class="bi bi-check2-circle fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-bold text-dark" style="font-size: 0.95rem;">Berhasil!</div>
                    <div class="text-secondary small"><?php echo e(session('success')); ?></div>
                </div>

                <button type="button" class="btn-close-modern ms-auto" data-bs-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    let alertElement = document.getElementById('success-alert');
                    if (alertElement) {
                        let bsAlert = new bootstrap.Alert(alertElement);
                        bsAlert.close();
                    }
                }, 5000);
            });
        </script>
    <?php endif; ?>

    <div class="card card-modern">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Prodi, Angkatan & Semester</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ps-4 text-muted small fw-bold">
                                    <?php echo e($users->firstItem() + $index); ?>

                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            <?php echo e(substr($user->name, 0, 1)); ?>

                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0"><?php echo e($user->name); ?></div>
                                            <div class="text-muted small"><?php echo e($user->email); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="nim-badge"><?php echo e($user->nim ?? '-'); ?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark mb-1 small"><?php echo e($user->prodi ?? 'N/A'); ?></div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge rounded-pill shadow-sm" style="background-color: var(--light-orange); color: var(--primary-orange); font-size: 0.7rem;">
                                            Angkatan <?php echo e($user->angkatan ?? '20XX'); ?>

                                        </span>
                                        <span class="badge rounded-pill shadow-sm" style="background-color: #e0f2fe; color: #0369a1; font-size: 0.7rem;">
                                            Semester <?php echo e($user->semester ?? '-'); ?>

                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="action-btn" title="Edit Profil">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="<?php echo e(route('user.reset_password', $user->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="action-btn btn-reset" title="Reset Password" onclick="return confirm('Reset password mahasiswa ke default?')">
                                                <i class="bi bi-key"></i>
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('user.destroy', $user->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="action-btn btn-delete" title="Hapus Data" onclick="return confirm('Hapus data mahasiswa ini?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-clipboard-x fs-1 d-block mb-3 opacity-25"></i>
                                    <p class="mb-0 fw-medium">Belum ada data mahasiswa terdaftar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
        <p class="text-muted small m-0">
            Menampilkan <?php echo e($users->firstItem() ?? 0); ?> - <?php echo e($users->lastItem() ?? 0); ?> dari <?php echo e($users->total()); ?> data
        </p>
        <div>
            <?php echo e($users->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/users/index.blade.php ENDPATH**/ ?>