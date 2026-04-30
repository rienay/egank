@extends('layouts.main')

@section('content')

<header class="relative h-[300px] md:h-[420px] flex items-center justify-center text-center bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/img/backround.png');">
      
    <div class="px-4 relative z-10">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-3 text-white tracking-wide leading-tight">
            Program Magang Industri
        </h1>
        <p class="text-base md:text-lg text-gray-300 font-medium">
            Politeknik Negeri Cilacap
        </p>
    </div>
</header>

<section class="max-w-5xl mx-auto px-6 py-10 md:py-14">
    <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-900 border-l-4 border-blue-600 pl-4">
        Apa itu Magang Industri?
    </h2>

    <div class="space-y-5 text-gray-600 leading-relaxed text-left md:text-justify text-base md:text-lg">
        <p>
            Magang Industri adalah program wajib bagi mahasiswa Politeknik Negeri Cilacap
            yang bertujuan untuk memberikan pengalaman kerja nyata di dunia industri. Program ini dirancang untuk menjembatani
            teori yang dipelajari di kampus dengan praktik langsung di lapangan.
        </p>
        <p>
            Melalui program magang, mahasiswa akan mendapatkan kesempatan untuk 
            mengembangkan keterampilan teknis dan soft skills, serta membangun jaringan 
            profesional yang akan berguna untuk karir masa depan.
        </p>
        <p>
            Program magang dilaksanakan pada semester 6 dengan durasi minimal 3 bulan
            atau setara dengan 480 jam kerja efektif. Mahasiswa akan dibimbing oleh
            dosen pembimbing dari kampus dan mentor dari industri untuk memastikan 
            proses pembelajaran berjalan optimal.
        </p>
    </div>
</section>

<section class="max-w-6xl mx-auto py-8 px-6 grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
    <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm hover:shadow-md border-t-4 border-blue-500 transition">
        <i class="far fa-calendar-alt text-blue-500 text-xl md:text-2xl mb-3"></i>
        <h3 class="font-bold text-sm md:text-base mb-1">Periode Magang</h3>
        <p class="text-xs md:text-sm text-gray-500">Semester 6 - Agustus s/d Desember 2026</p>
    </div>

    <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm hover:shadow-md border-t-4 border-orange-500 transition">
        <i class="fas fa-hourglass-half text-orange-500 text-xl md:text-2xl mb-3"></i>
        <h3 class="font-bold text-sm md:text-base mb-1">Durasi</h3>
        <p class="text-xs md:text-sm text-gray-500">Minimal 3 Bulan (480 Jam)</p>
    </div>

    <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm hover:shadow-md border-t-4 border-green-500 transition">
        <i class="fas fa-map-marker-alt text-green-500 text-xl md:text-2xl mb-3"></i>
        <h3 class="font-bold text-sm md:text-base mb-1">Tempat</h3>
        <p class="text-xs md:text-sm text-gray-500">Industri/Perusahaan</p>
    </div>

    <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm hover:shadow-md border-t-4 border-purple-500 transition">
        <i class="fas fa-certificate text-purple-500 text-xl md:text-2xl mb-3"></i>
        <h3 class="font-bold text-sm md:text-base mb-1">Sertifikat</h3>
        <p class="text-xs md:text-sm text-gray-500">Sertifikat dari Industri</p>
    </div>
</section>

<section class="max-w-6xl mx-auto py-8 px-5">
    <div class="bg-white rounded-2xl p-6 md:p-10 shadow-lg flex flex-col md:flex-row gap-8 items-center border border-gray-100">
        <div class="w-full md:w-1/3 text-center">
            <div class="relative inline-block">
                <img src="{{ asset('img/buvika.png') }}" alt="Koordinator Magang"
                    class="w-48 h-48 md:w-64 md:h-64 object-cover rounded-2xl shadow-md mx-auto border-4 border-white">
                <div class="absolute inset-0 rounded-2xl shadow-inner pointer-events-none"></div>
            </div>
            <h3 class="font-bold text-lg mt-4">Cahya Vikasari, S.T., M.Eng.</h3>
            <p class="text-gray-500 text-sm">Koordinator Magang Jurusan</p>
            <p class="text-blue-600 font-medium text-sm">cahyavikasari@pnc.ac.id</p>
        </div>

        <div class="w-full md:w-2/3 bg-blue-50 p-6 md:p-8 rounded-2xl border-l-8 border-blue-500">
            <div class="space-y-4 italic text-gray-700 text-sm md:text-base leading-relaxed">
                <p>
                    "Program magang industri merupakan bagian integral dari 
                    kurikulum kami yang dirancang untuk mempersiapkan mahasiswa 
                    menghadapi tantangan dunia kerja. Kami berkomitmen untuk 
                    memastikan setiap mahasiswa mendapatkan pengalaman magang yang berkualitas dan bermakna.
                </p>
                <p>
                    Melalui kerjasama dengan berbagai industri terkemuka, kami
                    menyediakan kesempatan bagi mahasiswa untuk belajar langsung
                    dari para profesional berpengalaman. Program ini tidak hanya
                    fokus pada pengembangan keterampilan teknis, tetapi juga 
                    membangun karakter profesional, etika kerja, dan kemampuan beradaptasi.
                </p>
                <p>
                    Kami mendorong mahasiswa untuk aktif berkomunikasi dengan koordinator 
                    magang terkait kendala atau pertanyaan seputar program magang. Tim kami 
                    siap membantu memastikan pengalaman magang Anda berjalan dengan lancar dan 
                    memberikan manfaat maksimal untuk pengembangan karir Anda."
                </p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto py-12 px-6 bg-slate-50 rounded-3xl mb-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center md:text-left">
        Jadwal dan Tanggal Penting Magang 2026
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm border border-gray-100">
            <div class="bg-orange-500 text-white w-16 h-16 flex flex-col items-center justify-center rounded-xl shrink-0">
                <span class="text-xl font-bold">15</span>
                <p class="text-[10px]">Januari</p>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Pendaftaran Dibuka</h4>
                <p class="text-xs text-gray-500">Mahaiswa mulai mendaftar dan mencari tempat magang</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm border border-gray-100">
            <div class="bg-orange-500 text-white w-16 h-16 flex flex-col items-center justify-center rounded-xl shrink-0">
                <span class="text-xl font-bold">28</span>
                <p class="text-[10px]">Februari</p>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Batas Pengajuan SUrat</h4>
                <p class="text-xs text-gray-500">Deadline pengajuan surat pengantar magang</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm border border-gray-100">
            <div class="bg-blue-600 text-white w-16 h-16 flex flex-col items-center justify-center rounded-xl shrink-0">
                <span class="text-xl font-bold">01</span>
                <p class="text-[10px]">Maret</p>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Mulai Magang</h4>
                <p class="text-xs text-gray-500">Periode magang resmi dimulai</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl flex items-center gap-4 shadow-sm border border-gray-100">
            <div class="bg-green-500 text-white w-16 h-16 flex flex-col items-center justify-center rounded-xl shrink-0">
                <span class="text-xl font-bold">30</span>
                <p class="text-[10px]">Juni</p>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm md:text-base">Selesai Magang</h4>
                <p class="text-xs text-gray-500">Batas akhir periode magang dan pengumpulan laporan</p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto py-8 px-6 mb-12">
    <h2 class="text-2xl font-bold mb-8">Galeri Kegiatan Magang Mahasiswa</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm group border border-gray-100">
            <div class="overflow-hidden">
                <img src="{{ asset('img/satu.png') }}" alt="Magang di Perusahaan Teknologi"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
            </div>
            <p class="p-4 text-sm text-gray-600 font-medium">Mahasiswa sedang magang di perusahaan teknologi</p>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm group border border-gray-100">
            <div class="overflow-hidden">
                <img src="{{ asset('img/dua.png') }}" alt="Diskusi Project"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
            </div>
            <p class="p-4 text-sm text-gray-600 font-medium">Diskusi project dengan mentor industri</p>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm group border border-gray-100">
            <div class="overflow-hidden">
                <img src="{{ asset('img/tiga.png') }}" alt="Kolaborasi Tim"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
            </div>
            <p class="p-4 text-sm text-gray-600 font-medium">Kolaborasi tim dalam projek industri</p>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm group border border-gray-100">
            <div class="overflow-hidden">
                <img src="{{ asset('img/empat.png') }}" alt="Presentasi Hasil"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
            </div>
            <p class="p-4 text-sm text-gray-600 font-medium">Presentasi hasil kerja magang</p>
        </div>

    </div>
</section>

<section class="max-w-6xl mx-auto px-6 mb-16">
    <div class="bg-blue-700 py-10 px-6 md:p-12 rounded-[2rem] text-center shadow-2xl">
        <h2 class="text-2xl md:text-4xl font-bold text-white mb-4">
            Siap Memulai Perjalanan Magang Anda?
        </h2>
        <p class="text-blue-100 mb-8 max-w-xl mx-auto text-sm md:text-base">
            Segera ajukan surat pengantar magang Anda dan mulai pengalaman berharga di industri!
        </p>
        <a href="#" class="inline-block bg-white text-blue-700 px-8 md:px-12 py-3 md:py-4 rounded-2xl font-bold hover:bg-blue-50 transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
            Ajukan Surat Pengantar
        </a>
    </div>
</section>

@endsection