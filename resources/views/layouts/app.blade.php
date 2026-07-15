<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pakar THT')</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Custom CSS untuk warna kustom --}}
    <style>
        :root {
            --soft-green: #C8E6C9;
            --soft-green-dark: #A5D6A7;
            --primary: #3B82F6;
            --primary-dark: #1E40AF;
            --secondary: #10B981;
        }

        .bg-soft-green {
            background-color: var(--soft-green);
        }

        .border-soft-green-dark {
            border-color: var(--soft-green-dark);
        }

        .text-primary {
            color: var(--primary);
        }

        .bg-primary {
            background-color: var(--primary);
        }

        .hover\:bg-secondary:hover {
            background-color: var(--secondary);
        }

        .sidebar-item{
            position:relative;
            display:flex;
            align-items:center;
            gap:12px;
            padding:14px 18px;
            border-radius:12px;
            transition:.25s ease;
            color:#374151;
        }

        .sidebar-item:hover{
            background:#ffffff;
            transform:translateX(3px);
            box-shadow:0 8px 20px rgba(0,0,0,.06);
        }

        .sidebar-item.active{
            background:#ffffff;
            color:#15803D;
            font-weight:600;
            box-shadow:0 8px 18px rgba(0,0,0,.08);
        }

        .sidebar-item.active::before{
            content:'';
            position:absolute;
            left:-16px;
            top:8px;
            bottom:8px;
            width:5px;
            border-radius:20px;
            background:#16A34A;
        }

        .sidebar-item.active i{
            color:#16A34A;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
        }

        /* ================= GLOBAL LOADING ================= */

#globalLoading{
    position:fixed;
    inset:0;
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(4px);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:99999;
    opacity:0;
    visibility:hidden;
    transition:.25s;
}

#globalLoading.show{
    opacity:1;
    visibility:visible;
}

.loading-box{
    width:340px;
    background:#fff;
    border-radius:18px;
    padding:28px;
    text-align:center;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.loading-spinner{
    width:65px;
    height:65px;
    border:6px solid #E5E7EB;
    border-top:6px solid #16A34A;
    border-radius:50%;
    margin:auto;
    animation:spin .8s linear infinite;
}

@keyframes spin{
    to{
        transform:rotate(360deg);
    }
}

.loading-title{
    margin-top:18px;
    font-size:22px;
    font-weight:700;
    color:#111827;
}

.loading-text{
    margin-top:8px;
    color:#6B7280;
    line-height:1.6;
}
    </style>
    
    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="flex min-h-screen">

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed lg:static inset-y-0 left-0 w-64 bg-soft-green text-gray-800 flex flex-col shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50">

        <!-- Header Sidebar -->
        <div class="p-6 border-b border-soft-green-dark flex justify-between items-center">

            <div>
                <h1 class="text-xl font-bold">
                    Diagnosa Penyakit THT
                </h1>

                <p class="text-sm text-gray-600 mt-1">
                    Sistem Pakar
                </p>
            </div>

            <button
                id="closeSidebar"
                class="lg:hidden text-2xl">
                <i class="fas fa-times"></i>
            </button>

        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4">

            <ul class="space-y-2">

                <li>
                    <a href="{{ route('pasien.dashboard') }}"
                        data-loading="Memuat dashboard..."
                        class="sidebar-item {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home w-5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pasien.diagnosa') }}"
                        data-loading="Menyiapkan halaman diagnosa..."
                        class="sidebar-item {{ request()->routeIs('pasien.diagnosa') ? 'active' : '' }}">
                        <i class="fas fa-stethoscope w-5"></i>
                        <span>Diagnosa</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pasien.riwayat') }}"
                        data-loading="Memuat riwayat diagnosa..."
                        class="sidebar-item {{ request()->routeIs('pasien.riwayat') ? 'active' : '' }}">
                        <i class="fas fa-history w-5"></i>
                        <span>Riwayat Penyakit</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pasien.informasi') }}"
                        data-loading="Mengambil informasi penyakit..."
                        class="sidebar-item {{ request()->routeIs('pasien.informasi') ? 'active' : '' }}">
                        <i class="fas fa-info-circle w-5"></i>
                        <span>Informasi Penyakit</span>
                    </a>
                </li>

                <li class="pt-4 mt-4 border-t border-soft-green-dark">
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        onsubmit="showLoading('Sedang keluar dari sistem...')">
                        @csrf

                        <button
                            type="submit"
                            class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all text-left">

                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Logout</span>

                        </button>
                    </form>
                </li>

            </ul>

        </nav>

        <!-- Footer Sidebar -->
        <div class="p-4 text-center text-xs text-gray-600 border-t border-soft-green-dark">
            <p>© 2025 Sistem Pakar THT</p>
        </div>

    </div>

    <!-- Main Content dibawah sini -->

    <!-- Main Content -->
    <div class="flex-1 flex flex-col lg:ml-0">
        <!-- Header -->
        <header class="bg-white shadow-sm">

                <div class="flex items-center justify-between px-4 py-4">

                <div class="flex items-center gap-4">

                <button
                id="openSidebar"
                class="lg:hidden text-2xl text-gray-700">

                <i class="fas fa-bars"></i>

                </button>

                <h2
                class="text-lg sm:text-xl font-semibold text-gray-800">

                @yield('page-title','Dashboard Pasien')

                </h2>

                </div>

                <div class="flex items-center gap-3">

                <img
                src="https://ui-avatars.com/api/?name=Pasien+THT&background=3B82F6&color=fff"
                class="w-10 h-10 rounded-full">

                <div class="hidden sm:block">

                <div class="font-medium">
                Pasien THT
                </div>

                <div class="text-xs text-gray-500">
                User
                </div>

                </div>

                </div>

                </div>

                </header>

        <!-- Content Area -->
        <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <div id="overlay" class="fixed inset-0 bg-black/40 hidden lg:hidden z-40">
</div>

<!-- GLOBAL LOADING -->

<div id="globalLoading">

    <div class="loading-box">

        <div class="loading-spinner"></div>

        <div class="loading-title">
            Mohon Tunggu...
        </div>

        <div
            id="loadingMessage"
            class="loading-text">

            Sistem sedang memproses data.

        </div>

    </div>

</div>

    <script>
const sidebar=document.getElementById('sidebar');
const overlay=document.getElementById('overlay');

document.getElementById('openSidebar').onclick=()=>{

sidebar.classList.remove('-translate-x-full');

overlay.classList.remove('hidden');

};

document.getElementById('closeSidebar').onclick=()=>{

sidebar.classList.add('-translate-x-full');

overlay.classList.add('hidden');

};

overlay.onclick=()=>{

sidebar.classList.add('-translate-x-full');

overlay.classList.add('hidden');

};

function showLoading(message = "Sistem sedang memproses data."){

    document
        .getElementById("loadingMessage")
        .innerHTML = message;

    document
        .getElementById("globalLoading")
        .classList.add("show");

}

function hideLoading(){

    document
        .getElementById("globalLoading")
        .classList.remove("show");

}

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('a[data-loading]').forEach(function(link){

        link.addEventListener('click', function(){

            showLoading(this.dataset.loading);

        });

    });

});

</script>
    @yield('scripts')
    
</body>

</html>