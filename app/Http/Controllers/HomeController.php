<?php

namespace App\Http\Controllers;


use App\Models\Kecamatan;
use App\Models\Menara;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        return view('landingpage.home');
    }
    public function peta()
    {
        $kecamatan = Kecamatan::select('kode', 'nama', 'geojson', 'warna')->get();
        return view('landingpage.peta', compact('kecamatan'));
    }
    public function statistik()
{
    $kecamatan = Kecamatan::orderBy('nama')->get();

    // Hitung jumlah menara per kecamatan
    $jumlahMenara = Menara::selectRaw('kecamatan_id, COUNT(*) as total')
        ->groupBy('kecamatan_id')
        ->pluck('total', 'kecamatan_id')
        ->toArray();

    return view('landingpage.statistik', compact('kecamatan', 'jumlahMenara'));
}
}
