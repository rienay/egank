@extends('layouts.main')

@section('content')
<div class="bg-slate-50 min-h-screen pb-12 pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#111827]">Riwayat Pengajuan Surat</h1>
            <p class="text-gray-500 text-sm mt-1">Lihat status dan riwayat pengajuan surat magang Anda</p>
        </div>

        @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 text-sm flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-white">
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">#</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Perusahaan</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Periode Magang</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Tgl Pengajuan</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Status Surat</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Status Magang</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($riwayat as $index => $data)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-6 text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <p class="text-sm font-bold text-[#111827]">{{ $data->perusahaan }}</p>
                            <p class="text-xs text-gray-500 truncate max-w-[200px]">{{ $data->alamat }}</p>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-600">
                            {{ date('j M Y', strtotime($data->tgl_mulai)) }} - {{ date('j M Y', strtotime($data->tgl_selesai)) }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-600">
                            {{ $data->created_at->format('j M Y') }}
                        </td>
                        
                        <td class="py-4 px-6">
                            @if($data->status == 'Disetujui')
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-md font-medium">Disetujui</span>
                            @elseif($data->status == 'Ditolak')
                                <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-md font-medium">Ditolak</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-md font-medium">Menunggu Validasi</span>
                            @endif
                        </td>

                        <td class="py-4 px-6">
                            @if($data->status_magang == 'Sedang Magang')
                                <span class="bg-blue-50 text-blue-600 border border-blue-200 text-xs px-3 py-1.5 rounded-full font-medium inline-flex items-center gap-1.5">
                                    <i class="fas fa-play text-[10px]"></i> Sedang Magang
                                </span>
                            @elseif($data->status_magang == 'Selesai')
                                <span class="bg-purple-50 text-purple-600 border border-purple-200 text-xs px-3 py-1.5 rounded-full font-medium inline-flex items-center gap-1.5">
                                    <i class="fas fa-check-circle text-[11px]"></i> Selesai Magang
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1.5 rounded-full font-medium">Belum Konfirmasi</span>
                            @endif
                        </td>

                        <td class="py-4 px-6 flex items-center justify-center gap-4">
                            <button onclick="openModal('modal-detail-{{ $data->id }}')" class="text-blue-600 hover:text-blue-800 transition" title="Detail Pengajuan">
                                <i class="far fa-eye text-lg"></i>
                            </button>
                            
                            @if($data->status == 'Disetujui')
                                <a href="#" class="text-green-600 hover:text-green-800 transition" title="Unduh Surat Pengantar">
                                    <i class="fas fa-download text-lg"></i>
                                </a>
                            @else
                                <span class="text-gray-300 cursor-not-allowed" title="Surat belum disetujui">
                                    <i class="fas fa-download text-lg"></i>
                                </span>
                            @endif

                            @if($data->status_magang == 'Belum Konfirmasi' && $data->status == 'Disetujui')
                                <button onclick="openModal('modal-mulai-{{ $data->id }}')" class="text-orange-500 hover:text-orange-600 transition" title="Mulai Magang">
                                    <i class="fas fa-play text-lg"></i>
                                </button>
                            @elseif($data->status_magang == 'Sedang Magang')
                                <button onclick="openModal('modal-selesai-{{ $data->id }}')" class="text-yellow-500 hover:text-yellow-600 transition" title="Selesai Magang">
                                    <i class="fas fa-pause text-lg"></i>
                                </button>
                            @elseif($data->status_magang == 'Selesai')
                                <span class="text-purple-500" title="Magang Selesai">
                                    <i class="fas fa-check-circle text-lg"></i>
                                </span>
                            @endif
                        </td>
                    </tr>

                    <div id="modal-detail-{{ $data->id }}" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center backdrop-blur-sm px-4">
                        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full overflow-hidden transform transition-all">
                            <div class="p-6 md:p-8">
                                <h3 class="font-bold text-xl text-[#111827] mb-6">Detail Pengajuan</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Nama Perusahaan</p>
                                        <p class="font-medium text-[#111827]">{{ $data->perusahaan }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Status Surat</p>
                                        @if($data->status == 'Disetujui')
                                            <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded font-medium">Disetujui</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-0.5 rounded font-medium">{{ $data->status }}</span>
                                        @endif
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500 mb-1">Alamat Perusahaan</p>
                                        <p class="font-medium text-[#111827]">{{ $data->alamat }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Tanggal Mulai</p>
                                        <p class="font-medium text-[#111827]">{{ date('j M Y', strtotime($data->tgl_mulai)) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Tanggal Selesai</p>
                                        <p class="font-medium text-[#111827]">{{ date('j M Y', strtotime($data->tgl_selesai)) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Tanggal Pengajuan</p>
                                        <p class="font-medium text-[#111827]">{{ $data->created_at->format('j M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Status Magang</p>
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded font-medium">{{ $data->status_magang }}</span>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500 mb-1">Keterangan</p>
                                        <p class="font-medium text-[#111827]">{{ $data->keterangan ?? 'Tidak ada keterangan dari admin.' }}</p>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button onclick="closeModal('modal-detail-{{ $data->id }}')" class="px-5 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal-mulai-{{ $data->id }}" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center backdrop-blur-sm px-4">
                        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 md:p-8 transform transition-all">
                            <h3 class="font-bold text-xl text-[#111827] mb-6">Konfirmasi Mulai Magang</h3>
                            
                            <div class="bg-blue-50/50 border border-blue-100 rounded-lg p-4 mb-6">
                                <p class="text-sm font-bold text-blue-900 mb-1">Perusahaan:</p>
                                <p class="text-sm text-blue-800 mb-3">{{ $data->perusahaan }}</p>
                                <p class="text-sm font-bold text-blue-900 mb-1">Periode:</p>
                                <p class="text-sm text-blue-800">{{ date('j M Y', strtotime($data->tgl_mulai)) }} - {{ date('j M Y', strtotime($data->tgl_selesai)) }}</p>
                            </div>

                            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                                Dengan mengkonfirmasi, status magang Anda akan berubah menjadi <span class="font-bold text-blue-600">"Sedang Magang"</span> dan admin akan dapat melihat status terkini Anda di dashboard.
                            </p>

                            <form action="{{ route('riwayat.update_status', $data->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status_magang" value="Sedang Magang">
                                <div class="flex justify-end gap-3">
                                    <button type="button" onclick="closeModal('modal-mulai-{{ $data->id }}')" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-[#2563eb] text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
                                        <i class="far fa-check-circle"></i> Konfirmasi Mulai Magang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="modal-selesai-{{ $data->id }}" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center backdrop-blur-sm px-4">
                        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 md:p-8 transform transition-all">
                            <h3 class="font-bold text-xl text-[#111827] mb-6">Konfirmasi Selesai Magang</h3>
                            
                            <div class="bg-purple-50/50 border border-purple-100 rounded-lg p-4 mb-6">
                                <p class="text-sm font-bold text-purple-900 mb-1">Perusahaan:</p>
                                <p class="text-sm text-purple-800 mb-3">{{ $data->perusahaan }}</p>
                                <p class="text-sm font-bold text-purple-900 mb-1">Periode:</p>
                                <p class="text-sm text-purple-800">{{ date('j M Y', strtotime($data->tgl_mulai)) }} - {{ date('j M Y', strtotime($data->tgl_selesai)) }}</p>
                            </div>

                            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                                Dengan mengkonfirmasi, status magang Anda akan berubah menjadi <span class="font-bold text-purple-600">"Selesai"</span> dan admin akan dapat melihat status terkini Anda di dashboard.
                            </p>

                            <form action="{{ route('riwayat.update_status', $data->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status_magang" value="Selesai">
                                <div class="flex justify-end gap-3">
                                    <button type="button" onclick="closeModal('modal-selesai-{{ $data->id }}')" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-[#9333ea] text-white rounded-lg text-sm font-medium hover:bg-purple-700 transition flex items-center gap-2">
                                        <i class="far fa-check-circle"></i> Konfirmasi Selesai Magang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-500">Belum ada riwayat pengajuan surat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endsection