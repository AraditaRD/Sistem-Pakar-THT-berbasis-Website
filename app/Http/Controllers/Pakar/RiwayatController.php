<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
{
    $query = Konsultasi::with([
        'user',
        'penyakit',
        'detail.gejala'
    ]);

    if ($request->filled('search')) {

        $keyword = $request->search;

        $query->where(function ($q) use ($keyword) {

            $q->whereHas('user', function ($u) use ($keyword) {

                $u->where('name', 'like', "%{$keyword}%");

            })

            ->orWhereHas('penyakit', function ($p) use ($keyword) {

                $p->where('nama', 'like', "%{$keyword}%");

            });

        });

    }

    $riwayat = $query
        ->latest('tanggal')
        ->paginate(5)
        ->withQueryString();

    return view(
        'pakar.riwayat',
        compact('riwayat')
    );
}
}