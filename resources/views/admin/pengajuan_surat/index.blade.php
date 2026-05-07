@extends('admin.layouts.main')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Title & Breadcrumb -->
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
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        @php
            // Data statistik dinamis
            $stats = [
                ['label' => 'Total Pengajuan', 'value' => $pengajuans->total(), 'color' => '#0d6efd', 'bg' => '#f0f7ff', 'icon' => 'bi-files'],
                ['label' => 'Menunggu', 'value' => $total_pending ?? 0, 'color' => '#fd7e14', 'bg' => '#fffaf0', 'icon' => 'bi-clock-history'],
                ['label' => 'Disetujui', 'value' => $total_disetujui ?? 0, 'color' => '#198754', 'bg' => '#f0fff4', 'icon' => 'bi-check-circle'],
                ['label' => 'Ditolak', 'value' => $total_ditolak ?? 0, 'color' => '#dc3545', 'bg' => '#fff5f5', 'icon' => 'bi-x-octagon']
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 stat-card" style="background-color: {{ $stat['bg'] }}; border-bottom: 3px solid {{ $stat['color'] }} !important;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="fw-semibold small mb-1" style="color: {{ $stat['color'] }}">{{ $stat['label'] }}</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $stat['value'] }}</h3>
                    </div>
                    <div class="icon-shape rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; color: {{ $stat['color'] }}">
                        <i class="bi {{ $stat['icon'] }} fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Table Section -->
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="card-header bg-white py-3 border-0">
            <!-- FORM PENCARIAN & FILTER -->
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
                                <select onchange="updateStatus({{ $pengajuan->id }}, this.value)" 
                                        class="form-select form-select-sm status-select {{ $pengajuan->status }}">
                                    <option value="pending" {{ $pengajuan->status === 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                    <option value="disetujui" {{ $pengajuan->status === 'disetujui' ? 'selected' : '' }}>✅ Disetujui</option>
                                    <option value="ditolak" {{ $pengajuan->status === 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                </select>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                                    <a href="{{ route('pengajuan_surat.show', $pengajuan->id) }}" class="btn btn-white btn-sm border" title="Lihat"><i class="bi bi-eye text-primary"></i></a>
                                    <a href="{{ route('pengajuan_surat.edit', $pengajuan->id) }}" class="btn btn-white btn-sm border" title="Edit"><i class="bi bi-pencil text-secondary"></i></a>
                                    @if($pengajuan->status === 'disetujui')
                                        <a href="{{ route('pengajuan_surat.pdf', $pengajuan->id) }}" class="btn btn-white btn-sm border" title="Unduh"><i class="bi bi-download text-success"></i></a>
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
            
            <!-- Pagination -->
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

<style>
    body { background-color: #f8f9fa; }
    .extra-small { font-size: 0.75rem; }
    .stat-card { transition: transform 0.2s ease-in-out; }
    .stat-card:hover { transform: translateY(-5px); }
    .table thead th { background-color: #fcfcfc; border-bottom: 1px solid #eee; color: #888; letter-spacing: 0.5px; }
    .table tbody tr:hover { background-color: #fafafa; }
    .status-select { border: 1px solid #eee; border-radius: 6px; font-weight: 500; cursor: pointer; }
    .status-select.disetujui { color: #198754; background-color: #f0fff4; border-color: #19875444; }
    .status-select.pending { color: #fd7e14; background-color: #fffaf0; border-color: #fd7e1444; }
    .status-select.ditolak { color: #dc3545; background-color: #fff5f5; border-color: #dc354544; }
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    .pagination { margin-bottom: 0; }
</style>

<script>
    const csrfToken = '{{ csrf_token() }}';
    async function updateStatus(id, status) {
        if (!confirm(`Ubah status pengajuan menjadi "${status.toUpperCase()}"?`)) {
            location.reload();
            return;
        };

        try {
            const res = await fetch(`{{ url('admin/pengajuan_surat') }}/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status })
            });

            const data = await res.json();
            if (data.success) {
                window.location.reload();
            } else {
                alert('Gagal mengubah status');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan server');
        }
    }
</script>
@endsection