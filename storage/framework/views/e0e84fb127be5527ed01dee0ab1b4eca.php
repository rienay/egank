<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px; overflow:hidden;">

            <form action="<?php echo e(route('campus-profile.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- HEADER -->
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="font-weight-bold mb-1">Tambah Profil Kampus</h5>
                        <small class="text-muted">Lengkapi informasi kampus</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- BODY -->
                <div class="modal-body pt-3">

                    <!-- INFORMASI -->
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Informasi Kampus</h6>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Kementerian</label>
                            <input type="text" name="kementerian" class="form-control shadow-sm" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Nama Kampus</label>
                            <input type="text" name="nama_kampus" class="form-control shadow-sm" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Alamat</label>
                        <textarea name="alamat_kampus" class="form-control shadow-sm" rows="2" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Telepon</label>
                            <input type="text" name="telepon_kampus" class="form-control shadow-sm" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Fax</label>
                            <input type="text" name="fax_kampus" class="form-control shadow-sm" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Website</label>
                            <input type="text" name="website" class="form-control shadow-sm" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Email</label>
                        <input type="email" name="email_kampus" class="form-control shadow-sm" required>
                    </div>

                    <!-- LOGO -->
                    <div class="form-group">
                        <label class="small text-muted">Logo Kampus</label>
                        <input type="file" name="logo_kampus" class="form-control shadow-sm">
                    </div>

                    <hr>

                    <!-- KONTAK -->
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Kontak</h6>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Nama Kontak</label>
                            <input type="text" name="nama_kontak_person" class="form-control shadow-sm" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Telepon Kontak</label>
                            <input type="text" name="telepon_kontak_person" class="form-control shadow-sm" required>
                        </div>
                    </div>

                    <hr>

                    <!-- PENANDATANGAN -->
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Penandatangan</h6>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Jabatan</label>
                            <input type="text" name="jabatan_penandatangan" class="form-control shadow-sm" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Nama</label>
                            <input type="text" name="nama_penandatangan" class="form-control shadow-sm" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">NIP</label>
                            <input type="text" name="nip_penandatangan" class="form-control shadow-sm" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">TTD</label>
                            <input type="file" name="ttd_image" class="form-control shadow-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Stempel</label>
                            <input type="file" name="stempel_image" class="form-control shadow-sm">
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0">
                    <button type="submit"
                        class="btn w-100 text-white font-weight-bold"
                        style="background:linear-gradient(135deg,#ff6b00,#ff8533); border-radius:10px;">
                        Simpan Profil
                    </button>
                </div>

            </form>

        </div>
    </div>
</div><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/profile_kampus/create.blade.php ENDPATH**/ ?>