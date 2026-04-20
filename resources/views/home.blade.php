@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="relative h-[420px] flex items-center justify-center text-center bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://via.placeholder.com/1200x400');">
    
    <div class="px-4">
        <h1 class="text-5xl font-extrabold mb-3 text-white tracking-wide">
            Program Magang Industri
        </h1>
        <p class="text-lg text-gray-300">
            Politeknik Negeri Cilacap
        </p>
    </div>
</header>

<!-- PENJELASAN -->
<section class="max-w-5xl mx-auto px-6 py-14">
    <h2 class="text-3xl font-bold mb-6 text-gray-900 border-l-4 border-blue-500 pl-4">
        Apa itu Magang Industri?
    </h2>

    <div class="space-y-5 text-gray-600 leading-relaxed text-justify text-lg">
        <p>
            Magang Industri adalah program wajib bagi mahasiswa Politeknik Negeri Cilacap
            yang bertujuan untuk memberikan pengalaman kerja nyata di dunia industri,
            perusahaan, atau instansi terkait. Program ini dirancang untuk menjembatani
            teori yang dipelajari di kampus dengan praktik langsung di lapangan.
        </p>
        <p>
            Melalui program magang, mahasiswa akan mendapatkan kesempatan untuk 
            mengaplikasikan pengetahuan yang telah diperoleh selama perkuliahan, 
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

<!-- INFO CARD -->
<section class="max-w-6xl mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-4 gap-6">
    
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300 border-t-4 border-blue-500">
        <i class="far fa-calendar-alt text-blue-500 text-2xl mb-4"></i>
        <h3 class="font-bold mb-1">Periode Magang</h3>
        <p class="text-sm text-gray-500">Semester 6 - Maret s/d Juni 2026</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300 border-t-4 border-orange-500">
        <i class="fas fa-hourglass-half text-orange-500 text-2xl mb-4"></i>
        <h3 class="font-bold mb-1">Durasi</h3>
        <p class="text-sm text-gray-500">Minimal 3 Bulan</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300 border-t-4 border-green-500">
        <i class="fas fa-map-marker-alt text-green-500 text-2xl mb-4"></i>
        <h3 class="font-bold mb-1">Tempat</h3>
        <p class="text-sm text-gray-500">Industri/Perusahaan</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300 border-t-4 border-purple-500">
        <i class="fas fa-certificate text-purple-500 text-2xl mb-4"></i>
        <h3 class="font-bold mb-1">Sertifikat</h3>
        <p class="text-sm text-gray-500">Dari Industri</p>
    </div>

</section>

<!-- KOORDINATOR -->
<section class="max-w-6xl mx-auto py-8 px-5">
    <div class="bg-white rounded-2xl p-8 shadow-lg flex flex-col md:flex-row gap-8 items-center">
        
        <div class="md:w-1/3 text-center">
            <img src="{{ asset('img/bu-vika.png') }}"
                class="rounded-xl shadow-lg mx-auto border-4 border-white mb-4">
            <h3 class="font-bold text-lg">Cahya Vikasari, S.T., M.Eng.</h3>
            <p class="text-gray-600">Koordinator Magang Jurusan</p>
            <p class="text-blue-600 text-sm">cahyavikasari@pnc.ac.id</p>
        </div>

        <div class="md:w-2/3 bg-blue-50 p-6 rounded-xl border-l-4 border-blue-500 shadow-inner">
            <p class="italic text-gray-700">
                "Program magang industri merupakan bagian integral dari kurikulum kami yang dirancang untuk 
                mempersiapkan mahasiswa menghadapi tantangan dunia kerja. Kami berkomitmen untuk memastikan 
                setiap mahasiswa mendapatkan pengalaman magang yang berkualitas dan bermakna."Program magang 
                dirancang untuk mempersiapkan mahasiswa menghadapi dunia kerja secara nyata."
            </p>
            <p class="italic text-gray-700">
                Melalui kerjasama dengan berbagai industri terkemuka, kami menyediakan kesempatan bagi 
                mahasiswa untuk belajar langsung dari para profesional berpengalaman. Program ini tidak 
                hanya fokus pada pengembangan keterampilan teknis, tetapi juga membangun karakter 
                profesional, etika kerja, dan kemampuan beradaptasi.
            </p>
            <p class="italic text-gray-700">
                Kami mendorong mahasiswa untuk aktif berkomunikasi dengan koordinator 
                magang terkait kendala atau pertanyaan seputar program magang. Tim 
                kami siap membantu memastikan pengalaman magang Anda berjalan dengan 
                lancar dan memberikan manfaat maksimal untuk pengembangan karir Anda."
            </p>
        </div>

    </div>
</section>

<!-- JADWAL -->
<section class="max-w-6xl mx-auto py-14 px-6 bg-gradient-to-br from-orange-50 to-yellow-50 rounded-2xl shadow-inner mb-12">
    
    <h2 class="text-2xl font-bold text-gray-800 mb-8">
        Jadwal Penting Magang 2026
    </h2>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-white p-4 rounded-xl flex items-center gap-4 shadow hover:shadow-lg transition">
            <div class="bg-orange-500 text-white p-4 rounded-lg text-center">
                <span class="text-2xl font-bold">15</span>
                <p class="text-xs">JAN</p>
            </div>
            <div>
                <h4 class="font-bold">Pendaftaran</h4>
                <p class="text-sm text-gray-500">Mulai daftar</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl flex items-center gap-4 shadow hover:shadow-lg transition">
            <div class="bg-blue-500 text-white p-4 rounded-lg text-center">
                <span class="text-2xl font-bold">01</span>
                <p class="text-xs">MAR</p>
            </div>
            <div>
                <h4 class="font-bold">Mulai Magang</h4>
                <p class="text-sm text-gray-500">Dimulai</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl flex items-center gap-4 shadow hover:shadow-lg transition">
            <div class="bg-orange-500 text-white p-4 rounded-lg text-center">
                <span class="text-2xl font-bold">15</span>
                <p class="text-xs">JAN</p>
            </div>
            <div>
                <h4 class="font-bold">Pendaftaran</h4>
                <p class="text-sm text-gray-500">Mulai daftar</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl flex items-center gap-4 shadow hover:shadow-lg transition">
            <div class="bg-blue-500 text-white p-4 rounded-lg text-center">
                <span class="text-2xl font-bold">01</span>
                <p class="text-xs">MAR</p>
            </div>
            <div>
                <h4 class="font-bold">Mulai Magang</h4>
                <p class="text-sm text-gray-500">Dimulai</p>
            </div>
        </div>

    </div>

</section>

<!-- GALERI -->
<section class="max-w-6xl mx-auto py-8 px-6 mb-12">
    
    <h2 class="text-2xl font-bold mb-8">Galeri</h2>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl overflow-hidden shadow group">
            <img src="https://via.placeholder.com/500x300"
                class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
            <p class="p-4 text-sm text-gray-600">Kegiatan magang mahasiswa</p>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow group">
            <img src="https://via.placeholder.com/500x300"
                class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
            <p class="p-4 text-sm text-gray-600">Diskusi dengan mentor</p>
        </div>
        <div class="bg-white rounded-xl overflow-hidden shadow group">
            <img src="https://via.placeholder.com/500x300"
                class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
            <p class="p-4 text-sm text-gray-600">Kegiatan magang mahasiswa</p>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow group">
            <img src="https://via.placeholder.com/500x300"
                class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
            <p class="p-4 text-sm text-gray-600">Diskusi dengan mentor</p>
        </div>

    </div>

</section>

<!-- CTA -->
<section class="max-w-6xl mx-auto px-6 mb-16">
    <div class="bg-blue-600 p-10 rounded-2xl text-center shadow-xl">
        
        <h2 class="text-3xl font-bold text-white mb-3">
            Siap Magang?
        </h2>

        <p class="text-blue-100 mb-6">
            Ajukan sekarang dan mulai pengalamanmu!
        </p>

        <button class="bg-white text-blue-600 px-10 py-4 rounded-xl font-bold hover:bg-blue-100 hover:scale-105 transition-all duration-300 shadow-lg">
            Ajukan Sekarang
        </button>

    </div>
</section>

@endsection