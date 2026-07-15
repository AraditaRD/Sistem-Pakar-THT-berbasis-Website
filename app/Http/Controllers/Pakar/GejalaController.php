<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $gejala = Gejala::orderBy('kode')->get();

        return view('pakar.gejala', compact('gejala'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:gejala,kode',
            'nama' => 'required',
            'kategori' => 'required'
        ]);

        Gejala::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gejala berhasil disimpan'
        ]);
    }

    public function destroy($id)
{
    $gejala = Gejala::findOrFail($id);

    $gejala->delete();

    return response()->json([
        'success' => true
    ]);
}

public function update(Request $request, $id)
{
    $gejala = Gejala::findOrFail($id);

    $gejala->update([
        'kode' => $request->kode,
        'nama' => $request->nama,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi
    ]);

    return response()->json([
        'success' => true
    ]);
}

}