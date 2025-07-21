<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menara;
use App\Models\Pengajuan;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $bulan = collect(range(1, 12))->map(fn($b) => Carbon::create()->month($b)->format('M'));
        $jumlahPengajuan = collect(range(1, 12))->map(fn($b) =>
            Pengajuan::whereMonth('created_at', $b)->whereYear('created_at', now()->year)->count()
        );

        return view('admin.dashboard', [
            'totalMenara' => Menara::count(),
            'disetujui' => Pengajuan::where('status', 'disetujui')->count(),
            'menunggu' => Pengajuan::where('status', 'menunggu')->count(),
            'totalUser' => User::where('role', 'user')->count(),
            'pengajuanTerbaru' => Pengajuan::latest()->with('user')->take(5)->get(),
            'bulan' => $bulan,
            'jumlahPengajuan' => $jumlahPengajuan
        ]);
    }
}
