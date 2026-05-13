<?php

namespace App\Http\Controllers;

use App\Models\PengajuanMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $riwayat = PengajuanMagang::with('pengajuanSurats')
            ->where(function ($query) use ($user) {
                $query->where('email', $user->email);

                if (!empty($user->nim)) {
                    $query->orWhere('nim', $user->nim);
                }
            })
            ->latest()
            ->get();

        return view('riwayat', compact('riwayat'));
    }

    public function adminIndex(Request $request)
    {
        $users = User::where('role', 'mahasiswa')->get();
        $query = PengajuanMagang::with('pengajuanSurats')->latest();
        if ($request->filled('user_id')) {
            $selectedUser = User::find($request->user_id);
            if ($selectedUser) {
                $query->where(function ($q) use ($selectedUser) {
                    $q->where('email', $selectedUser->email);
                    if (!empty($selectedUser->nim)) {
                        $q->orWhere('nim', $selectedUser->nim);
                    }
                });
            }
        }

        $riwayat = $query->get();

        return view('admin.riwayat.index', compact('riwayat', 'users'));
    }

    public function updateStatusMagang(Request $request, $id)
    {
        $pengajuan = PengajuanMagang::findOrFail($id);
        $pengajuan->update([
            'status_magang' => $request->status_magang,
        ]);

        return redirect()->back()->with('success', 'Status magang berhasil diperbarui!');
    }
}