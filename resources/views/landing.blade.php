<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit THT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'soft-green': '#C8E6C9',
                        'soft-green-dark': '#A5D6A7',
                        'primary': '#3B82F6',
                        'secondary': '#1E40AF',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .stethoscope-animation { animation: float 6s ease-in-out infinite; }
        .btn-primary {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover { transform: translateY(-2px); }
        .feature-card { transition: all 0.3s ease; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }

        @keyframes floating {

    0%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-18px);
    }

    100%{
        transform:translateY(0);
    }

}

.animate-float{
    animation:floating 5s ease-in-out infinite;
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
}

.loading-text{
    margin-top:8px;
    color:#6B7280;
}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">

            @if(session('success'))
            <div id="success-alert"
                class="fixed top-20 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
            @endif

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm py-4 sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-stethoscope text-primary text-2xl mr-2"></i>
                <span class="text-xl font-bold text-gray-800">Sistem Pakar THT</span>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#home"      class="text-gray-600 hover:text-primary transition-colors">Home</a>
                <a href="#layanan"   class="text-gray-600 hover:text-primary transition-colors">Layanan</a>
                <a href="#informasi" class="text-gray-600 hover:text-primary transition-colors">Informasi</a>
                <a href="#blog"      class="text-gray-600 hover:text-primary transition-colors">Blog</a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section id="home" class="py-16 md:py-24" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%)">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Sistem Pakar THT</h1>
                <p class="text-xl text-gray-700 mb-2">Hello, selamat datang</p>
                <h2 class="text-2xl md:text-3xl font-semibold text-primary mb-6">Temukan diagnosa penyakit THT yang tepat</h2>
                <p class="text-gray-600 mb-8 max-w-lg">Dapatkan diagnosa awal untuk penyakit THT dengan sistem pakar kami. Bekerja sama dengan dokter THT berpengalaman untuk hasil yang akurat.</p>
                <div class="flex gap-4">

                    <button
                        onclick="showLoginModal()"
                        class="btn-primary text-white px-8 py-4 rounded-xl text-lg">

                        <i class="fas fa-stethoscope mr-2"></i>

                        Mulai Diagnosa

                    </button>

                </div>
            </div>
<div class="md:w-1/2 flex justify-center relative">

    <!-- Background -->
    <div class="absolute w-80 h-80 rounded-full bg-green-100 opacity-70 animate-pulse"></div>

    <!-- Dokter -->
    <div class="relative animate-float">

        <img
            src="{{ asset('images/doctor-tht.png') }}"
            alt="Dokter THT"
            class="w-[340px] relative z-20">

        <!-- TELINGA -->
        <div class="absolute top-8 -left-8 bg-white rounded-full shadow-xl p-4 animate-bounce"
             style="animation-duration:4s;">

            <img
                src="{{ asset('images/ear.png') }}"
                class="w-12 h-12">

            <p class="text-center mt-2 text-sm font-semibold text-blue-600">
                Telinga
            </p>

        </div>

        <!-- HIDUNG -->
        <div class="absolute top-10 -right-10 bg-white rounded-full shadow-xl p-4 animate-bounce"
             style="animation-duration:5s;">

            <img
                src="{{ asset('images/nose.png') }}"
                class="w-12 h-12">

            <p class="text-center mt-2 text-sm font-semibold text-blue-600">
                Hidung
            </p>

        </div>

        <!-- TENGGOROKAN -->
        <div class="absolute -bottom-12 right-2 -translate-x-2 bg-white rounded-full shadow-xl p-3 animate-bounce"
             style="animation-duration:6s;">

            <img
                src="{{ asset('images/throat.png') }}"
                class="w-20 h-20">

            <p class="text-center mt-3 text-sm font-semibold text-blue-600">
                Tenggorokan
            </p>

        </div>

    </div>

</div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section id="informasi" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Mengapa Memilih Sistem Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-brain text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Sistem Pakar Canggih</h3>
                    <p class="text-gray-600">Menggunakan metode backward chaining untuk diagnosa yang lebih akurat.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-user-md text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Dikembangkan Ahli</h3>
                    <p class="text-gray-600">Sistem dikembangkan bersama dokter THT berpengalaman.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-history text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Riwayat Konsultasi</h3>
                    <p class="text-gray-600">Pasien bisa melihat riwayat konsultasi sebelumnya.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section id="layanan" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Cara Kerja Sistem</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach([['1','Buka Sistem','Akses sistem pakar THT'],['2','Jawab Pertanyaan','Jawab gejala yang dialami'],['3','Dapatkan Diagnosa','Sistem menganalisis gejala'],['4','Lihat Penanganan','Dapatkan saran tindakan']] as $step)
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">{{ $step[0] }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $step[1] }}</h3>
                    <p class="text-gray-600">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LOGIN MODAL PAKAR --}}
    <div id="auth-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                <button onclick="hideLoginModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            {{-- Error message --}}
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form
                id="loginForm"
                method="POST"
                action="{{ route('login.post') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" placeholder="Masukkan email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                               required>
                    </div>
                    <button id="btnLogin" type="submit" class="w-full btn-primary text-white py-3 px-4 rounded-lg font-medium">
                        Login
                    </button>
                    <div class="mt-6 text-center">

                    <p class="text-gray-500">

                        Belum memiliki akun?

                        <button
                            type="button"
                            onclick="switchToRegister()"
                            class="text-blue-600 font-semibold hover:underline">

                            Daftar di sini

                        </button>

                    </p>

                </div>
                </div>
            </form>
        </div>
    </div>

    <!-- REGISTER MODAL -->
<div id="register-overlay"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full mx-4">

        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">
                Registrasi Pasien
            </h2>

            <button onclick="hideRegisterModal()">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Body Scroll -->
        <div class="p-6 overflow-y-auto" style="max-height:70vh;">

            <form
                id="registerForm"
                method="POST"
                action="{{ route('register.post') }}">
                @csrf

                <div class="space-y-4">

                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="name"
                               class="w-full px-4 py-3 border rounded-lg">
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="email" name="email"
                               class="w-full px-4 py-3 border rounded-lg">
                    </div>

                    <div class="mb-4">

    <label class="block text-sm font-medium mb-1">
        Nomor Telepon
    </label>

    <input
        id="no_hp"
        type="text"
        name="no_hp"
        inputmode="numeric"
        maxlength="15"
        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
        class="w-full px-4 py-2 border rounded-lg">

    <p
        id="hpMessage"
        class="text-sm mt-1">
    </p>

</div>

                    <div>
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                               class="w-full px-4 py-3 border rounded-lg">
                    </div>

                    <div class="mb-4">

    <label class="block text-sm font-medium mb-1">
        Password
    </label>

    <input
        id="password"
        type="password"
        name="password"
        minlength="8"
        class="w-full px-4 py-2 border rounded-lg">

    <p
        id="passwordMessage"
        class="text-sm mt-1">
    </p>

</div>

                    <div class="mb-4">

    <label class="block text-sm font-medium mb-1">
        Konfirmasi Password
    </label>

    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        class="w-full px-4 py-2 border rounded-lg">

    <p
        id="confirmMessage"
        class="text-sm mt-1">
    </p>

</div>

                    <button id="btnRegister" type="submit"
                            class="w-full btn-primary text-white py-3 rounded-lg">
                        Daftar
                    </button>
                    <div class="mt-6 text-center">

                    <p class="text-gray-500">

                        Sudah memiliki akun?

                        <button
                            type="button"
                            onclick="switchToLogin()"
                            class="text-blue-600 font-semibold hover:underline">

                            Login di sini

                        </button>

                    </p>

                </div>

                </div>
            </form>

        </div>
    </div>
</div>

    {{-- BLOG --}}
    <section id="blog" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Blog & Informasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 feature-card">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-soft-green rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-dna text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Apa Itu Sistem Pakar?</h3>
                        <p class="text-gray-600 mb-4">Sistem pakar adalah program komputer yang meniru kemampuan seorang ahli dalam menyelesaikan masalah tertentu.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 feature-card">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-soft-green rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-ear text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Penyakit THT yang Umum</h3>
                        <p class="text-gray-600 mb-4">Kenali berbagai penyakit THT seperti sinusitis, tonsilitis, otitis, dan rinitis alergi yang sering dialami.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 feature-card">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-soft-green rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-shield-alt text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Pencegahan Penyakit THT</h3>
                        <p class="text-gray-600 mb-4">Tips dan cara mencegah penyakit THT dengan menjaga kebersihan dan pola hidup sehat.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 feature-card">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-soft-green rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-code text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Teknologi Backward Chaining</h3>
                        <p class="text-gray-600 mb-4">Metode backward chaining dalam sistem pakar untuk diagnosa penyakit berdasarkan gejala.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 feature-card">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-soft-green rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-stethoscope text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Kapan Harus Ke Dokter?</h3>
                        <p class="text-gray-600 mb-4">Tanda-tanda gejala THT yang memerlukan penanganan langsung dari dokter spesialis.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 feature-card">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-soft-green rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-heartbeat text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Perawatan THT di Rumah</h3>
                        <p class="text-gray-600 mb-4">Cara merawat dan meredakan gejala THT ringan dengan perawatan sederhana di rumah.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-stethoscope text-primary text-2xl mr-2"></i>
                        <span class="text-xl font-bold">Sistem Pakar THT</span>
                    </div>
                    <p class="text-gray-400">Sistem pakar diagnosa penyakit THT yang akurat dan terpercaya.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="#home"      class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#layanan"   class="text-gray-400 hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#informasi" class="text-gray-400 hover:text-white transition-colors">Informasi</a></li>
                        <li><a href="#blog"      class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i><span>info@sistempakartht.com</span></li>
                        <li class="flex items-center"><i class="fas fa-phone mr-2"></i><span>+62 21 1234 5678</span></li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i><span>Jakarta, Indonesia</span></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Sistem Pakar THT. All rights reserved.</p>
            </div>
        </div>
    </footer>

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

        function showLoading(message="Sistem sedang memproses data."){

    document
        .getElementById("loadingMessage")
        .innerText = message;

    document
        .getElementById("globalLoading")
        .classList.add("show");

}

function hideLoading(){

    document
        .getElementById("globalLoading")
        .classList.remove("show");

}

        function showLoginModal() {
            document.getElementById('auth-overlay').classList.remove('hidden');
        }
        function hideLoginModal() {
            document.getElementById('auth-overlay').classList.add('hidden');
        }

        //register
                function showRegisterModal() {
            document.getElementById('register-overlay')
                .classList.remove('hidden');
        }

        function hideRegisterModal() {
            document.getElementById('register-overlay')
                .classList.add('hidden');
        }

        document.getElementById('register-overlay')
            .addEventListener('click', function(e) {
                if (e.target === this) {
                    hideRegisterModal();
                }
            });

        // Tutup modal kalau klik di luar
        document.getElementById('auth-overlay').addEventListener('click', function(e) {
            if (e.target === this) hideLoginModal();
        });

        //rapi otomatis setelah 3 detik
        const alertBox = document.getElementById('success-alert');

            if(alertBox){
                setTimeout(() => {
                    alertBox.remove();
                }, 3000);
            }

        // Auto buka modal kalau ada error login
        @if($errors->any())
            showLoginModal();
        @endif

        document.getElementById('loginForm').addEventListener('submit', function(e){

    e.preventDefault();

    const form = this;

    document.getElementById('btnLogin').disabled = true;

    showLoading('Sedang masuk ke sistem...');

    setTimeout(function(){

        form.submit();

    },200);

});

document.getElementById('registerForm').addEventListener('submit',function(e){

    const form = this;

    document.getElementById('btnRegister').disabled=true;

    showLoading('Sedang membuat akun...');

    setTimeout(function(){

    form.submit();

},200);

});

const hp = document.getElementById("no_hp");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("password_confirmation");
const btnRegister = document.getElementById("btnRegister");

const hpMessage = document.getElementById("hpMessage");
const passwordMessage = document.getElementById("passwordMessage");
const confirmMessage = document.getElementById("confirmMessage");

function validateForm(){

    let valid = true;

    // =====================
    // Nomor HP
    // =====================

    if(hp.value.length < 10){

        hpMessage.innerHTML =
        "❌ Nomor telepon minimal 10 digit";

        hpMessage.className =
        "text-red-500 text-sm mt-1";

        valid = false;

    }else{

        hpMessage.innerHTML =
        "✅ Nomor telepon valid";

        hpMessage.className =
        "text-green-600 text-sm mt-1";

    }

    // =====================
    // Password
    // =====================

    if(password.value.length < 8){

        passwordMessage.innerHTML =
        "❌ Password minimal 8 karakter";

        passwordMessage.className =
        "text-red-500 text-sm mt-1";

        valid = false;

    }else{

        passwordMessage.innerHTML =
        "✅ Password memenuhi syarat";

        passwordMessage.className =
        "text-green-600 text-sm mt-1";

    }

    // =====================
    // Konfirmasi Password
    // =====================

    if(confirmPassword.value !== password.value){

        confirmMessage.innerHTML =
        "❌ Konfirmasi password tidak sama";

        confirmMessage.className =
        "text-red-500 text-sm mt-1";

        valid = false;

    }else if(confirmPassword.value !== ""){

        confirmMessage.innerHTML =
        "✅ Password cocok";

        confirmMessage.className =
        "text-green-600 text-sm mt-1";

    }else{

        confirmMessage.innerHTML = "";

    }

    btnRegister.disabled = !valid;

}

hp.addEventListener("input", validateForm);
password.addEventListener("input", validateForm);
confirmPassword.addEventListener("input", validateForm);

validateForm();

function switchToRegister(){

    hideLoginModal();

    showRegisterModal();

}

function switchToLogin(){

    hideRegisterModal();

    showLoginModal();

}
    </script>
</body>
</html>