@extends('layouts.app')

@section('title','Informasi Penyakit')
@section('page-title','Informasi Penyakit')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h2 class="text-3xl font-bold text-gray-800">
            Informasi Penyakit THT
        </h2>

        <p class="text-gray-500 mt-2">
            Pelajari informasi mengenai penyakit THT beserta deskripsi, penyebab,
            dan cara penanganannya.
        </p>

    </div>

    <div class="grid lg:grid-cols-2 gap-8">

        @foreach($penyakit as $item)

        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition duration-300">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">

                <div class="flex justify-between items-center">

                    <div>

                        <span class="bg-white/20 px-3 py-1 rounded-full text-sm">

                            {{ $item->kode }}

                        </span>

                        <h3 class="text-2xl font-bold mt-3">

                            {{ $item->nama }}

                        </h3>

                    </div>

                    <div class="text-5xl">

                        <i class="fas fa-notes-medical"></i>

                    </div>

                </div>

            </div>

            <div class="p-6">

                <div class="mb-6">

                    <h4 class="font-semibold text-gray-800 mb-2">

                        <i class="fas fa-book-medical text-blue-600 mr-2"></i>

                        Deskripsi

                    </h4>

                    <p class="text-gray-600 leading-relaxed">

                        {{ $item->deskripsi }}

                    </p>

                </div>

                <hr class="my-6">

<div class="flex justify-end">

    <button
        class="btn-detail px-5 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition"

        data-kode="{{ $item->kode }}"
        data-nama="{{ $item->nama }}"
        data-penyebab="{{ $item->penyebab }}"
        data-pencegahan="{{ $item->pencegahan }}"
        data-solusi="{{ $item->solusi }}">

        <i class="fas fa-eye mr-2"></i>
        Detail

    </button>

</div>

            </div>

        </div>

        @endforeach

    </div>

</div>

                <div id="detailModal"
                class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

                <div class="bg-white rounded-2xl w-11/12 max-w-xl max-h-[90vh] overflow-y-auto relative">

                <button
                id="closeModal"
                class="absolute right-5 top-4 text-3xl">

                ×

                </button>

                <div class="p-8">

                <h2
                id="modalNama"
                class="text-3xl font-bold mb-2">
                </h2>

                <p
                id="modalKode"
                class="text-blue-600 mb-6">
                </p>

                <hr class="mb-6">

                <div class="mb-6">

                <h3 class="font-bold text-orange-600 mb-2">

                <i class="fas fa-virus mr-2"></i>

                Penyebab

                </h3>

                <p id="modalPenyebab"></p>

                </div>

                <div class="mb-6">

                <h3 class="font-bold text-green-600 mb-2">

                <i class="fas fa-shield-alt mr-2"></i>

                Pencegahan

                </h3>

                <p id="modalPencegahan"></p>

                </div>

                <div>

                <h3 class="font-bold text-blue-600 mb-2">

                <i class="fas fa-hand-holding-medical mr-2"></i>

                Solusi

                </h3>

                <p id="modalSolusi"></p>

                </div>

                </div>

                </div>

                </div>

                @section('scripts')

<script>

const modal = document.getElementById("detailModal");

document.querySelectorAll(".btn-detail").forEach(btn=>{

btn.onclick=()=>{

document.getElementById("modalNama").innerHTML=btn.dataset.nama;

document.getElementById("modalKode").innerHTML=btn.dataset.kode;

document.getElementById("modalPenyebab").innerHTML=btn.dataset.penyebab;

document.getElementById("modalPencegahan").innerHTML=btn.dataset.pencegahan;

document.getElementById("modalSolusi").innerHTML=btn.dataset.solusi;

modal.classList.remove("hidden");

modal.classList.add("flex");

};

});

document.getElementById("closeModal").onclick=()=>{

modal.classList.remove("flex");

modal.classList.add("hidden");

};

modal.onclick=(e)=>{

if(e.target===modal){

modal.classList.remove("flex");

modal.classList.add("hidden");

}

};

</script>

@endsection

@endsection