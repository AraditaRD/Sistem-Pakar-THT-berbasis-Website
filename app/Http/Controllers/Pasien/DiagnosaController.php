<?php

namespace App\Http\Controllers\Pasien;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Konsultasi;
use App\Models\DetailKonsultasi;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rules;

class DiagnosaController extends Controller
{
    public function index(): View
    {
        // Ambil semua data gejala
        $gejala = Gejala::all();
        $symptomQuestions = [];
        $gejalaMapping = [];
        
        foreach ($gejala as $g) {

        $symptomQuestions[$g->kode] =
            "Apakah Anda mengalami " . strtolower($g->nama) . "?";

        $gejalaMapping[$g->kode] = [
            'id'   => $g->id,
            'nama' => $g->nama
        ];

    }

        // Ambil semua data penyakit beserta relasi gejala
        $rules = Rules::with(['penyakit', 'gejala']) ->get() ->groupBy('kode');
        $diseases = [];
        
        foreach ($rules as $kode => $items) {

    $firstRule = $items->first();

    if (!$firstRule || !$firstRule->penyakit) {
        continue;
    }

$penyakit = $firstRule->penyakit;

    $diseases[$penyakit->kode] = [

        'id' => $penyakit->id,

        'kode_rule' => $kode,

        'name' => $penyakit->nama,

        'description' => $penyakit->deskripsi,

        'causes' => explode("\n", $penyakit->penyebab ?? ''),

        'prevention' => explode("\n", $penyakit->pencegahan ?? ''),

        'treatment' => explode("\n", $penyakit->solusi ?? ''),

       'symptoms' => $items->map(function ($rule) {

        return [

        'id' => $rule->gejala->id,

        'kode' => $rule->gejala->kode,

        'nama' => $rule->gejala->nama,

        'cf_pakar' => $rule->cf_pakar

    ];

})->values()->toArray(),

    ];

}

        return view(
            'pasien.diagnosa',
            compact(
                'diseases',
                'symptomQuestions',
                'gejalaMapping'
            )
        );
    }

    public function store(Request $request)
{
    try {

        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id',
            'persentase' => 'required|numeric|min:0|max:100',
            'gejala' => 'required|array',
            'gejala.*.gejala_id' => 'required|exists:gejala,id',
            'gejala.*.cf_user' => 'required|numeric|min:0|max:1',
            'kemungkinan_lain' => 'nullable|array'
        ]);

        $konsultasi = Konsultasi::create([
            'user_id' => Auth::id(),
            'tanggal' => now(),
            'status' => 'selesai',
            'penyakit_id' => $request->penyakit_id,
            'persentase' => $request->persentase,
            'kemungkinan_lain' => json_encode($request->kemungkinan_lain)
        ]);
        
        foreach ($request->gejala as $item) {

    DetailKonsultasi::create([

        'konsultasi_id' => $konsultasi->id,

        'gejala_id' => $item['gejala_id'],

        'cf_user' => $item['cf_user']

    ]);

}

        return response()->json([
        'success' => true,
        'message' => 'Diagnosa berhasil disimpan',
        'id' => $konsultasi->id
    ]);

    } catch (\Throwable $e) {

        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ],500);

    }
}

public function hasil()
{
    $hasil = Konsultasi::with([
        'penyakit',
        'detail.gejala'
    ])
    ->where('user_id', Auth::id())
    ->latest()
    ->first();

    $kemungkinanLain = [];
    $gejalaUtama = [];

    if ($hasil) {

    $gejalaDipilih = $hasil->detail
        ->where('cf_user', '>=', 0.6)
        ->pluck('gejala.kode')
        ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Gejala Diagnosis Utama
        |--------------------------------------------------------------------------
        */

        $rulesUtama = Rules::with('gejala')
            ->where('penyakit_id', $hasil->penyakit_id)
            ->get();

        foreach ($rulesUtama as $rule) {

            if (
                in_array(
                    $rule->gejala->kode,
                    $gejalaDipilih
                )
            ) {

                $gejalaUtama[] =
                    $rule->gejala->nama;
            }
        }

$kemungkinanLain = [];

    }
    
    return view(
        'pasien.hasil',
        compact(
            'hasil',
            'kemungkinanLain',
            'gejalaUtama'
        )
    );
}

public function riwayat()
{
    $riwayat = Konsultasi::with([
        'penyakit',
        'detail.gejala'
    ])
    ->where('user_id', Auth::id())
    ->latest()
    ->paginate(5);

    return view('pasien.riwayat', compact('riwayat'));
}

public function informasi()
{
    $penyakit = Penyakit::with([
        'rules.gejala'
    ])->get();

    return view(
        'pasien.informasi',
        compact('penyakit')
    );
}

public function detail($id)
{
    $konsultasi = Konsultasi::with([
        'penyakit',
        'detail.gejala'
    ])
    ->where('user_id', Auth::id())
    ->findOrFail($id);

    return response()->json([

        'penyakit'    => $konsultasi->penyakit,

        'persentase'  => $konsultasi->persentase,

        'tanggal'     => $konsultasi->tanggal,

        'detail'      => $konsultasi->detail

    ]);
}

}