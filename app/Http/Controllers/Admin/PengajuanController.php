<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\LampiranPengajuan;
use App\Models\Menara;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index()
    {
        // HANYA yang sudah disetujui atau ditolak
        $pengajuans = Pengajuan::with('lampiran', 'menara', 'user')
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->latest()
            ->get();

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    public function belumDisetujui()
    {
        // Draft dan diproses
        $pengajuans = Pengajuan::with('lampiran', 'menara', 'user')
            ->whereIn('status', ['draft', 'diproses'])
            ->latest()
            ->get();

        return view('admin.pengajuan.belum', compact('pengajuans'));
    }


    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load('lampiran', 'user', 'menara');
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();
        $requiredDocs = config('berkas_menara')[$pengajuan->jenis_pengajuan] ?? [];

        return view('admin.pengajuan.show', compact('pengajuan', 'kecamatans', 'desas', 'requiredDocs'));
    }


    public function verifikasi(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'status' => 'required|in:diproses,disetujui,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pengajuan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Jika disetujui dan pengajuan baru, simpan ke tabel menara
        if ($pengajuan->status === 'disetujui' && $pengajuan->jenis_pengajuan === 'baru' && $pengajuan->menara_id === null) {
            $data = $pengajuan->menara_baru_data;
            $menara = Menara::create([
                'site_code' => $data['site_code'],
                'site_name' => $data['site_name'],
                'desa_id' => $data['desa_id'],
                'kecamatan_id' => $data['kecamatan_id'],
                'user_id' => $pengajuan->user_id,
                'alamat' => $data['alamat'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'tinggi_menara' => $data['tinggi_menara'],
                'imb' => $data['imb'] ?? '-',
                'rekom' => $data['rekom'] ?? '-',
                'tahun_rekom' => $data['tahun_rekom'] ?? now()->year,
                'status' => 'aktif',
            ]);

            $pengajuan->update(['menara_id' => $menara->id]);
        }

        return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan berhasil diverifikasi.');
    }

    public function updateCatatanLampiran(Request $request, LampiranPengajuan $lampiran)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        $lampiran->update([
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Catatan dokumen diperbarui.');
    }

}
