@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-dark mb-1">Surat Pengantar Magang</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active text-primary fw-medium" aria-current="page">Surat Pengantar</li>
                </ol>
            </nav>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modal-tambah-surat" style="background-color: #ff6b00; border: none; border-radius: 10px; box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3); font-weight: 600;">
                <i class="bi bi-plus-circle me-2"></i> Tambah Pengajuan
            </button>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @php
        $stats = [
        ['label' => 'Total Pengajuan', 'value' => $pengajuans->total(), 'color' => '#0d6efd', 'bg' => '#f0f7ff', 'icon' => 'bi-files'],
        ['label' => 'Menunggu', 'value' => $total_pending ?? 0, 'color' => '#fd7e14', 'bg' => '#fffaf0', 'icon' => 'bi-clock-history'],
        ['label' => 'Disetujui', 'value' => $total_disetujui ?? 0, 'color' => '#198754', 'bg' => '#f0fff4', 'icon' => 'bi-check-circle'],
        ['label' => 'Ditolak', 'value' => $total_ditolak ?? 0, 'color' => '#dc3545', 'bg' => '#fff5f5', 'icon' => 'bi-x-octagon']
        ];
        @endphp

        @foreach($stats as $stat)
        @php
        $cardStyle = "background-color: {$stat['bg']}; border-bottom: 3px solid {$stat['color']} !important;";
        $textStyle = "color: {$stat['color']};";
        @endphp
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 stat-card" style="{{ $cardStyle }}">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="fw-semibold small mb-1" style="{{ $textStyle }}">{{ $stat['label'] }}</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $stat['value'] }}</h3>
                    </div>
                    <div class="icon-shape rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; {{ $textStyle }}">
                        <i class="bi {{ $stat['icon'] }} fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="card-header bg-white py-3 border-0">
            <form action="{{ route('pengajuan_surat.index') }}" method="GET">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-0"
                                placeholder="Cari berdasarkan NIM, Nama, atau Perusahaan..."
                                value="{{ request('search') }}" style="font-size: 0.9rem;">
                            <button type="submit" class="btn btn-primary px-3" style="background-color: #ff6b00; border: none;">Cari</button>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end d-flex gap-2 justify-content-md-end">
                        <select name="status" class="form-select border-light bg-light d-inline-block w-auto"
                            style="font-size: 0.9rem;" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>

                        @if(request('search') || request('status'))
                        <a href="{{ route('pengajuan_surat.index') }}" class="btn btn-light border-0 text-muted" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            @if($pengajuans->count() > 0)
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4" style="width: 50px;">#</th>
                            <th>Detail Mahasiswa</th>
                            <th>Perusahaan</th>
                            <th>Periode Magang</th>
                            <th style="width: 150px;">Status</th>
                            <th class="pe-4 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @foreach($pengajuans as $pengajuan)
                        <tr>
                            <td class="ps-4 text-muted">{{ $pengajuans->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark mb-0">{{ $pengajuan->magang?->nama ?? 'N/A' }}</span>
                                    <span class="text-muted extra-small">{{ $pengajuan->magang?->nim }} | {{ $pengajuan->magang?->prodi }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium text-dark">{{ $pengajuan->magang?->perusahaan ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="badge bg-light text-dark fw-normal border">
                                    <i class="bi bi-calendar3 me-1 text-primary"></i>
                                    @if($pengajuan->magang?->tgl_mulai)
                                    {{ \Carbon\Carbon::parse($pengajuan->magang->tgl_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($pengajuan->magang->tgl_selesai)->format('d M Y') }}
                                    @else
                                    -
                                    @endif
                                </div>
                            </td>
                            <td>
                                <button type="button" 
                                    class="btn btn-sm w-100 d-flex justify-content-between align-items-center fw-medium status-btn {{ $pengajuan->status }}"
                                    onclick="openStatusModal({{ $pengajuan->id }}, '{{ $pengajuan->status }}', {{ Js::from($pengajuan->magang?->nama ?? 'N/A') }})">
                                    <span>
                                        @if($pengajuan->status === 'pending') ⏳ Menunggu
                                        @elseif($pengajuan->status === 'disetujui') ✅ Disetujui
                                        @else ❌ Ditolak
                                        @endif
                                    </span>
                                    <i class="bi bi-chevron-down ms-2 opacity-50"></i>
                                </button>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                                    <a href="{{ route('pengajuan_surat.show', $pengajuan->id) }}" class="btn btn-white btn-sm border" title="Lihat"><i class="bi bi-eye text-primary"></i></a>
                                    <a href="{{ route('pengajuan_surat.edit', $pengajuan->id) }}" class="btn btn-white btn-sm border" title="Edit"><i class="bi bi-pencil text-secondary"></i></a>
                                    @if($pengajuan->status === 'disetujui')
                                    <a href="{{ route('pengajuan_surat.pdf', $pengajuan->id) }}" target="_blank" class="btn btn-white btn-sm border" title="Unduh"><i class="bi bi-download text-success"></i></a>
                                    @endif
                                    <form action="{{ route('pengajuan_surat.destroy', $pengajuan->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus pengajuan ini?')" class="btn btn-white btn-sm border" title="Hapus"><i class="bi bi-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3 border-top bg-light-subtle">
                <div class="row align-items-center">
                    <div class="col-sm-6 text-center text-sm-start mb-2 mb-sm-0 text-muted small">
                        Menampilkan <strong>{{ $pengajuans->firstItem() }}</strong> - <strong>{{ $pengajuans->lastItem() }}</strong> dari <strong>{{ $pengajuans->total() }}</strong> pengajuan
                    </div>
                    <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end">
                        {{ $pengajuans->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            @else
            <div class="py-5 text-center bg-white">
                <i class="bi bi-inbox text-muted opacity-25" style="font-size: 4rem;"></i>
                <h5 class="text-muted fw-semibold mt-3">Data Tidak Ditemukan</h5>
                <p class="text-muted small">Coba sesuaikan kata kunci pencarian atau filter Anda.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <form id="statusForm" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" style="font-size: 1.15rem; color: #1f2937;">Update Status Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-3">Pilih Status Surat untuk <strong id="statusStudentName" class="text-dark"></strong>:</p>
                    
                    <div class="d-flex flex-column gap-3 mb-3">
                        <!-- Pending Option -->
                        <div class="status-option-wrapper">
                            <input type="radio" class="status-radio d-none" name="status_pilihan" id="status_pending" value="pending" autocomplete="off">
                            <label class="status-option-label w-100 d-flex align-items-center p-3 rounded-3 border" for="status_pending" style="cursor: pointer; transition: all 0.2s; border-color: #e5e7eb; background-color: #fff; margin-bottom: 0;">
                                <i class="bi bi-clock-history text-warning fs-4 me-3" style="flex-shrink: 0;"></i>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Pending</h6>
                                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Surat masih dalam proses peninjauan</p>
                                </div>
                            </label>
                        </div>

                        <!-- Disetujui Option -->
                        <div class="status-option-wrapper">
                            <input type="radio" class="status-radio d-none" name="status_pilihan" id="status_disetujui" value="disetujui" autocomplete="off">
                            <label class="status-option-label w-100 d-flex align-items-center p-3 rounded-3 border" for="status_disetujui" style="cursor: pointer; transition: all 0.2s; border-color: #e5e7eb; background-color: #fff; margin-bottom: 0;">
                                <i class="bi bi-check-circle text-success fs-4 me-3" style="flex-shrink: 0;"></i>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Disetujui</h6>
                                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Surat telah disetujui</p>
                                </div>
                            </label>
                        </div>

                        <!-- Ditolak Option -->
                        <div class="status-option-wrapper">
                            <input type="radio" class="status-radio d-none" name="status_pilihan" id="status_ditolak" value="ditolak" autocomplete="off">
                            <label class="status-option-label w-100 d-flex align-items-center p-3 rounded-3 border" for="status_ditolak" style="cursor: pointer; transition: all 0.2s; border-color: #e5e7eb; background-color: #fff; margin-bottom: 0;">
                                <i class="bi bi-x-circle text-danger fs-4 me-3" style="flex-shrink: 0;"></i>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Ditolak</h6>
                                    <p class="text-muted mb-0 small" style="font-size: 0.8rem;">Surat tidak disetujui</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div id="alasanPenolakanContainer" class="mt-3 d-none">
                        <label class="form-label small fw-bold text-danger">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control bg-light border-0" rows="3" placeholder="Masukkan alasan mengapa surat ini ditolak..."></textarea>
                    </div>
                </div>
                
                <div id="statusFooter" class="modal-footer border-0 bg-white p-3 justify-content-end gap-2" style="border-radius: 0 0 12px 12px;">
                    <button type="button" class="btn btn-light px-4 border" data-dismiss="modal" style="border-radius: 8px; font-weight: 500; font-size: 0.95rem; background-color: #fff; border-color: #e5e7eb; color: #1f2937;">Batal</button>
                    <button type="submit" class="btn btn-dark px-4 fw-semibold d-none align-items-center justify-content-center" id="btnSubmitStatus" style="border-radius: 8px; font-size: 0.95rem; background-color: #0b0f19; border-color: #0b0f19; color: #fff;">
                        <i class="bi bi-envelope me-2"></i>Kirim Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }

    .extra-small {
        font-size: 0.75rem;
    }

    /* Custom vertical radio cards */
    .status-option-wrapper {
        width: 100%;
    }
    
    .status-radio:checked + .status-option-label {
        background-color: #eff6ff !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 1px #3b82f6;
    }

    .stat-card {
        transition: transform 0.2s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .table thead th {
        background-color: #fcfcfc;
        border-bottom: 1px solid #eee;
        color: #888;
        letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
        background-color: #fafafa;
    }

    .status-btn {
        border: 1px solid #eee;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        text-align: left;
    }

    .status-btn.disetujui {
        color: #198754;
        background-color: #f0fff4;
        border-color: #19875444;
    }

    .status-btn.pending {
        color: #fd7e14;
        background-color: #fffaf0;
        border-color: #fd7e1444;
    }

    .status-btn.ditolak {
        color: #dc3545;
        background-color: #fff5f5;
        border-color: #dc354544;
    }

    .status-btn:hover {
        filter: brightness(0.95);
    }

    .btn-white {
        background: #fff;
        border: 1px solid #eee;
    }

    .btn-white:hover {
        background: #f8f9fa;
    }

    .pagination {
        margin-bottom: 0;
    }
</style>

<script>
    let currentPengajuanId = null;
    let originalStatus = null;

    function openStatusModal(id, currentStatus, studentName) {
        console.log('openStatusModal called with:', id, currentStatus, studentName);
        currentPengajuanId = id;
        originalStatus = currentStatus;
        document.getElementById('statusStudentName').innerText = studentName;
        
        // Reset Modal ke kondisi default
        document.getElementById('statusForm').reset();
        document.querySelectorAll('.status-radio').forEach(r => r.checked = false);
        document.getElementById('alasanPenolakanContainer').classList.add('d-none');
        document.getElementById('btnSubmitStatus').classList.add('d-none');
        
        if (currentStatus) {
            const radio = document.getElementById('status_' + currentStatus);
            if (radio) {
                radio.checked = true;
                console.log('Checked radio: status_' + currentStatus);
                // Trigger change event to set up form action, buttons, and text fields
                radio.dispatchEvent(new Event('change'));
            }
        }
        
        $('#statusModal').modal('show');
    }

    document.querySelectorAll('.status-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            console.log('Radio changed. Selected:', this.value, 'Original:', originalStatus);
            const form = document.getElementById('statusForm');
            const alasanContainer = document.getElementById('alasanPenolakanContainer');
            const alasanInput = document.getElementById('alasan_penolakan');
            const btnSubmit = document.getElementById('btnSubmitStatus');
            
            // Sembunyikan tombol submit jika tidak ada perubahan status
            if (this.value === originalStatus) {
                console.log('Selected value matches original. Hiding submit button.');
                btnSubmit.classList.add('d-none');
                btnSubmit.classList.remove('d-flex');
                alasanContainer.classList.add('d-none');
                alasanInput.removeAttribute('required');
                return;
            }
            
            // Tampilkan tombol submit jika ada perubahan status
            console.log('Selected value differs from original. Showing submit button.');
            btnSubmit.classList.remove('d-none');
            btnSubmit.classList.add('d-flex');
            
            const baseUrl = "{{ url('admin/pengajuan_surat') }}";
            
            if (this.value === 'ditolak') {
                form.action = `${baseUrl}/${currentPengajuanId}/reject`;
                alasanContainer.classList.remove('d-none');
                alasanInput.setAttribute('required', 'required');
                btnSubmit.className = 'btn btn-dark px-4 fw-semibold d-flex align-items-center justify-content-center';
                btnSubmit.innerHTML = '<i class="bi bi-envelope me-2"></i>Kirim Email';
            } else if (this.value === 'disetujui') {
                form.action = `${baseUrl}/${currentPengajuanId}/approve`;
                alasanContainer.classList.add('d-none');
                alasanInput.removeAttribute('required');
                btnSubmit.className = 'btn btn-dark px-4 fw-semibold d-flex align-items-center justify-content-center';
                btnSubmit.innerHTML = '<i class="bi bi-envelope me-2"></i>Kirim Email';
            } else {
                form.action = `${baseUrl}/${currentPengajuanId}/resubmit`;
                alasanContainer.classList.add('d-none');
                alasanInput.removeAttribute('required');
                btnSubmit.className = 'btn btn-warning text-dark px-4 fw-semibold d-flex align-items-center justify-content-center';
                btnSubmit.innerHTML = '<i class="bi bi-arrow-clockwise me-2"></i>Ubah ke Pending';
            }
        });
    });
</script>
@include('admin.pengajuan_surat.create')

@endsection