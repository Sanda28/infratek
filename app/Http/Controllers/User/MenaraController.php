<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Menara;
use App\Models\Kecamatan;

class MenaraController extends Controller
{
    public function index()
    {
        $menaras = Menara::with(['desa', 'kecamatan'])
            ->where('user_id', Auth::id())
            ->get();

        return view('user.menara.index', compact('menaras'));
    }

    public function show(Menara $menara)
    {
        if ($menara->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.menara.show', compact('menara'));
    }
    public function peta()
    {
        $kecamatans = Kecamatan::all();
        $menaras = Menara::where('user_id', auth()->id())->get();
        return view('user.menara.peta', compact('menaras', 'kecamatans'));
    }


}
