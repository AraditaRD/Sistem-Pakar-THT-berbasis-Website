@extends('layouts.app')

@section('title', 'Register Pasien')
@section('page-title', 'Register Pasien')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h2>
            <p class="text-gray-600">Buat akun untuk mulai konsultasi</p>
        </div>

        {{-- Tampilkan pesan error --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama lengkap" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                       required>
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="{{ old('username') }}"
                       placeholder="Masukkan username" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                       required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="Masukkan email" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                       required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       placeholder="Minimal 6 karakter" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                       required>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="Masukkan ulang password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                       required>
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 px-4 rounded-lg font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                <i class="fas fa-user-plus mr-2"></i> Daftar
            </button>

            <div class="text-center text-sm text-gray-600 mt-4">
                <p>Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary hover:underline font-medium">
                        Login di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection