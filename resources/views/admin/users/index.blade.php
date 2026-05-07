@extends('admin.layouts.main')

@section('content')
<style>
    :root {
        --primary-orange: #ff782d;
        --light-orange: #fff4ed;
        --soft-gray: #f8f9fa;
        --text-dark: #2d3748;
    }

    /* Card & Container */
    .card-modern {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
    }

    /* Typography & Header */
    .content-header-modern {
        padding: 1.5rem 0;
    }

    /* Table Styling */
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

    /* Avatar & Badge */
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

    /* Buttons */
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

    /* Action Buttons */
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

    /* FIX ALERT CSS */
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

    /* FIX CLOSE BUTTON */
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
    <!-- Header Section -->
    <div class="content-header-modern d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold m-0" style="color: var(--text-dark);">Data Mahasiswa</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    <li class="breadcrumb-item small"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item active text-orange small fw-bold" style="color: var(--primary-orange) !important;">Mahasiswa</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-orange shadow-sm d-flex align-items-center">
            <i class="bi bi-plus-lg me-2"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- ALERT WITH AUTO-CLOSE AND DISMISS -->
    @if (session()->has('success'))
        <div id="success-alert" class="alert alert-modern alert-dismissible fade show mb-4 border-0" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box me-3">
                    <i class="bi bi-check2-circle fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-bold text-dark" style="font-size: 0.95rem;">Berhasil!</div>
                    <div class="text-secondary small">{{ session('success') }}</div>
                </div>

                <!-- Tombol X yang dipasang pemicu -->
                <button type="button" class="btn-close-modern ms-auto" data-bs-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <!-- Script supaya alert bisa hilang kalau dipencet atau hilang sendiri dalam 5 detik -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Hilang otomatis setelah 5 detik
                setTimeout(function() {
                    let alertElement = document.getElementById('success-alert');
                    if (alertElement) {
                        let bsAlert = new bootstrap.Alert(alertElement);
                        bsAlert.close();
                    }
                }, 5000);
            });
        </script>
    @endif

    <!-- Table Card -->
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
                        @forelse ($users as $index => $user)
                            <tr>
                                <td class="ps-4 text-muted small fw-bold">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0">{{ $user->name }}</div>
                                            <div class="text-muted small">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="nim-badge">{{ $user->nim ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark mb-1 small">{{ $user->prodi ?? 'N/A' }}</div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge rounded-pill shadow-sm" style="background-color: var(--light-orange); color: var(--primary-orange); font-size: 0.7rem;">
                                            Angkatan {{ $user->angkatan ?? '20XX' }}
                                        </span>
                                        <span class="badge rounded-pill shadow-sm" style="background-color: #e0f2fe; color: #0369a1; font-size: 0.7rem;">
                                            Semester {{ $user->semester ?? '-' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('user.edit', $user->id) }}" class="action-btn" title="Edit Profil">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('user.reset_password', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="action-btn btn-reset" title="Reset Password" onclick="return confirm('Reset password mahasiswa ke default?')">
                                                <i class="bi bi-key"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn btn-delete" title="Hapus Data" onclick="return confirm('Hapus data mahasiswa ini?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-clipboard-x fs-1 d-block mb-3 opacity-25"></i>
                                    <p class="mb-0 fw-medium">Belum ada data mahasiswa terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
        <p class="text-muted small m-0">
            Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
        </p>
        <div>
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection