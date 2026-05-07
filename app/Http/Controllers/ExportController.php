<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        // Secara default, ambil semua data pengajuan dari yang terbaru
        $query = PengajuanMagang::latest();

        // Jika Admin mengisi filter tanggal (Dari - Sampai)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $pengajuans = $query->get();

        return view('admin.export.index', compact('pengajuans'));
    }
}