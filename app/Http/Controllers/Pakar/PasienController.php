<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{


public function index(Request $request)
{
    $query = User::where('role','pasien')
        ->withCount('konsultasi');

    if ($request->filled('search')) {

        $keyword = $request->search;

        $query->where(function ($q) use ($keyword) {

            $q->where('name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->orWhere('no_hp', 'like', "%{$keyword}%");

        });

    }

    $pasien = $query
        ->paginate(5)
        ->withQueryString();

    return view(
        'pakar.pasien',
        compact('pasien')
    );
}
}