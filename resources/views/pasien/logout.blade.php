@extends('layouts.app')

@section('title', 'Logout')
@section('page-title', 'Logout')

@section('content')
<div class="bg-white rounded-lg shadow p-8 max-w-md mx-auto text-center">
    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-sign-out-alt text-green-600 text-2xl"></i>
    </div>
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Keluar dari Sistem</h2>
    <p class="text-gray-600 mb-6">Anda yakin ingin keluar dari sistem pakar THT?</p>
    
    <div class="flex space-x-4 justify-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-green-600 px-6 py-2 rounded-md font-medium text-white shadow-sm hover:bg-green-700">
                Ya, Keluar
            </button>
        </form>
        
        <a href="{{ route('dashboard') }}" class="bg-gray-200 px-6 py-2 rounded-md font-medium text-gray-800 shadow-sm hover:bg-gray-300">
            Batal
        </a>
    </div>
</div>
@endsection