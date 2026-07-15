@extends('layouts.pakar')

@section('title', 'Dashboard Pakar')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Dashboard Pakar
    </h1>

    <p class="text-gray-600">
        Ringkasan aktivitas sistem pakar THT
    </p>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center gap-2">

            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-stethoscope text-xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Total Gejala
                </p>

                <h3 class="text-2xl font-bold text-gray-700">
                    {{ $totalGejala }}
                </h3>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center gap-2">

            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-disease text-xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Total Penyakit
                </p>

                <h3 class="text-2xl font-bold text-gray-700">
                    {{ $totalPenyakit }}
                </h3>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center gap-2">

            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-history text-xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Konsultasi Hari Ini
                </p>

                <h3 class="text-2xl font-bold text-gray-700">
                    {{ $konsultasiHariIni }}
                </h3>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center gap-2">

            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                <i class="fas fa-users text-xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Total Pasien Terdaftar
                </p>

                <h3 class="text-2xl font-bold text-gray-700">
                    {{ $totalPasien }}
                </h3>
            </div>

        </div>
    </div>

</div>

<!-- Aktivitas -->
<div class="bg-white rounded-lg shadow">

    <div class="px-6 py-5 border-b">
        <h2 class="text-xl font-bold text-gray-800">
            Aktivitas Terbaru Hari Ini
        </h2>
    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                        Pasien
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                        Penyakit
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                        Waktu
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse($aktivitas as $item)

                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-5">

                        <div class="font-semibold text-gray-800">
                            {{ $item->user->name }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $item->user->email }}
                        </div>

                    </td>

                    <td class="px-6 py-5">

                        {{ $item->penyakit->nama ?? $item->penyakit->nama_penyakit ?? '-' }}

                    </td>

                    <td class="px-6 py-5 text-gray-600">

                        {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center py-12 text-gray-500">

                        Belum ada konsultasi hari ini.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection