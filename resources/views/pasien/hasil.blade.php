@extends('layouts.app')

@section('title','Hasil Diagnosa')
@section('page-title','Hasil Diagnosa')

@section('content')

<div class="max-w-4xl mx-auto">

@if($hasil)

<div class="bg-white rounded-xl shadow-lg p-8">

    <h2 class="text-3xl font-bold text-center mb-4">
        {{ $hasil->penyakit->nama }}
    </h2>

    <div class="text-center">

    <h3 class="text-2xl font-semibold text-green-600">

        Diagnosis Utama

    </h3>

    <h4 class="font-semibold mb-3">
    Gejala yang Cocok
</h4>

<ul class="space-y-2">

@foreach($gejalaUtama as $gejala)

    <li>
        ✓ {{ $gejala }}
    </li>

@endforeach

</ul>

    <p class="mt-3 text-lg">

        {{ $hasil->penyakit->nama }}

    </p>

</div>

    <div class="mt-8">

        <h4 class="font-semibold">
            Deskripsi
        </h4>

        <p>
            {{ $hasil->penyakit->deskripsi }}
        </p>

    </div>

    <div class="mt-6">

        <h4 class="font-semibold">
            Penyebab
        </h4>

        <p>
            {{ $hasil->penyakit->penyebab }}
        </p>

    </div>

    <div class="mt-6">

        <h4 class="font-semibold">
            Pencegahan
        </h4>

        <p>
            {{ $hasil->penyakit->pencegahan }}
        </p>

    </div>

    <div class="mt-6">

        <h4 class="font-semibold">
            Solusi
        </h4>

        <p>
            {{ $hasil->penyakit->solusi }}
        </p>

    </div>

</div>

@else

<p>Belum ada hasil diagnosa.</p>

@endif

<div class="text-center mt-8">

<a href="{{ route('pasien.diagnosa') }}"
class="px-5 py-2 bg-blue-600 text-white rounded">

Diagnosa Baru

</a>

</div>

</div>

@endsection