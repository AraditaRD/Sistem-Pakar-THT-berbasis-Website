@extends('layouts.pakar')

@section('title','Riwayat Konsultasi')
@section('page-title','Riwayat Konsultasi')

@section('content')

<div class="max-w-7xl mx-auto">

<div class="flex justify-between items-center mb-6">

    <div>

        <h2 class="text-3xl font-bold text-gray-800">
            Riwayat Konsultasi
        </h2>

        <p class="text-gray-500 mt-1">
            Seluruh hasil konsultasi pasien.
        </p>

        <div class="mt-4">

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama pasien atau penyakit..."
                    class="border rounded-lg px-4 py-2 w-80 focus:ring-2 focus:ring-green-500">

            </form>

        </div>

    </div>

    <div class="bg-[#BFDDBD] border border-green-200 text-gray-800 px-6 py-4 rounded-2xl shadow-md text-center">

        <p class="text-sm">
            Total Konsultasi
        </p>

        <p class="text-3xl font-bold">
            {{ $riwayat->total() }}
        </p>

    </div>

</div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">

                    <table class="w-full">

            <thead class="bg-[#BFDDBD] text-gray-800">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Tanggal
                    </th>

                    <th class="px-6 py-4 text-left">
                        Pasien
                    </th>

                    <th class="px-6 py-4 text-left">
                        Penyakit
                    </th>

                    <th class="px-6 py-4 text-center">
                        Persentase
                    </th>

                    <th class="px-6 py-4 text-center">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($riwayat as $item)

                <tr class="border-b hover:bg-green-50 transition">

                    <td class="px-6 py-5">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y H:i') }}
                    </td>

                    <td class="px-6 py-5">

                        <div class="font-semibold">
                            {{ $item->user->name }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $item->user->email }}
                        </div>

                    </td>

                    <td class="px-6 py-5">
                        {{ $item->penyakit->nama }}
                    </td>

                    <td class="px-6 py-5 text-center">

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            {{ $item->persentase }}%

                        </span>

                    </td>

                    <td class="px-6 py-5 text-center">

                        <span class="bg-green-500 text-white px-3 py-1 rounded-full">

                            {{ ucfirst($item->status) }}

                        </span>

                    </td>

                    <td class="px-6 py-5 text-center">

                        <button
                            onclick="showDetail({{ $item->id }})"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                            <i class="fas fa-eye mr-2"></i>
                            Detail

                        </button>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="py-16 text-center text-gray-500">

                        Belum ada riwayat konsultasi.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>
        
        </div>

    </div>

    @if($riwayat->hasPages())

    <div class="flex justify-center mt-8 mb-2">

        {{ $riwayat->onEachSide(1)->links() }}

    </div>

    @endif

</div>

{{-- ========================= --}}
{{-- MODAL DIMULAI DARI PART 2 --}}
{{-- ========================= --}}

{{-- ========================= --}}
{{-- MODAL DETAIL --}}
{{-- ========================= --}}

<div
    id="detailModal"
    class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-5">

    <div class="bg-white w-full max-w-5xl rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

        {{-- Header --}}

        <div class="flex items-center justify-between px-8 py-5 border-b bg-green-50">

            <div>

                <h3 class="text-2xl font-bold text-gray-800">

                    Detail Konsultasi

                </h3>

                <p class="text-sm text-gray-500">

                    Informasi lengkap hasil diagnosa pasien

                </p>

            </div>

            <button
                onclick="closeModal()"
                class="w-10 h-10 rounded-full hover:bg-red-100 text-gray-500 hover:text-red-600 transition">

                <i class="fas fa-times text-xl"></i>

            </button>

        </div>

        {{-- Body Scroll --}}

        <div class="overflow-y-auto px-8 py-6">

        @foreach($riwayat as $item)

            <div
                id="detail-{{ $item->id }}"
                class="hidden detail-item">

                {{-- INFORMASI PASIEN --}}

                <div class="grid md:grid-cols-3 gap-5 mb-8">

                    <div class="bg-green-50 border border-green-100 rounded-xl p-5">

                        <p class="text-sm text-gray-500">

                            Nama Pasien

                        </p>

                        <h4 class="font-bold text-xl mt-1">

                            {{ $item->user->name }}

                        </h4>

                        <p class="text-gray-500 mt-2">

                            {{ $item->user->email }}

                        </p>

                    </div>

                    <div class="bg-green-50 border border-green-100 rounded-xl p-5">

                        <p class="text-sm text-gray-500">

                            Tanggal Konsultasi

                        </p>

                        <h4 class="font-semibold mt-2">

                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                        </h4>

                        <p class="text-gray-500">

                            {{ \Carbon\Carbon::parse($item->tanggal)->format('H:i') }}

                        </p>

                    </div>

                    <div class="bg-green-50 border border-green-100 rounded-xl p-5 text-center">

                        <p class="text-sm text-gray-500">

                            Tingkat Kecocokan

                        </p>

                        <div class="mt-3">

                            <span
                                class="inline-flex w-20 h-20 items-center justify-center rounded-full text-2xl font-bold text-white

                                @if($item->persentase>=80)

                                    bg-green-600

                                @elseif($item->persentase>=50)

                                    bg-yellow-500

                                @else

                                    bg-red-500

                                @endif">

                                {{ $item->persentase }}%

                            </span>

                        </div>

                    </div>

                </div>

                {{-- PENYAKIT --}}

                <div class="bg-white border rounded-xl p-6 mb-6">

                    <p class="text-sm text-green-600 font-semibold">

                        HASIL DIAGNOSA

                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-1">

                        {{ $item->penyakit->nama }}

                    </h2>

                    <p class="text-gray-600 mt-4 leading-7">

                        {{ $item->penyakit->deskripsi }}

                    </p>

                </div>

                {{-- GEJALA --}}

                <div class="bg-white border rounded-xl p-6 mb-6">

                    <h3 class="font-bold text-xl mb-5">

                        Gejala yang Dipilih

                    </h3>

                    <div class="grid md:grid-cols-2 gap-3">

                        @foreach($item->detail as $detail)

                            @if($detail->jawaban=="ya")

                                <div class="flex items-center bg-green-50 rounded-lg px-4 py-3">

                                    <i class="fas fa-check-circle text-green-600 mr-3"></i>

                                    {{ $detail->gejala->nama }}

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

                {{-- PENYEBAB --}}

                <div class="bg-blue-50 rounded-xl p-6 mb-6">

                    <h3 class="font-bold text-blue-700 mb-3">

                        Penyebab

                    </h3>

                    <p class="text-gray-700 leading-7">

                        {{ $item->penyakit->penyebab }}

                    </p>

                </div>

                {{-- Pencegahan --}}

                <div class="bg-blue-50 rounded-xl p-6 mb-6">

                    <h3 class="font-bold text-blue-700 mb-3">

                        Pencegahan

                    </h3>

                    <p class="text-gray-700 leading-7">

                        {{ $item->penyakit->pencegahan }}

                    </p>

                </div>

                {{-- SOLUSI --}}

                <div class="bg-green-50 rounded-xl p-6">

                    <h3 class="font-bold text-green-700 mb-3">

                        Solusi

                    </h3>

                    <p class="text-gray-700 leading-7">

                        {{ $item->penyakit->solusi }}

                    </p>

                </div>

            </div>

        @endforeach

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

function showDetail(id)
{
    // tampilkan modal
    const modal = document.getElementById('detailModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // sembunyikan semua isi detail
    document.querySelectorAll('.detail-item').forEach(function(item){

        item.classList.add('hidden');

    });

    // tampilkan detail yang dipilih
    const detail = document.getElementById('detail-' + id);

    if(detail){

        detail.classList.remove('hidden');

    }

    // disable scroll body
    document.body.classList.add('overflow-hidden');
}

function closeModal()
{
    const modal = document.getElementById('detailModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

    // enable scroll body
    document.body.classList.remove('overflow-hidden');
}

// klik area hitam untuk menutup modal
document.getElementById('detailModal').addEventListener('click', function(e){

    if(e.target === this){

        closeModal();

    }

});

// tombol ESC
document.addEventListener('keydown', function(e){

    if(e.key === 'Escape'){

        closeModal();

    }

});

</script>

@endpush