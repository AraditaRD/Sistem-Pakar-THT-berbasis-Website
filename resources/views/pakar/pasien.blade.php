@extends('layouts.pakar')

@section('title','Akun Pasien')
@section('page-title','Akun Pasien')

@section('content')

<div class="max-w-7xl mx-auto">

<div class="flex justify-between items-center mb-6">

    <div>

        <h2 class="text-3xl font-bold text-gray-800">
            Daftar Akun Pasien
        </h2>

        <p class="text-gray-500 mt-1">
            Seluruh pasien yang telah melakukan registrasi.
        </p>

        <form method="GET" class="mt-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, email, atau no HP..."
                class="border rounded-lg px-4 py-2 w-80 focus:ring-2 focus:ring-green-500">

        </form>

    </div>

    <div class="bg-[#BFDDBD] border border-green-200 text-gray-800 px-6 py-4 rounded-2xl shadow-md text-center">

        <p class="text-sm font-medium">
            Total Pasien
        </p>

        <p class="text-3xl font-bold mt-1">
            {{ $pasien->total() }}
        </p>

    </div>

</div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full">

            <thead class="bg-[#BFDDBD] text-gray-800">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold">
                        Nama
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Email
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        No HP
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        Diagnosa
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pasien as $item)

                <tr class="border-b hover:bg-green-50 transition duration-200">

                    <td class="px-6 py-5">

                        <div class="font-bold text-gray-800">

                            {{ $item->name }}

                        </div>

                        <div class="text-sm text-gray-500 mt-1">

                            {{ $item->tanggal_lahir }}

                        </div>

                    </td>

                    <td class="px-6 py-5 text-gray-700">

                        {{ $item->email }}

                    </td>

                    <td class="px-6 py-5 text-center text-gray-700">

                        {{ $item->no_hp }}

                    </td>

                    <td class="px-6 py-5 text-center">

                        <span class="bg-[#DCEFD9] text-green-800 px-4 py-2 rounded-full text-sm font-semibold">

                            {{ $item->konsultasi_count }} kali

                        </span>

                    </td>

                    <td class="px-6 py-5 text-center">

                        @if($item->status == 'aktif')

                            <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-sm">

                                Aktif

                            </span>

                        @else

                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-sm">

                                Nonaktif

                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-5 text-center">

                <button
                    onclick="detailPasien(
                        '{{ $item->name }}',
                        '{{ $item->email }}',
                        '{{ $item->no_hp }}',
                        '{{ $item->tanggal_lahir }}',
                        '{{ $item->status }}',
                        '{{ $item->konsultasi_count }}'
                    )"
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition">

                    Detail

                    <i class="fas fa-eye"></i>

                </button>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="py-16 text-center text-gray-500">

                        <i class="fas fa-users text-5xl text-gray-300 mb-3"></i>

                        <p class="text-lg">

                            Belum ada pasien yang melakukan registrasi.

                        </p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        @if($pasien->hasPages())

<div class="flex justify-center mt-8">

    {{ $pasien->onEachSide(1)->links() }}

</div>

@endif
        </div>

    </div>
</div>

<div
id="modalDetail"
class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-4">

<div class="bg-white rounded-2xl w-[95%] sm:w-full max-w-3xl overflow-hidden">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold text-gray-800">
            Detail Pasien
        </h2>

        <button
            onclick="document.getElementById('modalDetail').classList.add('hidden')"
            class="text-2xl text-gray-500 hover:text-black">

            &times;

        </button>

    </div>

    <div id="detailBody" class="p-6"></div>

    <div class="mt-8 text-right">

        <button
            onclick="document.getElementById('modalDetail').classList.add('hidden')"
            class="bg-green-600 text-white px-5 py-2 rounded-lg">

            Tutup

        </button>

    </div>

</div>

</div>

@endsection

@push('scripts')
<script>

function detailPasien(
    nama,
    email,
    hp,
    tgl,
    status,
    total
){

    document.getElementById("detailBody").innerHTML = `

    <div class="space-y-6">

        <div class="bg-green-50 border border-green-100 rounded-xl p-6">

            <div class="flex items-center gap-5">

                <div class="w-20 h-20 rounded-full bg-green-600 flex items-center justify-center text-white text-3xl">

                    <i class="fas fa-user"></i>

                </div>

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">

                        ${nama}

                    </h2>

                    <p class="text-gray-500 mt-2">

                        ${email}

                    </p>

                </div>

            </div>

        </div>

        <div class="grid md:grid-cols-2 gap-5">

            <div class="bg-blue-50 rounded-xl p-5">

                <h3 class="font-bold text-blue-700 mb-3">

                    <i class="fas fa-phone-alt mr-2"></i>

                    Nomor HP

                </h3>

                <p class="text-gray-700">

                    ${hp || '-'}

                </p>

            </div>

            <div class="bg-purple-50 rounded-xl p-5">

                <h3 class="font-bold text-purple-700 mb-3">

                    <i class="fas fa-calendar-alt mr-2"></i>

                    Tanggal Lahir

                </h3>

                <p class="text-gray-700">

                    ${tgl || '-'}

                </p>

            </div>

            <div class="bg-yellow-50 rounded-xl p-5">

                <h3 class="font-bold text-yellow-700 mb-3">

                    <i class="fas fa-notes-medical mr-2"></i>

                    Total Diagnosa

                </h3>

                <span class="inline-flex px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                    ${total} kali

                </span>

            </div>

            <div class="bg-gray-50 rounded-xl p-5">

                <h3 class="font-bold text-gray-700 mb-3">

                    <i class="fas fa-user-check mr-2"></i>

                    Status Akun

                </h3>

                ${
                    status === 'aktif'
                    ?
                    `<span class="inline-flex px-4 py-2 rounded-full bg-green-500 text-white font-semibold">
                        Aktif
                    </span>`
                    :
                    `<span class="inline-flex px-4 py-2 rounded-full bg-red-500 text-white font-semibold">
                        Nonaktif
                    </span>`
                }

            </div>

        </div>

    </div>

    `;

    document
        .getElementById('modalDetail')
        .classList.remove('hidden');

}

</script>
@endpush