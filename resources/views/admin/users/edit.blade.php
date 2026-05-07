@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4 py-4">
    <h3 class="mb-4 font-weight-bold">Edit Data Mahasiswa</h3>

    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">NIM</label>
                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $user->nim) }}" required>
                        @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Program Studi</label>
                        <select name="prodi" class="form-control @error('prodi') is-invalid @enderror" required>
                            <option value="">Pilih Program Studi</option>
                            @foreach($prodiOptions as $prodi)
                                <option value="{{ $prodi }}" {{ old('prodi', $user->prodi) === $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                            @endforeach
                        </select>
                        @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan', $user->angkatan) }}" required>
                        @error('angkatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Semester</label>
                        <input type="number" name="semester" min="1" max="14" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester', $user->semester) }}" required>
                        @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-weight-bold">Email Mahasiswa</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex align-items-center">
                    <a href="{{ route('user.index') }}" class="btn btn-light border mr-2">Batal</a>
                    <button type="submit" class="btn text-white font-weight-bold" style="background:linear-gradient(135deg,#ff6b00,#ff8533);">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection