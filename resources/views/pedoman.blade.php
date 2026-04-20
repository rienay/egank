@extends('layouts.main')

@section('content')
<div class="bg-slate-50 min-h-screen pb-12">
    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pedoman Program Magang Industri</h1>
            <p class="text-gray-500 text-sm mt-1">Panduan lengkap alur dan persyaratan magang untuk mahasiswa Teknik Informatika Politeknik Negeri Cilacap.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-3 text-blue-700">Tentang Program Magang</h2>
            <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                <p>Program Magang Industri merupakan mata kuliah wajib bagi mahasiswa semester akhir untuk memberikan pengalaman praktis di dunia kerja. Mahasiswa diharapkan dapat mengaplikasikan kemampuan teknis seperti pengembangan web, mobile, atau desain UI/UX di lingkungan profesional.</p>
                <p>Durasi magang dilaksanakan sesuai dengan kalender akademik, yaitu minimal selama 4 bulan hingga maksimal 6 bulan (satu semester penuh).</p>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-xl font-bold text-[#111827] mb-6">Langkah-Langkah Pelaksanaan Magang</h2>
            
            <div class="flex flex-col gap-4">
                @php
                    $steps = [
                        [
                            'no' => 1, 
                            'title' => 'Persiapan dan Pendaftaran', 
                            'desc' => 'Mahasiswa mencari tempat magang yang sesuai dengan bidang studi dan mengisi formulir pendaftaran program magang.', 
                            'icon' => 'far fa-file-alt'
                        ],
                        [
                            'no' => 2, 
                            'title' => 'Pengajuan Surat Pengantar', 
                            'desc' => 'Mengajukan surat pengantar magang melalui sistem e-Surat dengan melengkapi data perusahaan/instansi tujuan.', 
                            'icon' => 'far fa-calendar-alt'
                        ],
                        [
                            'no' => 3, 
                            'title' => 'Approval dan Pembekalan', 
                            'desc' => 'Setelah surat disetujui, mahasiswa mengikuti pembekalan magang yang diselenggarakan oleh jurusan.', 
                            'icon' => 'fas fa-user-friends'
                        ],
                        [
                            'no' => 4, 
                            'title' => 'Pelaksanaan Magang', 
                            'desc' => 'Melaksanakan kegiatan magang di industri/perusahaan dengan bimbingan mentor dari industri dan dosen pembimbing.', 
                            'icon' => 'far fa-check-square'
                        ],
                        [
                            'no' => 5, 
                            'title' => 'Monitoring dan Evaluasi', 
                            'desc' => 'Melakukan konsultasi berkala dengan dosen pembimbing dan mengisi logbook kegiatan magang secara rutin.', 
                            'icon' => 'fas fa-book-open'
                        ],
                        [
                            'no' => 6, 
                            'title' => 'Penyelesaian dan Pelaporan', 
                            'desc' => 'Menyelesaikan magang, membuat laporan akhir, dan mengikuti seminar hasil magang.', 
                            'icon' => 'far fa-bookmark'
                        ],
                    ];
                @endphp

                @foreach($steps as $step)
                <div class="bg-white rounded-xl shadow-sm p-5 md:p-6 flex items-center border border-gray-100 hover:border-blue-200 transition duration-200">
                    <div class="w-10 h-10 shrink-0 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-base mr-5">
                        {{ $step['no'] }}
                    </div>
                    
                    <div class="flex-grow pr-4">
                        <h3 class="font-bold text-[#111827] text-base mb-1">{{ $step['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                    
                    <i class="{{ $step['icon'] }} text-blue-600 text-lg shrink-0 opacity-80 hidden sm:block"></i>
                </div>
                @endforeach
            </div>
        </div>

        <hr class="mb-10 border-gray-200">

        <div class="mb-10">
            <h2 class="text-xl font-bold text-[#111827] mb-3">Kegiatan yang Harus Dilaksanakan Setelah Magang</h2>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Setelah menyelesaikan periode magang di industri, mahasiswa diwajibkan untuk menyelesaikan beberapa kegiatan berikut sebagai syarat kelulusan mata kuliah magang:</p>

            <div class="space-y-6">
                <div class="rounded-xl overflow-hidden border border-gray-200 bg-white shadow-sm">
                    <div class="bg-[#ea580c] p-4 text-white">
                        <h3 class="font-bold text-lg mb-1">Penyusunan Laporan Magang</h3>
                        <div class="flex items-center text-sm text-white/90">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>Maksimal 2 minggu setelah selesai magang</span>
                        </div>
                    </div>
                    <div class="p-5 md:p-6">
                        <ul class="flex flex-col gap-4 text-sm md:text-base text-gray-600">
                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 shrink-0 text-green-600">
                                    <i class="far fa-check-circle text-[1.125rem]"></i>
                                </div>
                                <span class="leading-relaxed">Menyusun laporan magang sesuai format yang telah ditentukan</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 shrink-0 text-green-600">
                                    <i class="far fa-check-circle text-[1.125rem]"></i>
                                </div>
                                <span class="leading-relaxed">Laporan harus mencakup: Pendahuluan, Profil Perusahaan, Kegiatan Magang, Hasil dan Pembahasan, Kesimpulan dan Saran</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 shrink-0 text-green-600">
                                    <i class="far fa-check-circle text-[1.125rem]"></i>
                                </div>
                                <span class="leading-relaxed">Melampirkan dokumentasi kegiatan magang</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 shrink-0 text-green-600">
                                    <i class="far fa-check-circle text-[1.125rem]"></i>
                                </div>
                                <span class="leading-relaxed">Menyertakan logbook yang telah ditandatangani mentor industri</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="rounded-xl overflow-hidden border border-gray-200 bg-white shadow-sm">
                    <div class="bg-[#ea580c] p-4 text-white">
                        <h3 class="font-bold text-lg mb-1">Seminar Hasil Magang</h3>
                        <div class="flex items-center text-sm text-white/90">
                            <i class="far fa-check-square mr-2"></i>
                            <span>Syarat: Laporan Disetujui</span>
                        </div>
                    </div>
                    <div class="p-5 md:p-6">
                        <ul class="flex flex-col gap-4 text-sm md:text-base text-gray-600">
                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 shrink-0 text-green-600">
                                    <i class="far fa-check-circle text-[1.125rem]"></i>
                                </div>
                                <span class="leading-relaxed">Presentasi hasil karya atau sistem yang dikembangkan di industri.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 shrink-0 text-green-600">
                                    <i class="far fa-check-circle text-[1.125rem]"></i>
                                </div>
                                <span class="leading-relaxed">Mengumpulkan form nilai dari industri dalam amplop tertutup.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#fefaf9] border border-red-400 rounded-xl p-6 mb-8">
            <h3 class="text-[#991b1b] font-bold text-base mb-4 flex items-center">
                <i class="fas fa-exclamation-triangle mr-2 text-sm"></i> Catatan Penting
            </h3>
            <ul class="space-y-3 text-sm text-[#b91c1c] list-disc list-inside marker:text-[#b91c1c]">
                <li>Keterlambatan pengumpulan laporan akan mengurangi nilai akhir magang</li>
                <li>Mahasiswa yang tidak mengikuti seminar hasil magang tidak akan mendapatkan nilai</li>
                <li>Dokumen yang tidak lengkap akan dikembalikan untuk dilengkapi</li>
                <li>Plagiarisme dalam laporan magang akan mengakibatkan nilai E (Tidak Lulus)</li>
            </ul>
        </div>

        <div class="bg-[#ebfbf1] rounded-xl p-8 mb-8 border border-green-50">
            <h3 class="text-[#111827] font-bold text-lg mb-2">Unduh Berkas Magang</h3>
            <p class="text-gray-600 text-sm mb-6 leading-relaxed">Unduh template laporan magang, logbook, dan dokumen pendukung lainnya yang diperlukan selama program magang.</p>
            
            <a href="#" class="bg-[#00a651] hover:bg-green-700 text-white text-sm font-medium py-2.5 px-6 rounded-md transition inline-flex items-center w-max">
                <i class="fas fa-download mr-2 text-xs"></i> unduh
            </a>
        </div>

        <div class="bg-[#f0f7ff] rounded-xl p-8 mb-4 border border-blue-50">
            <h3 class="text-[#111827] font-bold text-lg mb-4">Butuh Bantuan?</h3>
            <p class="text-gray-600 text-sm mb-6">Jika Anda memiliki pertanyaan atau kendala terkait program magang, silakan hubungi:</p>
            
            <div class="bg-white rounded-lg p-6 border border-gray-100 shadow-sm">
                <p class="font-bold text-gray-800 mb-1 text-sm">Koordinator Magang Jurusan</p>
                <p class="text-gray-600 mb-1 text-sm">Dr. Ahmad Fauzi, M.Kom</p>
                <p class="text-sm mb-1 text-gray-600">Email: <a href="mailto:ahmad.fauzi@pnc.ac.id" class="text-blue-500 hover:underline">ahmad.fauzi@pnc.ac.id</a></p>
                <p class="text-sm mb-5 text-gray-600">Telp: (0282) 123-4567</p>
                <p class="text-xs text-gray-400">Jam Konsultasi: Senin - Jumat, 09.00 - 15.00 WIB</p>
            </div>
        </div>

    </div>
</div>
@endsection