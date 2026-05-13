@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
<style>
  .card-dashboard {
    border-radius: 12px;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
  }

  .card-dashboard:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  }

  .text-heading {
    color: #1e293b;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
  }

  .icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
  }

  .icon-box-sm {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }

  .btn-lihat-semua {
    background-color: #3b82f6;
    color: #ffffff;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    font-size: 0.85rem;
    border: none;
    transition: all 0.2s;
    text-decoration: none;
  }

  .btn-lihat-semua:hover {
    background-color: #2563eb;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
  }

  .badge-status {
    padding: 6px 12px;
    font-weight: 600;
    border-radius: 6px;
    font-size: 0.75rem;
    letter-spacing: 0.3px;
  }

  .table-custom thead th {
    background-color: #f8fafc;
    color: #64748b;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #f1f5f9;
  }

  .table-custom td {
    vertical-align: middle;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
  }
</style>

<div class="content-header">
  <div class="container-fluid">
    <h1 class="m-0 text-heading">Dashboard Admin</h1>
    <p class="text-muted">Selamat datang di Sistem Manajemen Magang e-Gang</p>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">Total Mahasiswa</p>
                <h3 class="text-heading mb-1">{{ $total_mahasiswa }}</h3>
                <small class="text-muted" style="font-size: 0.75rem;"><i class="fas fa-users mr-1"></i> Terdaftar</small>
              </div>
              <div class="icon-box" style="background-color: #dbeafe; color: #3b82f6;">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">Total Pengajuan</p>
                <h3 class="text-heading mb-1">{{ $total_pengajuan }}</h3>
                <small class="text-muted" style="font-size: 0.75rem;"><i class="fas fa-chart-line mr-1"></i> {{ $pengajuan_bulan_ini }} bulan ini</small>
              </div>
              <div class="icon-box" style="background-color: #ede9fe; color: #8b5cf6;">
                <i class="fas fa-file-alt"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">Surat Disetujui</p>
                <h3 class="text-heading mb-1">{{ $surat_disetujui }}</h3>
                @php
                $persentase = $total_pengajuan > 0 ? round(($surat_disetujui / $total_pengajuan) * 100) : 0;
                @endphp
                <small class="text-muted" style="font-size: 0.75rem;"><i class="fas fa-chart-line mr-1"></i> {{ $persentase }}% Disetujui</small>
              </div>
              <div class="icon-box" style="background-color: #d1fae5; color: #10b981;">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">Menunggu Persetujuan</p>
                <h3 class="text-heading mb-1">{{ $menunggu_persetujuan }}</h3>
                <small class="text-muted" style="font-size: 0.75rem;">Butuh tindakan</small>
              </div>
              <div class="icon-box" style="background-color: #fef3c7; color: #f59e0b;">
                <i class="fas fa-clock"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.8rem;">Pengajuan Hari Ini</p>
                <h4 class="text-heading mb-0">{{ $pengajuan_hari_ini }}</h4>
              </div>
              <div class="icon-box-sm" style="background-color: #fef3c7; color: #f59e0b;">
                <i class="fas fa-file-invoice"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.8rem;">Disetujui Hari Ini</p>
                <h4 class="text-heading mb-0">{{ $disetujui_hari_ini }}</h4>
              </div>
              <div class="icon-box-sm" style="background-color: #d1fae5; color: #10b981;">
                <i class="fas fa-check-square"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.8rem;">Sedang Magang</p>
                <h4 class="text-heading mb-0">{{ $sedang_magang }}</h4>
              </div>
              <div class="icon-box-sm" style="background-color: #dbeafe; color: #3b82f6;">
                <i class="fas fa-briefcase"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.8rem;">Surat Ditolak</p>
                <h4 class="text-heading mb-0">{{ $surat_ditolak }}</h4>
              </div>
              <div class="icon-box-sm" style="background-color: #fee2e2; color: #ef4444;">
                <i class="fas fa-times-circle"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-lg-7 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="text-heading mb-0">Statistik Pengajuan Magang ({{ $tahun_ini }})</h5>
          </div>
          <div class="card-body">
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-5 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="text-heading mb-0">Status Surat Pengantar</h5>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-12">
        <div class="card card-dashboard">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h5 class="text-heading mb-0">Pengajuan Surat Terbaru</h5>
                <small class="text-muted">{{ $pengajuan_terbaru->count() }} pengajuan terbaru</small>
              </div>
              <a href="{{ route('pengajuan_surat.index') }}" class="btn-lihat-semua d-inline-flex align-items-center">Lihat Semua <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
          </div>
          <div class="card-body px-0">
            <div class="table-responsive">
              <table class="table table-custom mb-0">
                <thead>
                  <tr>
                    <th class="px-4">NIM</th>
                    <th>NAMA MAHASISWA</th>
                    <th>PROGRAM STUDI</th>
                    <th>PERUSAHAAN</th>
                    <th>STATUS</th>
                    <th>TANGGAL</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($pengajuan_terbaru as $terbaru)
                  <tr>
                    <td class="px-4 text-primary font-weight-bold">{{ $terbaru->magang?->nim }}</td>
                    <td class="font-weight-bold text-dark">{{ $terbaru->magang?->nama }}</td>
                    <td class="text-muted">{{ $terbaru->magang?->prodi }}</td>
                    <td class="text-muted">{{ $terbaru->magang?->perusahaan }}</td>
                    <td>
                      @if($terbaru->status === 'disetujui')
                      <span class="badge badge-status" style="background-color: #d1fae5; color: #10b981;">Disetujui</span>
                      @elseif($terbaru->status === 'ditolak')
                      <span class="badge badge-status" style="background-color: #fee2e2; color: #ef4444;">Ditolak</span>
                      @else
                      <span class="badge badge-status" style="background-color: #fef3c7; color: #f59e0b;">Menunggu</span>
                      @endif
                    </td>
                    <td class="text-muted small">{{ $terbaru->created_at->format('d M Y') }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan surat.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var pengajuanPerBulan = <?php echo json_encode(isset($pengajuan_per_bulan) ? $pengajuan_per_bulan : []); ?>;
    var statusSuratData = <?php echo json_encode([
                            isset($surat_disetujui) ? $surat_disetujui : 0,
                            isset($menunggu_persetujuan) ? $menunggu_persetujuan : 0,
                            isset($surat_ditolak) ? $surat_ditolak : 0,
                          ]); ?>;

    var barChartCanvas = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
          label: 'Jumlah Pengajuan',
          backgroundColor: '#3b82f6',
          borderColor: '#2563eb',
          borderWidth: 1,
          data: pengajuanPerBulan
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 1
            }
          }]
        },
        legend: {
          display: false
        }
      }
    });

    var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: {
        labels: ['Disetujui', 'Menunggu', 'Ditolak'],
        datasets: [{
          data: statusSuratData,
          backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'bottom'
        }
      }
    });
  });
</script>
@endsection