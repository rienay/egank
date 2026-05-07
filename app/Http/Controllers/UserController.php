<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Mail\UserAccountCreated;

class UserController extends Controller
{
    private function prodiOptions(): array
    {
        return [
            'D4 Teknologi Rekayasa Perangkat Lunak',
            'D4 Teknologi Rekayasa Multimedia',
            'D4 Rekayasa Keamanan Siber',
            'D4 Teknologi Rekayasa Mekatronika',
            'D4 Teknologi Rekayasa Kimia Industri',
            'D4 Teknologi Rekayasa Energi Terbarukan',
            'D4 Pengembangan Produk Agroindustri',
            'D4 Teknik Pengendalian Pencemaran Lingkungan',
            'D4 Akuntansi Lembaga Keuangan Syariah',
            'D3 Teknik Informatika',
            'D3 Teknik Elektronika',
            'D3 Teknik Listrik',
            'D3 Teknik Mesin',
        ];
    }

    public function index()
    {
        // Mengambil user dengan role mahasiswa saja agar Admin tidak ikut muncul
        $users = User::where('role', 'mahasiswa')->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }

    public function create()
    {
        return view('admin.users.create', [
            'prodiOptions' => $this->prodiOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'      => 'required|unique:users,nim',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'prodi'    => ['required', 'string', Rule::in($this->prodiOptions())],
            'angkatan' => 'required|string',
            'semester' => 'required|string|max:10',
        ]);

        $defaultPassword = 'password123';

        $user = User::create([
            'nim'      => $request->nim,
            'name'     => $request->name,
            'email'    => $request->email,
            'prodi'    => $request->prodi,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
            'password' => Hash::make($defaultPassword),
            'role'     => 'mahasiswa',
        ]);

        try {
            // Kirim email notifikasi
            Mail::to($user->email)->send(new UserAccountCreated($user, $defaultPassword));
            return redirect()->route('user.index')->with('success', 'Mahasiswa berhasil ditambahkan dan email informasi akun telah dikirim!');
        } catch (\Exception $e) {
            // Jika gagal kirim email, data tetap tersimpan tapi tampilkan pesan peringatan
            return redirect()->route('user.index')->with('success', 'Mahasiswa berhasil ditambahkan! Namun sistem gagal mengirim email notifikasi. Pastikan konfigurasi SMTP di .env sudah benar.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', [
            'user' => $user,
            'prodiOptions' => $this->prodiOptions(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nim'      => 'required|unique:users,nim,' . $id,
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'prodi'    => ['required', 'string', Rule::in($this->prodiOptions())],
            'angkatan' => 'required|string',
            'semester' => 'required|string|max:10',
        ]);

        $user->update($request->only('nim', 'name', 'email', 'prodi', 'angkatan', 'semester'));
        return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->update(['password' => Hash::make('password123')]);
        return redirect()->back()->with('success', 'Password mahasiswa '.$user->name.' berhasil direset menjadi "password123".');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'rt_rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'nama_dosen_pembimbing' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'rt_rw' => $request->rt_rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'provinsi' => $request->provinsi,
            'nama_dosen_pembimbing' => $request->nama_dosen_pembimbing,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Store new photo
            $photoPath = $request->file('photo')->store('profiles', 'public');
            $data['photo'] = $photoPath;
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function showChangePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah!');
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah!');
    }
}