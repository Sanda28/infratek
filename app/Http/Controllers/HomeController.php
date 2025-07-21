<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Menara;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        return view('landingpage.home', [
            'steps' => [
                'Pengajuan' => 'Perusahaan atau Sub Kontraktor mengajukan permohonan rekomendasi Menara dengan mengirimkan rincian data dan berkas melalui aplikasi Siszora.',
                'Survei' => 'Pihak Dinas Kominfo akan melakukan pengecekan terhadap pengajuan dan survei ke lokasi yang sudah ditentukan.',
                'Penerbitan Rekomendasi' => 'Surat Rekomendasi akan diterbitkan apabila pengajuan memenuhi kriteria.',
                'Pembangunan & PBG' => 'Setelah PBG (Persetujuan Bangunan Gedung) terbit, Administrator akan mengubah status menara di Aplikasi Siszora.',
            ]
        ]);
    }

    public function peta()
    {
        $kecamatan = Kecamatan::select('kode', 'nama', 'geojson', 'warna')->get();
        return view('landingpage.peta', compact('kecamatan'));
    }

    public function statistik()
    {
        $kecamatan = Kecamatan::orderBy('nama')->get();
        $jumlahMenara = Menara::selectRaw('kecamatan_id, COUNT(*) as total')
            ->groupBy('kecamatan_id')
            ->pluck('total', 'kecamatan_id')
            ->toArray();

        return view('landingpage.statistik', compact('kecamatan', 'jumlahMenara'));
    }
}
