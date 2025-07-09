<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengajuan;
use App\Models\Menara;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\LampiranPengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('lampiran', 'menara')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $menaras = Menara::where('user_id', Auth::id())->get();
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        return view('user.pengajuan.create', compact('menaras', 'kecamatans', 'desas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pengajuan' => 'required|in:baru,eksisting',
            'menara_id' => 'nullable|exists:menaras,id',
        ]);

        $menaraData = null;

        if ($request->jenis_pengajuan === 'baru') {
            $request->validate([
                'site_code' => 'required|string',
                'site_name' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'tinggi_menara' => 'required|numeric',
                'alamat' => 'required|string',
                'kecamatan_id' => 'required|exists:kecamatan,id',
                'desa_id' => 'required|exists:desa,id',
            ]);

            $menaraData = [
                'site_code' => $request->site_code,
                'site_name' => $request->site_name,
                'desa_id' => $request->desa_id,
                'kecamatan_id' => $request->kecamatan_id,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'tinggi_menara' => $request->tinggi_menara,
                'imb' => $request->imb ?? '-',
                'rekom' => $request->rekom ?? '-',
                'tahun_rekom' => now()->year,
            ];
        }

        $pengajuan = Pengajuan::create([
            'user_id' => Auth::id(),
            'jenis_pengajuan' => $request->jenis_pengajuan,
            'menara_id' => $request->jenis_pengajuan === 'eksisting' ? $request->menara_id : null,
            'menara_baru_data' => $menaraData,
            'status' => 'draft',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()
            ->route('user.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil dibuat. Silakan lengkapi dokumen.');
    }

    public function show(Pengajuan $pengajuan)
    {
        abort_if($pengajuan->user_id !== Auth::id(), 403);

        $pengajuan->load('lampiran', 'menara');
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();
        $requiredDocs = config('berkas_menara')[$pengajuan->jenis_pengajuan];

        return view('user.pengajuan.show', compact('pengajuan', 'requiredDocs', 'kecamatans', 'desas'));
    }

    public function updateMenaraBaru(Request $request, Pengajuan $pengajuan)
{
    abort_if($pengajuan->user_id !== Auth::id(), 403);

    if (!in_array($pengajuan->status, ['draft', 'diproses'])) {
        return redirect()->back()->with('error', 'Pengajuan sudah diverifikasi dan tidak dapat diedit.');
    }

    // Jika request mengandung form data menara baru
    if ($pengajuan->jenis_pengajuan === 'baru' && $request->has('site_code')) {
        $request->validate([
            'site_code' => 'required|string',
            'site_name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'tinggi_menara' => 'required|numeric',
            'alamat' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
        ]);

        $pengajuan->update([
            'menara_baru_data' => [
                'site_code' => $request->site_code,
                'site_name' => $request->site_name,
                'desa_id' => $request->desa_id,
                'kecamatan_id' => $request->kecamatan_id,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'tinggi_menara' => $request->tinggi_menara,
                'imb' => $request->imb ?? '-',
                'rekom' => $request->rekom ?? '-',
                'tahun_rekom' => now()->year,
            ],
        ]);
    }

    // Upload dokumen jika dikirim
    if ($request->hasFile('file') && $request->filled('tipe')) {
        $request->validate([
            'tipe' => 'required|string',
            'file' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $tipe = $request->tipe;
        $existing = $pengajuan->lampiran()->where('tipe', $tipe)->first();
        if ($existing) {
            Storage::disk('public')->delete($existing->path_file);
            $existing->delete();
        }

        $path = $request->file('file')->store('lampiran', 'public');

        $pengajuan->lampiran()->create([
            'nama_file' => $request->file('file')->getClientOriginalName(),
            'path_file' => $path,
            'tipe' => $tipe,
        ]);
    }

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');
}

}
