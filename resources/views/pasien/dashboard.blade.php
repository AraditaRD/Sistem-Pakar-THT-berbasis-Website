@extends('layouts.app')

@section('title', 'Dashboard Pasien')
@section('page-title', 'Dashboard Pasien')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-6">
        <div class="text-center mb-8">
            <div
                class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-2">
                <i class="fas fa-user-md text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h1>
            <p class="text-xl text-gray-600 mb-4">Kami senang Anda memilih untuk konsultasi online dengan sistem pakar
                kami</p>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Sistem pakar THT kami siap membantu Anda mendapatkan diagnosa awal yang akurat
                untuk keluhan THT yang Anda alami. Mari mulai perjalanan kesehatan Anda bersama kami.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="dashboard-card bg-soft-green p-6 rounded-lg border border-soft-green-dark">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-stethoscope text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Diagnosa Cepat</h3>
                        <p class="text-gray-600 text-sm">Dapatkan diagnosa dalam hitungan menit</p>
                    </div>
                </div>
                <a href="{{ route('pasien.diagnosa') }}"
                    class="block w-full btn-primary text-white py-3 px-4 rounded-lg font-medium mt-4 text-center">
                        Mulai Diagnosa Sekarang
                    </a>
            </div>

            <div class="dashboard-card bg-soft-green p-6 rounded-lg border border-soft-green-dark">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Terpercaya & Aman</h3>
                        <p class="text-gray-600 text-sm">Data Anda terlindungi dengan baik</p>
                    </div>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 mt-4">
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i>Dikembangkan
                        bersama dokter THT</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i>Privasi data
                        terjamin</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i>Hasil diagnosa
                        akurat</li>
                </ul>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Bagaimana Cara Kerjanya?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-3"><span
                            class="text-white font-bold">1</span></div>
                    <h4 class="font-medium text-gray-800 mb-2">Jawab Pertanyaan</h4>
                    <p class="text-sm text-gray-600">Jawab pertanyaan tentang gejala yang Anda alami</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-3"><span
                            class="text-white font-bold">2</span></div>
                    <h4 class="font-medium text-gray-800 mb-2">Analisis Sistem</h4>
                    <p class="text-sm text-gray-600">Sistem menganalisis jawaban Anda</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-3"><span
                            class="text-white font-bold">3</span></div>
                    <h4 class="font-medium text-gray-800 mb-2">Hasil & Rekomendasi</h4>
                    <p class="text-sm text-gray-600">Dapatkan diagnosa dan saran penanganan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection