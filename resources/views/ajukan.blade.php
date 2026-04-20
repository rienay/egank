@extends('layouts.main')

@section('content')
<div class="bg-slate-50 min-h-screen pb-12 pt-8">
    <div class="max-w-3xl mx-auto px-4">
        
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#111827]">Pengajuan Surat Magang</h1>
            <p class="text-gray-500 text-sm mt-1">Isi formulir untuk mengajukan surat pengantar magang industri</p>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle text-xl"></i>
            <div>
                <p class="font-bold">Berhasil!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="p-6 md:p-8 border-b border-gray-50">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                        <i class="far fa-file-alt text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-[#111827] text-lg">Formulir Pengajuan Surat Izin Magang Industri</h2>
                        <p class="text-sm text-gray-500">Pastikan semua data terisi dengan benar</p>
                    </div>
                </div>

                <form action="{{ route('ajukan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-5">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">NIM <span class="text-red-500">*</span></label>
                                <input type="text" name="nim" placeholder="Contoh: 240102122" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" placeholder="Contoh: Sulis Rahayu" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Mahasiswa <span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="Contoh: sulis@pnc.ac.id" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            <p class="text-[11px] text-gray-400 mt-1">Notifikasi pengajuan akan dikirimkan ke email ini.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Program Studi <span class="text-red-500">*</span></label>
                                <input type="text" name="prodi" placeholder="Contoh: Teknik Informatika" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Angkatan <span class="text-red-500">*</span></label>
                                <input type="text" name="angkatan" placeholder="Contoh: 2024" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Perusahaan/Instansi <span class="text-red-500">*</span></label>
                            <input type="text" name="perusahaan" placeholder="Contoh: PT. Maju Jaya Technology" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Perusahaan <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat" placeholder="Masukkan alamat lengkap" class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Mulai <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_mulai" class="w-full bg-gray-50 border border-gray-200 text-gray-500 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Selesai <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_selesai" class="w-full bg-gray-50 border border-gray-200 text-gray-500 text-sm rounded-lg focus:ring-blue-500 block p-3 outline-none" required>
                            </div>
                        </div>

                        <div class="pt-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Surat Pendukung <span class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-500 mb-3">Upload surat penerimaan, proposal, atau dokumen pendukung</p>
                            
                            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition flex flex-col items-center justify-center group bg-white">
                                <input type="file" id="file-upload" name="file_pendukung[]" multiple accept=".pdf,.jpg,.jpeg,.png" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                                    <i class="fas fa-upload"></i>
                                </div>
                                <p class="text-sm font-semibold text-[#111827] mb-1">Klik atau seret file ke sini</p>
                                <p class="text-xs text-gray-400 mb-3">Maksimal 5 file (.PDF, .JPG, .PNG)</p>
                                
                                <div id="file-preview" class="w-full bg-gray-50 rounded-lg p-3 hidden z-20 relative">
                                    <p id="file-count" class="text-xs font-bold text-gray-700 mb-2 border-b pb-2 text-left">0/5 file terpilih</p>
                                    <div id="file-names" class="flex flex-col gap-1 text-left"></div>
                                </div>
                            </div>
                        </div>

                    </div> 
                    
                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-[#f97316] rounded-lg hover:bg-[#ea580c] transition flex items-center gap-2">
                            <i class="far fa-paper-plane"></i> Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h3 class="font-bold text-[#111827] text-lg mb-4">Panduan Pengajuan</h3>
            <ul class="space-y-3 text-sm text-gray-500">
                <li class="leading-relaxed">Pastikan Anda telah mendapatkan surat balasan/penerimaan dari perusahaan</li>
                <li class="leading-relaxed">Upload surat pendukung minimal 1 file (maksimal 5 file, masing-masing maks. 5MB)</li>
                <li class="leading-relaxed">Format file yang didukung: PDF, JPG, JPEG, PNG</li>
                <li class="leading-relaxed">Isi semua field yang bertanda bintang (*) dengan lengkap dan benar</li>
                <li class="leading-relaxed">Periksa kembali data sebelum mengirim pengajuan</li>
                <li class="leading-relaxed">Surat akan diproses dalam 2-3 hari kerja</li>
                <li class="leading-relaxed">Anda akan mendapat notifikasi via email setelah surat disetujui</li>
            </ul>
        </div>

    </div> </div> <script>
    document.getElementById('file-upload').addEventListener('change', function(event) {
        const fileList = event.target.files;
        const previewContainer = document.getElementById('file-preview');
        const countText = document.getElementById('file-count');
        const namesContainer = document.getElementById('file-names');
        
        namesContainer.innerHTML = ''; 

        if (fileList.length > 0) {
            previewContainer.classList.remove('hidden'); 
            
            if(fileList.length > 5) {
                alert('Maksimal hanya boleh 5 file!');
                this.value = ''; 
                previewContainer.classList.add('hidden');
                return;
            }

            countText.innerText = `${fileList.length} file berhasil dipilih:`;
            
            for(let i=0; i<fileList.length; i++) {
                namesContainer.innerHTML += `
                    <div class="flex items-center text-xs text-blue-700 bg-blue-50 p-2 rounded truncate">
                        <i class="fas fa-file-alt mr-2 text-blue-400"></i> ${fileList[i].name}
                    </div>
                `;
            }
        } else {
            previewContainer.classList.add('hidden');
        }
    });
</script>
@endsection