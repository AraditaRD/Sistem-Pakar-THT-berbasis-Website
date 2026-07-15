@extends('layouts.app')

@section('title', 'Login Pasien')
@section('page-title', 'Login Pasien')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-md text-white text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Pasien</h2>
            <p class="text-gray-600">Masuk untuk konsultasi dengan sistem pakar THT</p>
        </div>

        {{-- Tampilkan pesan sukses --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tampilkan pesan error --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            id="loginForm"
            method="POST"
            action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}"
                    placeholder="Masukkan username" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('username') border-red-500 @enderror"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('password') border-red-500 @enderror"
                    required>
            </div>

            <button
                id="btnLogin"
                type="submit"
                class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 px-4 rounded-lg font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>

            <div class="text-center text-sm text-gray-600 mt-4">
                    <p>Belum punya akun?</p>
                </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', function(e){

    e.preventDefault();

    document.getElementById('btnLogin').disabled = true;

    showLoading("Sedang masuk ke sistem...");

    // beri kesempatan browser me-render loading
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            this.submit();
        });
    });

});
</script>
@endsection