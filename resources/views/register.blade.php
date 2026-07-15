@extends('layouts.app')

@section('title', 'Register Pasien')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-md p-6">

        <h2 class="text-2xl font-bold text-center mb-6">
            Registrasi Pasien
        </h2>

        <form
                id="registerForm"
                method="POST"
                action="{{ route('register.post') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nama Lengkap</label>
                <input type="text" name="name"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
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

            <div class="mb-4">
                <label class="block mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
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
                class="w-full bg-blue-600 text-white py-3 rounded-lg">
                Daftar
            </button>

        </form>

    </div>
</div>
@endsection

@section('scripts')
    <script>
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

document.getElementById('registerForm').addEventListener('submit',function(e){

    const form = this;

    document.getElementById('btnRegister').disabled=true;

    showLoading('Sedang membuat akun...');

    setTimeout(function(){

    form.submit();

},200);

});
    </script>
@endsection