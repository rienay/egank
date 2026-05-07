<div class="modal fade" id="modal-edit-<?php echo e($profile->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px; overflow:hidden;">

            <form action="<?php echo e(route('campus-profile.update', $profile->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- HEADER -->
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="font-weight-bold mb-1">Edit Profil Kampus</h5>
                        <small class="text-muted">Perbarui informasi kampus</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- BODY -->
                <div class="modal-body pt-3">
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Informasi Kampus</h6>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Kementerian</label>
                            <input type="text" name="kementerian" value="<?php echo e($profile->kementerian); ?>" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Nama Kampus</label>
                            <input type="text" name="nama_kampus" value="<?php echo e($profile->nama_kampus); ?>" class="form-control shadow-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Alamat</label>
                        <textarea name="alamat_kampus" class="form-control shadow-sm" rows="2"><?php echo e($profile->alamat_kampus); ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Telepon</label>
                            <input type="text" name="telepon_kampus" value="<?php echo e($profile->telepon_kampus); ?>" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Fax</label>
                            <input type="text" name="fax_kampus" value="<?php echo e($profile->fax_kampus); ?>" class="form-control shadow-sm" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Website</label>
                            <input type="text" name="website" value="<?php echo e($profile->website); ?>" class="form-control shadow-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Email</label>
                        <input type="email" name="email_kampus" value="<?php echo e($profile->email_kampus); ?>" class="form-control shadow-sm">
                    </div>

                    <!-- LOGO -->
                    <div class="form-group">
                        <label class="small text-muted">Logo Kampus</label>
                        <div class="d-flex align-items-center">
                            <?php if($profile->logo_kampus): ?>
                                <img src="<?php echo e(asset('storage/'.$profile->logo_kampus)); ?>" style="height:60px; width:60px; object-fit:contain; border-radius:10px;" class="border mr-3">
                            <?php endif; ?>
                            <input type="file" name="logo_kampus" class="form-control shadow-sm">
                        </div>
                        <small class="text-muted">Kosongkan jika tidak diubah</small>
                    </div>

                    <hr>
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Kontak & Penandatangan</h6>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Nama Kontak</label>
                            <input type="text" name="nama_kontak_person" value="<?php echo e($profile->nama_kontak_person); ?>" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Telepon Kontak</label>
                            <input type="text" name="telepon_kontak_person" value="<?php echo e($profile->telepon_kontak_person); ?>" class="form-control shadow-sm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Jabatan TTD</label>
                            <input type="text" name="jabatan_penandatangan" value="<?php echo e($profile->jabatan_penandatangan); ?>" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Nama TTD</label>
                            <input type="text" name="nama_penandatangan" value="<?php echo e($profile->nama_penandatangan); ?>" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">NIP TTD</label>
                            <input type="text" name="nip_penandatangan" value="<?php echo e($profile->nip_penandatangan); ?>" class="form-control shadow-sm">
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0">
                    <button type="submit" class="btn w-100 text-white font-weight-bold" style="background:linear-gradient(135deg,#ff6b00,#ff8533); border-radius:10px;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/profile_kampus/edit.blade.php ENDPATH**/ ?>