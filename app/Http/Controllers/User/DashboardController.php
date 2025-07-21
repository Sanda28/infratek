<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menara;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        return view('user.dashboard', [
            'jumlahMenara' => Menara::where('user_id', $userId)->count(),
            'jumlahPengajuan' => Pengajuan::where('user_id', $userId)->count(),
            'jumlahDiterima' => Pengajuan::where('user_id', $userId)->where('status', 'disetujui')->count(),
            'pengajuanTerakhir' => Pengajuan::where('user_id', $userId)->latest()->take(5)->get()
        ]);
    }
}
