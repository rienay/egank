@extends('admin.layouts.main')

@section('content')
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
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Profil Kampus</h3>
            <p class="text-muted">Manajemen informasi identitas dan kontak lembaga</p>
        </div>

        <button class="btn btn-gradient px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modal-tambah">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Profil
        </button>
    </div>

    <!-- Menampilkan Pesan Error Validasi -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 10px;">
            <strong>Gagal Menyimpan Data!</strong> Silakan periksa kembali isian form Anda. (Pastikan gambar tidak lebih dari 2MB)
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Menampilkan Pesan Sukses -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle mr-2"></i> <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($profiles->count())
        @foreach($profiles as $profile)
        <div class="card card-profile border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    
                    <!-- LOGO SECTION -->
                    <div class="col-lg-2 col-md-3 text-center mb-3 mb-md-0">
                        <div class="position-relative d-inline-block">
                            @if($profile->logo_kampus)
                                <img src="{{ asset('storage/'.$profile->logo_kampus) }}" 
                                     style="height:110px; width:110px; object-fit:contain; background:#fff;" 
                                     class="rounded-circle shadow-sm border p-2">
                            @else
                                <div style="height:110px; width:110px; background:#f5f5f5;" 
                                     class="rounded-circle d-flex align-items-center justify-content-center text-muted mx-auto shadow-sm border">
                                    <i class="fas fa-university fa-3x"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- CONTENT SECTION -->
                    <div class="col-lg-6 col-md-5">
                        <h4 class="font-weight-bold mb-1">{{ $profile->nama_kampus }}</h4>
                        <p class="text-primary-kampus font-weight-medium mb-3">{{ $profile->kementerian }}</p>
                        
                        <div class="row no-gutters">
                            <div class="col-12 d-flex align-items-start mb-2">
                                <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                                <small class="text-muted mt-1 leading-normal">{{ $profile->alamat_kampus }}</small>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center mb-2">
                                <div class="icon-box"><i class="fas fa-envelope"></i></div>
                                <small class="text-muted">{{ $profile->email_kampus }}</small>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center mb-2">
                                <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                                <small class="text-muted">{{ $profile->telepon_kampus }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- ACTION SECTION -->
                    <div class="col-lg-4 col-md-4 text-md-right border-left pl-lg-5">
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Penandatangan:</small>
                            <h6 class="font-weight-bold mb-0 text-dark">{{ $profile->nama_penandatangan }}</h6>
                            <small class="text-muted">NIP. {{ $profile->nip_penandatangan }}</small>
                        </div>

                        <div class="d-flex justify-content-md-end">
                            <button class="btn btn-outline-primary mr-2 px-4 shadow-sm" 
                                    data-toggle="modal" data-target="#modal-edit-{{ $profile->id }}" 
                                    style="border-radius:10px; font-weight:600;">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>

                            <form action="{{ route('campus-profile.destroy', $profile->id) }}" method="POST">
                                @csrf @method('DELETE')
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
                    <small class="text-muted">Kontak Person: <b>{{ $profile->nama_kontak_person }}</b> ({{ $profile->telepon_kontak_person }})</small>
                    <a href="{{ $profile->website }}" target="_blank" class="small font-weight-bold text-primary-kampus">
                        Visit Website <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Modal Edit per data --}}
        @include('admin.profile_kampus.edit', ['profile' => $profile])
        @endforeach

    @else
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
    @endif
</div>

{{-- Modal Tambah --}}
@include('admin.profile_kampus.create')

@endsection