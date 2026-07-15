<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\Rules;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index()
    {
        $aturan = Rules::with(['penyakit', 'gejala'])
            ->get()
            ->groupBy('kode')
            ->map(function ($items) {

                return [

                    'id' => $items->first()->id,

                    'kode' => $items->first()->kode,

                    'penyakit_id' => $items->first()->penyakit_id,

                    'penyakit' => $items->first()->penyakit->nama,

                    'gejala' => $items->map(function ($item) {

                        return [

                            'id' => $item->gejala_id,

                            'kode' => $item->gejala->kode,

                            'nama' => $item->gejala->nama,

                            'cf_pakar' => $item->cf_pakar

    ];

            })->values()->toArray(),

                ];
            })
            ->values();

        $penyakit = Penyakit::orderBy('nama')->get();

        $gejala = Gejala::orderBy('kode')->get();

        return view(
            'pakar.aturan',
            compact(
                'aturan',
                'penyakit',
                'gejala'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'penyakit_id' => 'required|exists:penyakit,id',

           'gejala' => 'required|array|min:1',

            'gejala.*.gejala_id' => 'required|exists:gejala,id',

            'gejala.*.cf_pakar' => 'required|numeric|min:0|max:1',
        ]);

        // kode rule
        if (Rules::where('kode', $request->kode)->exists()) {

            return response()->json([
                'success' => false,
                'message' => 'Kode aturan sudah digunakan.'
            ]);

        }

        // penyakit
        if (Rules::where('penyakit_id', $request->penyakit_id)->exists()) {

            return response()->json([
                'success' => false,
                'message' => 'Penyakit ini sudah memiliki aturan.'
            ]);

        }

foreach ($request->gejala as $item) {

    Rules::create([

        'kode' => $request->kode,

        'penyakit_id' => $request->penyakit_id,

        'gejala_id' => $item['gejala_id'],

        'cf_pakar' => $item['cf_pakar']

    ]);

}

        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'penyakit_id' => 'required|exists:penyakit,id',

            'gejala' => 'required|array|min:1',

            'gejala.*.gejala_id' => 'required|exists:gejala,id',

            'gejala.*.cf_pakar' => 'required|numeric|min:0|max:1',
        ]);

        $rule = Rules::findOrFail($id);

        $kodeLama = $rule->kode;

        // cek kode
        $cekKode = Rules::where('kode', $request->kode)
            ->where('kode', '!=', $kodeLama)
            ->exists();

        if ($cekKode) {

            return response()->json([
                'success' => false,
                'message' => 'Kode aturan sudah digunakan.'
            ]);

        }

        // cek penyakit
        $cekPenyakit = Rules::where('penyakit_id', $request->penyakit_id)
            ->where('kode', '!=', $kodeLama)
            ->exists();

        if ($cekPenyakit) {

            return response()->json([
                'success' => false,
                'message' => 'Penyakit ini sudah memiliki aturan.'
            ]);

        }

        // hapus rule lama
        Rules::where('kode', $kodeLama)->delete();

        // simpan rule
      foreach ($request->gejala as $item) {

    Rules::create([

        'kode' => $request->kode,

        'penyakit_id' => $request->penyakit_id,

        'gejala_id' => $item['gejala_id'],

        'cf_pakar' => $item['cf_pakar']

    ]);

}

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $rule = Rules::findOrFail($id);

        Rules::where('kode', $rule->kode)->delete();

        return response()->json([
            'success' => true
        ]);
    }
}