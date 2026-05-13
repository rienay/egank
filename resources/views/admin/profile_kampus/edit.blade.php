<div class="modal fade" id="modal-edit-{{ $profile->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px; overflow:hidden;">

            <form action="{{ route('campus-profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="font-weight-bold mb-1">Edit Profil Kampus</h5>
                        <small class="text-muted">Perbarui informasi kampus</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body pt-3">
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Informasi Kampus</h6>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Kementerian</label>
                            <input type="text" name="kementerian" value="{{ $profile->kementerian }}" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Nama Kampus</label>
                            <input type="text" name="nama_kampus" value="{{ $profile->nama_kampus }}" class="form-control shadow-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Alamat</label>
                        <textarea name="alamat_kampus" class="form-control shadow-sm" rows="2">{{ $profile->alamat_kampus }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Telepon</label>
                            <input type="text" name="telepon_kampus" value="{{ $profile->telepon_kampus }}" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Fax</label>
                            <input type="text" name="fax_kampus" value="{{ $profile->fax_kampus }}" class="form-control shadow-sm" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Website</label>
                            <input type="text" name="website" value="{{ $profile->website }}" class="form-control shadow-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Email</label>
                        <input type="email" name="email_kampus" value="{{ $profile->email_kampus }}" class="form-control shadow-sm">
                    </div>

                    <div class="form-group">
                        <label class="small text-muted">Logo Kampus</label>
                        <div class="d-flex align-items-center">
                            @if($profile->logo_kampus)
                                <img src="{{ asset('storage/'.$profile->logo_kampus) }}" style="height:60px; width:60px; object-fit:contain; border-radius:10px;" class="border mr-3">
                            @endif
                            <input type="file" name="logo_kampus" class="form-control shadow-sm">
                        </div>
                        <small class="text-muted">Kosongkan jika tidak diubah</small>
                    </div>

                    <hr>
                    <h6 class="font-weight-bold mb-3" style="color:#ff6b00;">Kontak & Penandatangan</h6>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Nama Kontak</label>
                            <input type="text" name="nama_kontak_person" value="{{ $profile->nama_kontak_person }}" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Telepon Kontak</label>
                            <input type="text" name="telepon_kontak_person" value="{{ $profile->telepon_kontak_person }}" class="form-control shadow-sm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Jabatan TTD</label>
                            <input type="text" name="jabatan_penandatangan" value="{{ $profile->jabatan_penandatangan }}" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">Nama TTD</label>
                            <input type="text" name="nama_penandatangan" value="{{ $profile->nama_penandatangan }}" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-muted">NIP TTD</label>
                            <input type="text" name="nip_penandatangan" value="{{ $profile->nip_penandatangan }}" class="form-control shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="submit" class="btn w-100 text-white font-weight-bold" style="background:linear-gradient(135deg,#ff6b00,#ff8533); border-radius:10px;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>