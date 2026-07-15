<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\User;
use App\Models\Konsultasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGejala = Gejala::count();

        $totalPenyakit = Penyakit::count();

        $konsultasiHariIni = Konsultasi::whereDate(
            'tanggal',
            Carbon::today()
        )->count();

$totalPasien = User::where('role', 'pasien')->count();

$pasienDiagnosa = Konsultasi::pluck('user_id')
    ->unique()
    ->count();

        $aktivitas = Konsultasi::with([
            'user',
            'penyakit'
        ])
        ->whereDate('tanggal', today())
        ->latest('tanggal')
        ->take(10)
        ->get();
        
        return view('pakar.dashboard', compact(
            'totalGejala',
            'totalPenyakit',
            'konsultasiHariIni',
            'totalPasien',
            'pasienDiagnosa',
            'aktivitas'
        ));
    }
}