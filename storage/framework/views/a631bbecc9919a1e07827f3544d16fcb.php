

<?php $__env->startSection('content'); ?>
<style>
    .card-profile {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-profile:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #ff6b00, #ff8533);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
        transition: all 0.3s;
    }
    .btn-gradient:hover {
        transform: scale(1.05);
        color: white;
        box-shadow: 0 6px 20px rgba(255, 107, 0, 0.4);
    }
    .icon-box {
        width: 35px;
        height: 35px;
        background: #f8f9fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: #ff6b00;
    }
    .text-primary-kampus {
        color: #ff6b00 !important;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Profil Kampus</h3>
            <p class="text-muted">Manajemen informasi identitas dan kontak lembaga</p>
        </div>

        <button class="btn btn-gradient px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modal-tambah">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Profil
        </button>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 10px;">
            <strong>Gagal Menyimpan Data!</strong> Silakan periksa kembali isian form Anda. (Pastikan gambar tidak lebih dari 2MB)
            <ul class="mb-0 mt-2">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle mr-2"></i> <strong>Berhasil!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if($profiles->count()): ?>
        <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card card-profile border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    
                    <div class="col-lg-2 col-md-3 text-center mb-3 mb-md-0">
                        <div class="position-relative d-inline-block">
                            <?php if($profile->logo_kampus): ?>
                                <img src="<?php echo e(asset('storage/'.$profile->logo_kampus)); ?>" 
                                     style="height:110px; width:110px; object-fit:contain; background:#fff;" 
                                     class="rounded-circle shadow-sm border p-2">
                            <?php else: ?>
                                <div style="height:110px; width:110px; background:#f5f5f5;" 
                                     class="rounded-circle d-flex align-items-center justify-content-center text-muted mx-auto shadow-sm border">
                                    <i class="fas fa-university fa-3x"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-5">
                        <h4 class="font-weight-bold mb-1"><?php echo e($profile->nama_kampus); ?></h4>
                        <p class="text-primary-kampus font-weight-medium mb-3"><?php echo e($profile->kementerian); ?></p>
                        
                        <div class="row no-gutters">
                            <div class="col-12 d-flex align-items-start mb-2">
                                <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                                <small class="text-muted mt-1 leading-normal"><?php echo e($profile->alamat_kampus); ?></small>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center mb-2">
                                <div class="icon-box"><i class="fas fa-envelope"></i></div>
                                <small class="text-muted"><?php echo e($profile->email_kampus); ?></small>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center mb-2">
                                <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                                <small class="text-muted"><?php echo e($profile->telepon_kampus); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 text-md-right border-left pl-lg-5">
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Penandatangan:</small>
                            <h6 class="font-weight-bold mb-0 text-dark"><?php echo e($profile->nama_penandatangan); ?></h6>
                            <small class="text-muted">NIP. <?php echo e($profile->nip_penandatangan); ?></small>
                        </div>

                        <div class="d-flex justify-content-md-end">
                            <button class="btn btn-outline-primary mr-2 px-4 shadow-sm" 
                                    data-toggle="modal" data-target="#modal-edit-<?php echo e($profile->id); ?>" 
                                    style="border-radius:10px; font-weight:600;">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>

                            <form action="<?php echo e(route('campus-profile.destroy', $profile->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger px-4 shadow-sm" 
                                        onclick="return confirm('Hapus profil kampus ini?')"
                                        style="border-radius:10px; font-weight:600;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- FOOTER CARD -->
            <div class="card-footer bg-light border-0 py-2 px-4" style="border-radius: 0 0 20px 20px;">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Kontak Person: <b><?php echo e($profile->nama_kontak_person); ?></b> (<?php echo e($profile->telepon_kontak_person); ?>)</small>
                    <a href="<?php echo e($profile->website); ?>" target="_blank" class="small font-weight-bold text-primary-kampus">
                        Visit Website <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        
        <?php echo $__env->make('admin.profile_kampus.edit', ['profile' => $profile], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php else: ?>
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius:20px;">
            <div class="card-body">
                <i class="fas fa-university fa-4x mb-4 text-light"></i>
                <h4 class="text-dark font-weight-bold">Data Masih Kosong</h4>
                <p class="text-muted">Anda belum menambahkan informasi profil kampus utama.</p>
                <button class="btn btn-gradient px-5 mt-2" data-toggle="modal" data-target="#modal-tambah">
                    Mulai Tambah Sekarang
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>


<?php echo $__env->make('admin.profile_kampus.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/profile_kampus/index.blade.php ENDPATH**/ ?>