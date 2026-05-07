<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampusProfile;
use Illuminate\Support\Facades\Storage;

class CampusProfileController extends Controller
{
    public function index()
    {
        $profiles = CampusProfile::latest()->get();
        return view('admin.profile_kampus.index', compact('profiles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kementerian' => 'required',
            'nama_kampus' => 'required',
            'alamat_kampus' => 'required',
            'telepon_kampus' => 'required',
            'fax_kampus' => 'required',
            'website' => 'required',
            'email_kampus' => 'required|email',
            'nama_kontak_person' => 'required',
            'telepon_kontak_person' => 'required',
            'jabatan_penandatangan' => 'required',
            'nama_penandatangan' => 'required',
            'nip_penandatangan' => 'required',
            'logo_kampus' => 'nullable|image|max:2048',
            'ttd_image' => 'nullable|image|max:2048',
            'stempel_image' => 'nullable|image|max:2048',
        ]);

        // Proses upload file
        if ($request->hasFile('logo_kampus')) {
            $data['logo_kampus'] = $request->file('logo_kampus')->store('kampus', 'public');
        }
        if ($request->hasFile('ttd_image')) {
            $data['ttd_image'] = $request->file('ttd_image')->store('kampus', 'public');
        }
        if ($request->hasFile('stempel_image')) {
            $data['stempel_image'] = $request->file('stempel_image')->store('kampus', 'public');
        }

        CampusProfile::create($data);

        return redirect()->route('campus-profile.index')
            ->with('success', 'Profil kampus berhasil ditambahkan.');
    }

    public function update(Request $request, CampusProfile $campus_profile)
    {
        $data = $request->validate([
            'kementerian' => 'required',
            'nama_kampus' => 'required',
            'alamat_kampus' => 'required',
            'telepon_kampus' => 'required',
            'fax_kampus' => 'required',
            'website' => 'required',
            'email_kampus' => 'required|email',
            // 'kode_surat' dihapus dari sini karena sudah dipindah ke pengajuan_magangs
            'nama_kontak_person' => 'required',
            'telepon_kontak_person' => 'required',
            'jabatan_penandatangan' => 'required',
            'nama_penandatangan' => 'required',
            'nip_penandatangan' => 'required',
            'logo_kampus' => 'nullable|image|max:2048',
            'ttd_image' => 'nullable|image|max:2048',
            'stempel_image' => 'nullable|image|max:2048',
        ]);

        // update logo
        if ($request->hasFile('logo_kampus')) {
            if ($campus_profile->logo_kampus) {
                Storage::disk('public')->delete($campus_profile->logo_kampus);
            }
            $data['logo_kampus'] = $request->file('logo_kampus')->store('kampus', 'public');
        }

        // update ttd
        if ($request->hasFile('ttd_image')) {
            if ($campus_profile->ttd_image) {
                Storage::disk('public')->delete($campus_profile->ttd_image);
            }
            $data['ttd_image'] = $request->file('ttd_image')->store('kampus', 'public');
        }

        // update stempel
        if ($request->hasFile('stempel_image')) {
            if ($campus_profile->stempel_image) {
                Storage::disk('public')->delete($campus_profile->stempel_image);
            }
            $data['stempel_image'] = $request->file('stempel_image')->store('kampus', 'public');
        }

        $campus_profile->update($data);

        return redirect()->route('campus-profile.index')
            ->with('success', 'Profil kampus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profile = CampusProfile::findOrFail($id);

        if ($profile->logo_kampus) Storage::disk('public')->delete($profile->logo_kampus);
        if ($profile->ttd_image) Storage::disk('public')->delete($profile->ttd_image);
        if ($profile->stempel_image) Storage::disk('public')->delete($profile->stempel_image);

        $profile->delete();

        return redirect()->route('campus-profile.index')
            ->with('success', 'Profil kampus berhasil dihapus.');
    }
}