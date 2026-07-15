<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::orderBy('kode')->get();

        return view('pakar.penyakit', compact('penyakit'));
    }

    public function store(Request $request)
    {
        $penyakit = Penyakit::create([
            'kode'       => $request->kode,
            'nama'       => $request->nama,
            'deskripsi'  => $request->deskripsi,
            'penyebab'   => $request->penyebab,
            'pencegahan' => $request->pencegahan,
            'solusi'     => $request->solusi,
        ]);

        return response()->json([
            'success' => true,
            'data' => $penyakit
        ]);
    }

    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::findOrFail($id);

        $penyakit->update([
            'kode'       => $request->kode,
            'nama'       => $request->nama,
            'deskripsi'  => $request->deskripsi,
            'penyebab'   => $request->penyebab,
            'pencegahan' => $request->pencegahan,
            'solusi'     => $request->solusi,
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        Penyakit::findOrFail($id)->delete();

        return response()->json([
            'success' => true
        ]);
    }
}