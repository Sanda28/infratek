<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Menara;
use App\Models\Desa;
use Illuminate\Http\Request;

class MenaraController extends Controller
{
    public function index(Request $request)
    {
        $query = Menara::with('desa.kecamatan');

        if ($request->kecamatan_id) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }

        $menaras = $query->latest()->get();
        $kecamatans = Kecamatan::all();

        return view('admin.menara.index', compact('menaras', 'kecamatans'));
    }

    public function show(Menara $menara)
    {
        return view('admin.menara.show', compact('menara'));
    }

    public function edit(Menara $menara)
    {
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();
        return view('admin.menara.edit', compact('menara', 'kecamatans', 'desas'));
    }

    public function update(Request $request, Menara $menara)
    {
        $request->validate([
            'site_code' => 'required|string',
            'site_name' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'tinggi_menara' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'imb' => 'nullable|string',
            'rekom' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $menara->update($request->all());

        return redirect()->route('admin.menara.index')->with('success', 'Data menara berhasil diperbarui.');
    }

    public function destroy(Menara $menara)
    {
        $menara->delete();
        return redirect()->route('admin.menara.index')->with('success', 'Data berhasil dihapus.');
    }

    public function peta(Request $request)
    {
        $kecamatans = Kecamatan::all();

        // Jika tidak ada kecamatan sama sekali, kembalikan halaman dengan info kosong
        if ($kecamatans->isEmpty()) {
            return view('admin.menara.peta', [
                'menaras' => collect(),
                'kecamatans' => collect(),
                'selected' => null,
            ]);
        }

        // Ambil ID kecamatan yang dipilih, atau default ke yang pertama
        $selected = $request->kecamatan_id;
        $validKecamatanIds = $kecamatans->pluck('id')->toArray();

        // Jika tidak valid, fallback ke kecamatan pertama
        if (!in_array($selected, $validKecamatanIds)) {
            $selected = $kecamatans->first()->id;
        }

        // Ambil menara di kecamatan terpilih
        $menaras = Menara::with('user')
            ->where('kecamatan_id', $selected)
            ->get();

        return view('admin.menara.peta', compact('menaras', 'kecamatans', 'selected'));
    }

}
