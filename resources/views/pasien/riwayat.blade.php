@extends('layouts.app')

@section('title', 'Riwayat Diagnosa')
@section('page-title', 'Riwayat Diagnosa')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <h2 class="text-3xl font-bold text-gray-800">
            Riwayat Diagnosa
        </h2>

        @if($riwayat->hasPages())
            {{ $riwayat->onEachSide(1)->links() }}
        @endif

    </div>

    @if($riwayat->count())

        @foreach($riwayat as $item)

        <div class="relative pl-14 mb-10">

            {{-- Timeline --}}
            <div class="absolute left-6 top-0 bottom-0 w-1 bg-blue-200 rounded-full"></div>

            <div class="absolute left-3 top-8 w-7 h-7 bg-blue-600 rounded-full border-4 border-white shadow"></div>

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">

                <div class="flex justify-between items-center">

                    <div class="flex items-center gap-5">

                        <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">

                            <i class="fas fa-notes-medical text-2xl text-blue-600"></i>

                        </div>

                        <div>

                            <span class="text-blue-600 font-semibold">

                                {{ $item->penyakit->kode }}

                            </span>

                            <h3 class="text-3xl font-bold text-gray-800">

                                {{ $item->penyakit->nama }}

                            </h3>

                            <p class="text-gray-500 mt-1">

                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y • H:i') }}

                            </p>

                        </div>

                    </div>

                    <div class="text-center">

                        <div class="w-20 h-20 rounded-full flex items-center justify-center text-white font-bold text-xl

                        @if($item->persentase >= 80)
                            bg-green-500
                        @elseif($item->persentase >= 50)
                            bg-yellow-500
                        @else
                            bg-red-500
                        @endif">

                            {{ $item->persentase }}%

                        </div>

                        <p class="text-xs text-gray-500 mt-2">

                            Tingkat Kecocokan

                        </p>

                    </div>

                </div>

                <hr class="my-6">

                {{-- Gejala --}}
                <div class="flex justify-between items-center">

                    <div>

                        <h4 class="font-bold text-gray-700">

                            Gejala Dipilih

                        </h4>

                        <p class="text-gray-500 text-sm">

                            {{ $item->detail->count() }} Gejala

                        </p>

                    </div>

                    <button
                        class="btn-detail px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white"
                        data-id="{{ $item->id }}">

                        <i class="fas fa-eye mr-2"></i>

                        Detail

                    </button>

                </div>

                {{-- Informasi Penyakit --}}
                <div class="grid lg:grid-cols-2 gap-5 mt-8">

                    <div class="bg-gray-50 rounded-xl p-5">

                        <h4 class="font-bold text-blue-600 mb-3">

                            <i class="fas fa-book-medical mr-2"></i>

                            Deskripsi

                        </h4>

                        <p>

                            {{ $item->penyakit->deskripsi }}

                        </p>

                    </div>

                    <div class="bg-gray-50 rounded-xl p-5">

                        <h4 class="font-bold text-blue-600 mb-3">

                            <i class="fas fa-virus mr-2"></i>

                            Penyebab

                        </h4>

                        <p>

                            {{ $item->penyakit->penyebab }}

                        </p>

                    </div>

                    <div class="bg-gray-50 rounded-xl p-5 lg:col-span-2">

                        <h4 class="font-bold text-blue-600 mb-3">

                            <i class="fas fa-shield-alt mr-2"></i>

                            Pencegahan

                        </h4>

                        <p>

                            {{ $item->penyakit->pencegahan }}

                        </p>

                    </div>

                </div>

                {{-- Solusi --}}
                <div class="mt-5 bg-green-50 border border-green-200 rounded-xl p-5">

                    <h4 class="font-bold text-green-700 mb-3">

                        <i class="fas fa-hand-holding-medical mr-2"></i>

                        Solusi

                    </h4>

                    <p>

                        {{ $item->penyakit->solusi }}

                    </p>

                </div>

            </div>

        </div>

        @endforeach

    @else

        <div class="bg-white rounded-2xl shadow-md p-10 text-center">

            <i class="fas fa-history text-5xl text-gray-300 mb-5"></i>

            <h3 class="text-2xl font-semibold text-gray-600">

                Belum ada riwayat diagnosa

            </h3>

            <p class="text-gray-400 mt-2">

                Silakan lakukan diagnosa terlebih dahulu.

            </p>

        </div>

    @endif

    <div class="text-center mt-8">

        <a href="{{ route('pasien.diagnosa') }}"
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700">

            <i class="fas fa-stethoscope mr-2"></i>

            Diagnosa Baru

        </a>

    </div>

</div>

{{-- Modal Detail --}}
<div id="detailModal"
class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-xl w-11/12 max-w-4xl max-h-[90vh] overflow-y-auto p-8 relative">

        <button
        id="closeDetail"
        class="absolute right-5 top-4 text-3xl">

            &times;

        </button>

        <div id="detailContent"></div>

    </div>

</div>

@endsection


@section('scripts')

<script>

    console.log("SCRIPT BERJALAN");

document.querySelectorAll(".btn-detail").forEach(button=>{

    button.addEventListener("click",()=>{

        const id=button.dataset.id;

        fetch("/pasien/riwayat/"+id)

        .then(res=>res.json())

        .then(data=>{

            showDetail(data);

        });

    });

});

document.getElementById("closeDetail")
.addEventListener("click",()=>{

    const modal=document.getElementById("detailModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");

});

function showDetail(data){

    const modal=document.getElementById("detailModal");

    const content=document.getElementById("detailContent");

    content.innerHTML=`

        <h2 class="text-3xl font-bold mb-2">

            ${data.penyakit.nama}

        </h2>

        <p class="mb-4">

            Persentase :

            <b>${data.persentase}%</b>

        </p>

        <hr class="mb-5">

        <h3 class="font-bold text-xl mb-3">

            Gejala yang Dipilih

        </h3>

        <div class="flex flex-wrap gap-3">

            ${data.detail.map(item=>`

                <span class="bg-blue-100 text-blue-700 px-3 py-2 rounded-full">

                    ${item.gejala.nama}

                    (CF User : ${item.cf_user})

                </span>

            `).join("")}

        </div>

    `;

    modal.classList.remove("hidden");
    modal.classList.add("flex");

}

</script>

@endsection