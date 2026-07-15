@extends('layouts.pakar')

@section('title','Data Pakar')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800">
            Data Pakar
        </h1>

        <p class="text-gray-500 mt-2">
            Kelola akun pakar yang dapat mengakses sistem pakar THT.
        </p>

        <form method="GET" class="mt-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, email, atau no HP..."
                class="w-80 border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">

        </form>

    </div>

    <button
        onclick="document.getElementById('modalTambah').classList.remove('hidden')"
        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-semibold shadow">

        <i class="fas fa-user-plus mr-2"></i>

        Tambah Pakar

    </button>

</div>


<div class="bg-white rounded-2xl shadow overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full">

        <thead class="bg-green-100">

            <tr class="text-left">

                <th class="px-6 py-4">Nama</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">No HP</th>
                <th class="px-6 py-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

        @forelse($pakar as $item)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-6 py-4 font-semibold">

                    {{ $item->name }}

                </td>

                <td class="px-6 py-4">

                    {{ $item->email }}

                </td>

                <td class="px-6 py-4">

                    {{ $item->no_hp }}

                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center items-center gap-3">

    {{-- Edit --}}
    <button
        onclick="editPakar(
            '{{ $item->id }}',
            '{{ $item->name }}',
            '{{ $item->email }}',
            '{{ $item->no_hp }}'
        )"
        class="bg-green-100 hover:bg-green-200 text-green-600 w-12 h-12 rounded-xl flex items-center justify-center transition">

        <i class="fas fa-pen"></i>

    </button>

    {{-- Hapus --}}
    <form
        class="formDeletePakar"
        action="{{ route('pakar.pakar.destroy',$item->id) }}"
        method="POST">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            onclick="return confirm('Hapus akun pakar ini?')"
            class="btnDeletePakar bg-red-100 hover:bg-red-200 text-red-600 w-12 h-12 rounded-xl flex items-center justify-center transition">

            <i class="fas fa-trash"></i>

        </button>

    </form>

</div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4"
                    class="text-center py-10 text-gray-400">

                    Belum ada data pakar.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    @if($pakar->hasPages())

<div class="flex justify-center mt-8">

    {{ $pakar->onEachSide(1)->links() }}

</div>

@endif

    </div>
</div>



{{-- ========================= --}}
{{-- MODAL TAMBAH --}}
{{-- ========================= --}}

<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 flex items-center gap-2 justify-center z-50 p-4">
<div class="bg-white rounded-2xl w-[95%] sm:w-full max-w-lg p-5 sm:p-8 max-h-[90vh] overflow-y-auto">

<h2 class="text-2xl font-bold mb-6">

Tambah Pakar

</h2>

@if ($errors->any())
<div class="bg-red-100 p-4 rounded mb-4">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form
    id="formTambahPakar"
    action="{{ route('pakar.pakar.store') }}"
    method="POST">

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

                @csrf

                <div class="space-y-5">

                <div>

                <label>Nama</label>

                <input
                type="text"
                name="name"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>Email</label>

                <input
                type="email"
                name="email"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>No HP</label>

                <input
                type="text"
                name="no_hp"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>Password</label>

                <input
                type="password"
                name="password"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>Konfirmasi Password</label>

                <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                </div>

                <div class="flex justify-end gap-3 mt-8">

                <button
                type="button"
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="px-5 py-2 rounded-lg bg-gray-300">

                Batal

                </button>

                <button
                    id="btnTambahPakar"
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-green-500 text-white">

                    Simpan

                </button>

            </div>

                </form>

        </div>

    </div>



                {{-- ========================= --}}
                {{-- MODAL EDIT --}}
                {{-- ========================= --}}

                <div
                id="modalEdit"
                class="hidden fixed inset-0 bg-black/40 flex items-center gap-2 justify-center z-50 p-4">

                <div class="bg-white rounded-2xl w-[95%] sm:w-full max-w-lg p-5 sm:p-8 max-h-[90vh] overflow-y-auto">

                <h2 class="text-2xl font-bold mb-6">

                Edit Pakar

                </h2>

                <form
                    id="formEdit"
                    method="POST">

                @csrf
                @method('PUT')

                <div class="space-y-5">

                <input type="hidden" id="edit_id">

                <div>

                <label>Nama</label>

                <input
                id="edit_name"
                type="text"
                name="name"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>Email</label>

                <input
                id="edit_email"
                type="email"
                name="email"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>No HP</label>

                <input
                id="edit_no_hp"
                type="text"
                name="no_hp"
                class="w-full border rounded-lg p-3"
                required>

                </div>

                <div>

                <label>Password Baru (Opsional)</label>

                <input
                type="password"
                name="password"
                class="w-full border rounded-lg p-3">

                </div>

                <div>

                <label>Konfirmasi Password</label>

                <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded-lg p-3">

                </div>

                </div>

                <div class="flex justify-end gap-3 mt-8">

                <button
                type="button"
                onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="px-5 py-2 rounded-lg bg-gray-300">

                Batal

                </button>

                <button
                    id="btnUpdatePakar"
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white">

                Update

                </button>

                </div>

                </form>

                </div>

                </div>

                @endsection


                @push('scripts')

                <script>

                function editPakar(id,nama,email,nohp){

                document.getElementById('edit_name').value=nama;
                document.getElementById('edit_email').value=email;
                document.getElementById('edit_no_hp').value=nohp;

                document.getElementById('formEdit').action="/pakar/pakar/"+id;

                document.getElementById('modalEdit').classList.remove('hidden');

                }

                // =========================
// TAMBAH PAKAR
// =========================

document.getElementById('formTambahPakar')
?.addEventListener('submit', function(){

    document
        .getElementById('btnTambahPakar')
        .disabled = true;

    showLoading(
        "Menyimpan data pakar..."
    );

});

// =========================
// EDIT PAKAR
// =========================

document.getElementById('formEdit')
?.addEventListener('submit', function(){

    document
        .getElementById('btnUpdatePakar')
        .disabled = true;

    showLoading(
        "Memperbarui data pakar..."
    );

});

// =========================
// HAPUS PAKAR
// =========================

document.querySelectorAll('.formDeletePakar')
.forEach(function(form){

    form.addEventListener('submit', function(){

        form
            .querySelector('.btnDeletePakar')
            .disabled = true;

        showLoading(
            "Menghapus data pakar..."
        );

    });

});

                </script>

                @endpush