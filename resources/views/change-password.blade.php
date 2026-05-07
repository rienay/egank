@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Home
            </a>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-lock text-blue-500 mr-2"></i>Reset Password
                </h1>
                <p class="text-gray-600">Ubah password akun Anda untuk keamanan yang lebih baik</p>
            </div>

            <!-- Success Message -->
            @if($message = session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>{{ $message }}
                </div>
            @endif

            <!-- Error Message -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('change-password.update') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key text-blue-500 mr-1"></i>Password Saat Ini
                    </label>
                    <input 
                        type="password" 
                        name="current_password" 
                        placeholder="Masukkan password saat ini" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror"
                        required
                    >
                    @error('current_password')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-500 mr-1"></i>Password Baru
                    </label>
                    <input 
                        type="password" 
                        name="new_password" 
                        placeholder="Minimal 8 karakter" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('new_password') border-red-500 @enderror"
                        required
                    >
                    <p class="text-gray-500 text-xs mt-1">Password harus minimal 8 karakter</p>
                    @error('new_password')
                        <span class="text-red-500 text-sm mt-1 block"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-check-circle text-blue-500 mr-1"></i>Konfirmasi Password Baru
                    </label>
                    <input 
                        type="password" 
                        name="new_password_confirmation" 
                        placeholder="Ulangi password baru" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        required
                    >
                </div>

                <!-- Security Tips -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="font-semibold text-blue-900 mb-2">
                        <i class="fas fa-shield-alt text-blue-500 mr-2"></i>Tips Keamanan Password
                    </h3>
                    <ul class="text-blue-800 text-sm space-y-1">
                        <li>✓ Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                        <li>✓ Jangan gunakan nama atau tanggal yang mudah ditebak</li>
                        <li>✓ Gunakan password yang berbeda untuk setiap akun</li>
                        <li>✓ Jangan bagikan password Anda kepada siapapun</li>
                    </ul>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 pt-4">
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-semibold"
                    >
                        <i class="fas fa-save mr-2"></i>Simpan Password Baru
                    </button>
                    <a 
                        href="{{ route('dashboard') }}" 
                        class="inline-flex items-center px-8 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-semibold"
                    >
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
