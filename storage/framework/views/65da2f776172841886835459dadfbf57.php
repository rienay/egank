<div class="modal fade" id="modal-tambah-surat" tabindex="-1" role="dialog" aria-labelledby="modalTambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalTambahSuratLabel">Tambah Pengajuan Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="<?php echo e(route('pengajuan_surat.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <?php if(request('magang_id')): ?>
                        <input type="hidden" name="magang_id" value="<?php echo e(request('magang_id')); ?>" id="select_magang_id">
                    <?php else: ?>
                        <div class="alert alert-warning mb-4 border-0" style="border-radius: 12px; background-color: #fffaf0;">
                            <label class="form-label fw-semibold small text-dark">Pilih Data Pengajuan Magang (Kosongkan jika input manual)</label>
                            <select name="magang_id" class="form-control" id="select_magang_id">
                                <option value="">-- Input Manual (Mahasiswa Baru) --</option>
                                <?php $__currentLoopData = $magangList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $magang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($magang->id); ?>"><?php echo e($magang->nim); ?> - <?php echo e($magang->nama); ?> (<?php echo e($magang->perusahaan); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-sm p-3 mb-4 border-0" style="background-color: #fff5f0; border-radius: 12px;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-plus-fill me-2 text-warning" style="font-size: 1.25rem;"></i>
                            <span class="small text-muted">Pilih mahasiswa di atas untuk auto-fill, atau isi data di bawah ini secara manual untuk mahasiswa baru.</span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12"><h6 class="fw-bold text-primary mb-2">I. Data Mahasiswa</h6></div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nim" id="input_nim" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: 240102122" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="input_nama" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Nama Lengkap Mahasiswa" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold small">Email Mahasiswa <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="input_email" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="nama@pnc.ac.id" required>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-semibold small">Program Studi <span class="text-danger">*</span></label>
                            <input type="text" name="prodi" id="input_prodi" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: Teknik Informatika" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold small">Angkatan <span class="text-danger">*</span></label>
                            <input type="number" name="angkatan" id="input_angkatan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="2024" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12"><h6 class="fw-bold text-primary mb-2">II. Data Perusahaan & Magang</h6></div>
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold small">Nama Perusahaan/Instansi <span class="text-danger">*</span></label>
                            <input type="text" name="perusahaan" id="input_perusahaan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: PT. Teknologi Maju" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold small">Alamat Perusahaan <span class="text-danger">*</span></label>
                            <textarea name="alamat" id="input_alamat" class="form-control border-0 py-2 px-3" rows="2" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Jl. Raya No. 123..." required></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_mulai" id="input_tgl_mulai" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_selesai" id="input_tgl_selesai" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12"><h6 class="fw-bold text-primary mb-2">III. Jenis & Keperluan Surat</h6></div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Jenis Surat <span class="text-danger">*</span></label>
                            <select name="jenis_surat" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" required>
                                <option value="">Pilih Jenis</option>
                                <option value="Surat Pengantar Magang">Surat Pengantar Magang</option>
                                <option value="Surat Keterangan Magang">Surat Keterangan Magang</option>
                                <option value="Surat Tugas">Surat Tugas</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Keperluan <span class="text-danger">*</span></label>
                            <input type="text" name="keperluan" class="form-control border-0 py-2 px-3" style="background-color: #f3f4f6; border-radius: 8px;" placeholder="Contoh: Pengajuan Magang Industri" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold small">Upload File Pendukung (Opsional)</label>
                            <input type="file" name="file_pendukung[]" multiple class="form-control border-0 px-3" style="background-color: #f3f4f6; border-radius: 8px;">
                        </div>
                    </div>

                    <div class="row g-3 pt-3 border-top mt-4">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100 py-2 fw-semibold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn text-white w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" 
                                    style="background-color: #ff6b00; border-radius: 10px; border: none;">
                                <i class="bi bi-save"></i> Simpan & Buat Surat
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rawMagangList = <?php echo json_encode($magangList, 15, 512) ?>;
        const selectMagang = document.getElementById('select_magang_id');
        
        if (selectMagang) {
            selectMagang.addEventListener('change', function() {
                const selectedId = this.value;
                
                if (selectedId) {
                    const selectedMagang = rawMagangList.find(item => item.id == selectedId);
                    
                    if (selectedMagang) {
                        document.getElementById('input_nim').value = selectedMagang.nim || '';
                        document.getElementById('input_nama').value = selectedMagang.nama || '';
                        document.getElementById('input_email').value = selectedMagang.email || '';
                        document.getElementById('input_prodi').value = selectedMagang.prodi || '';
                        document.getElementById('input_angkatan').value = selectedMagang.angkatan || '';
                        document.getElementById('input_perusahaan').value = selectedMagang.perusahaan || '';
                        document.getElementById('input_alamat').value = selectedMagang.alamat || '';
                        document.getElementById('input_tgl_mulai').value = selectedMagang.tgl_mulai || '';
                        document.getElementById('input_tgl_selesai').value = selectedMagang.tgl_selesai || '';
                    }
                } else {
                    // Reset input manual jika "Input Manual" dipilih
                    document.getElementById('input_nim').value = '';
                    document.getElementById('input_nama').value = '';
                    document.getElementById('input_email').value = '';
                    document.getElementById('input_prodi').value = '';
                    document.getElementById('input_angkatan').value = '';
                    document.getElementById('input_perusahaan').value = '';
                    document.getElementById('input_alamat').value = '';
                    document.getElementById('input_tgl_mulai').value = '';
                    document.getElementById('input_tgl_selesai').value = '';
                }
            });
        }
    });
</script><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/pengajuan_surat/create.blade.php ENDPATH**/ ?>