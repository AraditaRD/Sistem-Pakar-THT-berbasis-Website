<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Pakar') - Sistem Pakar THT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{
    --soft-green:#C8E6C9;
    --soft-green-dark:#A5D6A7;
    --green:#16A34A;
}

        .sidebar{
            background:#C8E6C9;
            min-height:100vh;
        }

        .sidebar-item{
            position:relative;
            display:flex;
            align-items:center;
            gap:14px;
            padding:14px 18px;
            margin:4px 14px;
            border-radius:14px;
            transition:.25s;
            color:#374151;
        }

        .sidebar-item i{
            width:20px;
            text-align:center;
        }

        .sidebar-item:hover{
            background:white;
            transform:translateX(4px);
            box-shadow:0 10px 18px rgba(0,0,0,.08);
        }

        .logout-btn{

            background:#C8E6C9;

        }

        .logout-btn:hover{

            background:#ffffff;

        }

        .sidebar-item.active{
            background:white;
            color:#16A34A;
            font-weight:600;
            box-shadow:0 10px 18px rgba(0,0,0,.08);
        }

        .sidebar-item.active i{
            color:#16A34A;
        }

        .sidebar-item.active::before{
            content:'';
            position:absolute;
            left:-14px;
            top:8px;
            bottom:8px;
            width:5px;
            border-radius:20px;
            background:#16A34A;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: var(--soft-green);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--soft-green-dark);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                z-index: 100;
                height: 100vh;
                overflow-y: auto;
            }
            .sidebar.active {
                left: 0;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 99;
            }
            .overlay.active {
                display: block;
            }
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
    <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="sidebar w-64 shadow-lg flex flex-col min-h-screen">
                <div class="p-7 border-b border-green-300">
        <h1 class="text-3xl font-bold text-gray-800">
            Sistem Pakar THT
        </h1>
        <p class="text-gray-600 mt-1">
            Dashboard Pakar
        </p>
    </div>
            <nav class="flex flex-col flex-1">
                <div class="px-6 mt-2 mb-2"><p class="text-xs tracking-widest uppercase text-gray-600 font-bold">MENU UTAMA</p></div>
            <a href="{{ route('pakar.dashboard') }}" data-loading="Memuat dashboard..." class="sidebar-item {{ request()->routeIs('pakar.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-gauge-high"></i>
                    <span>Dashboard</span>
                    </a>
                <a href="{{ route('pakar.gejala') }}" data-loading="Memuat data gejala..." class="sidebar-item {{ request()->routeIs('pakar.gejala') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Data Gejala</span>
                    </a>
                <a href="{{ route('pakar.aturan') }}" data-loading="Memuat aturan..." class="sidebar-item {{ request()->routeIs('pakar.aturan') ? 'active' : '' }}">
                    <i class="fas fa-code-branch"></i>
                    <span>Aturan</span>
                    </a>
                <a href="{{ route('pakar.penyakit') }}" data-loading="Memuat data penyakit..." class="sidebar-item {{ request()->routeIs('pakar.penyakit') ? 'active' : '' }}">
                    <i class="fas fa-virus"></i>
                    <span>Data Penyakit</span>
                    </a>
                <div class="px-6 mt-7 mb-2">
                    <p class="text-xs tracking-widest uppercase text-gray-600 font-bold">MANAJEMEN</p>
                    </div>
                <a href="{{ route('pakar.riwayat') }}" data-loading="Memuat riwayat konsultasi..." class="sidebar-item {{ request()->routeIs('pakar.riwayat') ? 'active' : '' }}">
                    <i class="fas fa-clock-rotate-left"></i>
                    <span>Riwayat Konsultasi</span>
                    </a>
                <a href="{{ route('pakar.pasien') }}" data-loading="Memuat data pasien..." class="sidebar-item {{ request()->routeIs('pakar.pasien') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Akun Pasien</span>
                    </a>
                <a href="{{ route('pakar.pakar') }}" data-loading="Memuat data pakar..." class="sidebar-item {{ request()->routeIs('pakar.pakar') ? 'active' : '' }}">
                    <i class="fas fa-user-doctor"></i>
                    <span>Data Pakar</span>
                </a>
            </nav>
            <div class="border-t border-green-300 p-4 text-center text-xs text-gray-600">
                © {{ date('Y') }}
                Sistem Pakar THT
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button id="menu-toggle" class="text-gray-500 focus:outline-none lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">

                        <button id="profileBtn"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-100 transition">
                            <div class="w-10 h-10 rounded-full bg-green-200 flex items-center justify-center">
                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                            </div>

                            <div class="hidden md:block text-left">
                                <p class="font-semibold text-gray-700">
                                    {{ auth()->user()->name }}
                                </p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>

                        <!-- Dropdown -->

                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-xl border overflow-hidden z-50">
                            <form
                                id="logoutForm"
                                action="{{ route('logout') }}"
                                method="POST">
                                @csrf
                                <button
                                    id ="btnLogout"
                                    type="submit"
                                    class="flex items-center w-full px-5 py-3 hover:bg-red-50 text-red-600 transition">
                                    <i class="fas fa-right-from-bracket mr-3"></i>
                                    Logout
                                </button>
                            </form>
                        </div>

                        <div id="profileMenu"
                        class="hidden absolute right-0 mt-3 w-60 bg-white rounded-xl shadow-xl border overflow-hidden z-50">
                        <div class="px-5 py-4 border-b">
                            <p class="font-semibold">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
</div>
                    </div>
                </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="overlay"></div>

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


    @stack('scripts')
    <script>
        const profileBtn = document.getElementById("profileBtn");
            const profileMenu = document.getElementById("profileMenu");

            profileBtn.addEventListener("click",function(e){
                e.stopPropagation();
                profileMenu.classList.toggle("hidden");
            });

            document.addEventListener("click",function(){
                profileMenu.classList.add("hidden");
            });

        // Toggle sidebar untuk mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        });
        document.querySelector('.overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
            this.classList.remove('active');
        });

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

document.getElementById('logoutForm')
?.addEventListener('submit', function () {

    document.getElementById('btnLogout').disabled = true;

    showLoading('Sedang keluar dari sistem...');

});
    </script>

</body>
</html>