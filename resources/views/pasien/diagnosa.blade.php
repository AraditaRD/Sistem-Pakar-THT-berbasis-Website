@extends('layouts.app')

@section('title', 'Diagnosa')
@section('page-title', 'Diagnosa Penyakit THT')

@section('content')

<div id="warningModal"
    class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-xl w-[94%]sm:w-full max-w-2xl max-h-[90vh] overflow-y-auto relative mx-auto">

        <!-- Tombol Close -->
        <button
            onclick="closeWarning()"
            class="absolutetop-3 right-3 sm:top-4 sm:right-5 text-gray-400 hover:text-red-500 text-xl sm:text-2xl">

            &times;

        </button>

        <div class="p-5 sm:p-8">

            <div class="flex items-start sm:items-center mb-5">

                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-yellow-100 flex items-center justify-center mr-4">

                    <i class="fas fa-triangle-exclamation text-yellow-500 text-xl sm:text-2xl"></i>

                </div>

                <div>

                    <h2 class="text-xl sm:text-3xl font-bold text-gray-800 leading-tight">
                        Perhatian Sebelum Diagnosa
                    </h2>

                    <p class="text-sm sm:text-base text-gray-500">
                        Mohon baca informasi berikut terlebih dahulu.
                    </p>

                </div>

            </div>

            <div class="space-y-3 sm:space-y-5 text-sm sm:text-base text-gray-700 leading-7">

                <p>
                    Mohon jawab setiap pertanyaan gejala sesuai dengan kondisi yang benar-benar Anda alami agar sistem dapat memberikan hasil diagnosa yang lebih akurat.
                </p>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 sm:p-5 rounded-lg">

                    <b>Catatan Penting</b>

                    <p class="mt-2">
                        Sistem pakar ini hanya digunakan sebagai media diagnosa awal (sementara) dan tidak dapat menggantikan pemeriksaan maupun diagnosis dari tenaga medis profesional.
                    </p>

                </div>

                <p>
                    Jika gejala yang Anda alami semakin parah, berlangsung dalam waktu lama, atau hasil diagnosa masih dirasa kurang meyakinkan, segera konsultasikan dengan dokter atau fasilitas kesehatan terdekat.
                </p>

            </div>

            <div class="mt-6 sm:mt-8 text-center sm:text-right">

                <button
                    onclick="closeWarning()"
                    class="bg-green-600 hover:bg-green-700 text-white w-full sm:w-auto px-5 py-2.5 rounded-lg font-medium">

                    Saya Mengerti

                </button>

            </div>

        </div>

    </div>

</div>

<div class="max-w-2xl mx-auto">
    <div id="diagnosis-panel"
    class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-6 fade-in">
        <div id="current-hypothesis" class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <h3 class="font-semibold text-blue-800 mb-2">Sistem sedang memeriksa:</h3>
            <p id="hypothesis-name" class="text-lg font-medium text-blue-900"></p>
            <p id="hypothesis-description" class="text-sm text-blue-700 mt-1"></p>
        </div>

        <h3 id="question-text" class="text-xl font-semibold text-gray-800 mb-4"></h3>
        <div class="space-y-3">
                    <div class="flex flex-col gap-3">

                        <button class="cf-option bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 py-3 rounded-lg transition"
                            data-value="0">
                            Tidak
                        </button>

                        <button class="cf-option bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 py-3 rounded-lg transition"
                            data-value="0.2">
                            Tidak Yakin
                        </button>

                        <button class="cf-option bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 py-3 rounded-lg transition"
                            data-value="0.4">
                            Sedikit Yakin
                        </button>

                        <button class="cf-option bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 py-3 rounded-lg transition"
                            data-value="0.6">
                            Cukup Yakin
                        </button>

                        <button class="cf-option bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 py-3 rounded-lg transition"
                            data-value="0.8">
                            Yakin
                        </button>

                        <button class="cf-option bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 py-3 rounded-lg transition"
                            data-value="1">
                            Sangat Yakin
                        </button>

                    </div>
        </div>
    </div>

    <div id="multiple-results" class="mt-6"></div>

    <div class="mt-6">
        <div class="flex justify-between text-sm text-gray-600 mb-1">
            <span>Progress Diagnosa</span>
            <span id="progress-text">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div id="progress-bar" class="bg-primary h-2 rounded-full progress-bar" style="width: 0%"></div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.progress-bar {
    transition: width 0.5s ease-in-out;
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@section('scripts')
<script>

function closeWarning() {
    document
        .getElementById('warningModal')
        .classList.add('hidden');
}

// ✅ BENAR - tanpa parameter value:
const diseases = @json($diseases ?? []);
const gejalaMapping = @json($gejalaMapping ?? []);

// Debug
console.log(diseases);
console.log(Object.keys(diseases));
console.log(JSON.stringify(diseases, null, 2));
console.log('Jumlah Penyakit:', Object.keys(diseases).length);

// ==========================
// STATE DIAGNOSA
// ==========================

const diseaseKeys = Object.keys(diseases);

let currentDiseaseIndex = 0;

let currentQuestionIndex = 0;

let currentQuestions = [];

let currentDisease = null;

let jawabanPasien = [];

let currentDiseaseAnswers = [];

let diagnosisResults = [];

let diagnosisComplete = false;

function startBackwardChaining(){

    diagnosisComplete=false;

    currentDiseaseIndex=0;

    currentQuestionIndex=0;

    currentQuestions=[];

    currentDisease=null;

    jawabanPasien=[];

    currentDiseaseAnswers = [];

    diagnosisResults=[];

    nextDisease();

}

function nextDisease() {

    console.log("===== NEXT DISEASE =====");
    console.log("Index :", currentDiseaseIndex);
    console.log("Total :", diseaseKeys.length);

    if (currentDiseaseIndex >= diseaseKeys.length) {

        finishDiagnosis();

        return;

    }

    const kode = diseaseKeys[currentDiseaseIndex];

    currentDisease = diseases[kode];

currentQuestions = currentDisease.symptoms;

    currentQuestionIndex = 0;

    currentDiseaseAnswers = [];

    document.getElementById('hypothesis-name').textContent =
        currentDisease.name;

    document.getElementById('hypothesis-description').textContent =
        currentDisease.description;

    // updatePossibleDiseasesList();

    nextQuestion();

}

function nextQuestion() {

if (currentQuestionIndex >= currentQuestions.length) {

    evaluateCurrentDisease();

    return;

}

    const soal =
    currentQuestions[currentQuestionIndex];

document.getElementById('question-text').textContent =
    `Apakah Anda mengalami ${soal.nama}?`;

}

function evaluateCurrentDisease() {

    console.log("Evaluasi :", currentDisease.name);

    // Ambil jawaban pasien hanya untuk penyakit yang sedang diuji
const jawabanPenyakit =
currentDiseaseAnswers;

    // Jika pasien tidak memilih satu pun gejala
    const adaGejalaDipilih = jawabanPenyakit.some(j => j.cf_user > 0);

    if (!adaGejalaDipilih) {

        currentDiseaseIndex++;

        updateProgress();

        nextDisease();

        return;

    }

    diagnosisResults.push({

        id: currentDisease.id,

        kode: diseaseKeys[currentDiseaseIndex],

        nama: currentDisease.name,

        gejala: currentQuestions,

        jawaban: jawabanPenyakit

    });

    currentDiseaseIndex++;

    updateProgress();

    nextDisease();

}

function showResult(hasil, kemungkinanLain) {
    const disease = diseases[hasil.kode];

    if (!disease) return;

    const resultsDiv = document.getElementById('multiple-results');
    if (resultsDiv) {

    resultsDiv.innerHTML = `
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 fade-in">

            <div class="text-center mb-6">

                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-white text-2xl"></i>
                </div>

<h3 class="text-2xl font-bold text-gray-800 mb-2">

Diagnosa:
${disease.name}

</h3>

<div class="my-4">

        <div class="inline-block bg-green-100 px-5 py-3 rounded-xl">

            <p class="text-sm text-gray-600">
            Tingkat Keyakinan
            </p>

            <p class="text-3xl font-bold text-green-700">

            ${hasil.persentase} %

            </p>

            </div>

</div>

<!--
<div class="my-4">

    <p class="text-lg text-gray-700">

        <b>Total:</b>
        ${hasil.gejalaCocok} dari ${hasil.totalGejala} gejala terpenuhi

    </p>

</div>
-->

                <p class="text-gray-600">
                    ${disease.description || ''}
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <h4 class="font-semibold text-gray-800 mb-3">
                        Gejala yang Cocok:
                    </h4>

                    <ul class="list-disc pl-5 text-gray-600 space-y-2">

                       ${hasil.jawaban
                        .filter(j => j.cf_user > 0)
                        .map(j => {

                            const gejala = disease.symptoms.find(g => g.id == j.gejala_id);

                            return `<li>${gejala ? gejala.nama : '-'}</li>`;

                        }).join('')}

                    </ul>

                    <h4 class="font-semibold text-gray-800 mb-3 mt-4">
                        Penyebab:
                    </h4>

                    <ul class="list-disc pl-5 text-gray-600 space-y-2">

                        ${
                            Array.isArray(disease.causes)
                                ? disease.causes
                                    .map(cause => `<li>${cause}</li>`)
                                    .join('')
                                : `<li>${disease.causes || 'Tidak ada data'}</li>`
                        }

                    </ul>

                </div>

                <div>

                    <h4 class="font-semibold text-gray-800 mb-3">
                        Solusi:
                    </h4>

                    <ul class="list-disc pl-5 text-gray-600 space-y-2">

                        ${
                            Array.isArray(disease.treatment)
                                ? disease.treatment
                                    .map(treatment => `<li>${treatment}</li>`)
                                    .join('')
                                : `<li>${disease.treatment || 'Tidak ada data'}</li>`
                        }

                    </ul>

                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">

                        <h4 class="font-semibold text-yellow-800 mb-2">
                            Disclaimer:
                        </h4>

                        <p class="text-sm text-yellow-700">
                            Hasil diagnosa ini merupakan perkiraan berdasarkan gejala yang Anda laporkan.
                            Disarankan untuk berkonsultasi dengan dokter THT untuk diagnosa dan penanganan yang tepat.
                        </p>

                    </div>

                </div>

            </div>

            ${
                kemungkinanLain.length > 0
                ? `
                <div class="mt-8 border-t pt-6">

                    <h4 class="font-semibold text-gray-800 mb-3">
                        Kemungkinan Penyakit Lain
                    </h4>

                    <ul class="space-y-2">

                ${kemungkinanLain
                    .slice(0,3)
                    .map(item => `

            <li class="bg-gray-50 rounded-lg p-3">

                <span class="font-medium">
                    ${item.nama}
                </span>

                <span class="text-green-600 font-semibold">

                ${item.persentase}%

                </span>

            </li>

            `).join('')}

            </ul>

            <div class="mt-8 text-center">

    <a href="{{ route('pasien.riwayat') }}"
    class="inline-block px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">

        <i class="fas fa-history mr-2"></i>
        Lihat Riwayat Diagnosa

    </a>

</div>

        </div>
`
: ''
}

        </div>
    `;

}

    document.getElementById('current-hypothesis').style.display = 'none';

    document.getElementById('question-text').style.display = 'none';

    document.querySelectorAll('.cf-option').forEach(el => {
        el.style.display = 'none';
    });

    //document.getElementById('possible-diseases-container').style.display = 'none';

    document.getElementById('progress-text').textContent = '100%';
    document.getElementById('progress-bar').style.width = '100%';
    document.getElementById('progress-bar').classList.remove('bg-primary');
    document.getElementById('progress-bar').classList.add('bg-green-500');

    diagnosisComplete = true;
}

function hitungCFPenyakit(dataPenyakit){

    let hasilCF = [];

    dataPenyakit.gejala.forEach(function(gejala){

        const jawaban = dataPenyakit.jawaban.find(j =>

            j.gejala_id == gejala.id

        );

        if(!jawaban){

            return;

        }

        const cfPakar = parseFloat(gejala.cf_pakar);

        const cfUser = parseFloat(jawaban.cf_user);

        hasilCF.push({

            gejala_id: gejala.id,

            nama: gejala.nama,

            cf_pakar: cfPakar,

            cf_user: cfUser,

            cf_he: cfPakar * cfUser

        });

    });

    return hasilCF;

}

function hitungCFCombine(cfDetail){

    if(cfDetail.length === 0){

        return 0;

    }

    let cfCombine = cfDetail[0].cf_he;

    for(let i = 1; i < cfDetail.length; i++){

        cfCombine =

            cfCombine +

            (cfDetail[i].cf_he * (1 - cfCombine));

    }

    return Number(cfCombine.toFixed(4));

}

function finishDiagnosis() {

    console.log("MASUK FINISH DIAGNOSIS");

    showLoading(
    "Sistem sedang menghitung hasil diagnosa.<br>Mohon tunggu beberapa saat..."
);

    console.log(diagnosisResults);

    // Tidak ada penyakit yang cocok
    if (diagnosisResults.length === 0) {

        document.getElementById('diagnosis-panel').style.display = 'none';

        document.getElementById('multiple-results').innerHTML = `
            <div class="bg-white rounded-xl shadow-md p-6 text-center">

                <div class="text-red-600 text-2xl font-bold mb-3">
                    Penyakit Tidak Ditemukan
                </div>

                <p class="text-gray-600">
                    Berdasarkan jawaban Anda,
                    sistem tidak menemukan penyakit yang sesuai.
                </p>

            </div>
        `;

        updateProgress();

        return;
    }

    diagnosisResults.forEach(function(item){

    item.cf_detail = hitungCFPenyakit(item);

    item.cf = hitungCFCombine(item.cf_detail);

    item.persentase =

        Number((item.cf * 100).toFixed(2));

    item.gejalaCocok = item.jawaban.filter(j => j.cf_user > 0).length;

    item.totalGejala = item.gejala.length;

});

console.table(

    diagnosisResults.map(item=>({

        penyakit:item.nama,

        cf:item.cf,

        persentase:item.persentase

    }))

);

console.log(diagnosisResults);
    diagnosisComplete = true;


    diagnosisResults.sort((a,b)=>{

    // Prioritas 1
    if(b.cf !== a.cf){

        return b.cf - a.cf;

    }

    // Prioritas 2
    if(b.gejalaCocok !== a.gejalaCocok){

        return b.gejalaCocok - a.gejalaCocok;

    }

    // Prioritas 3
    if(b.totalGejala !== a.totalGejala){

        return b.totalGejala - a.totalGejala;

    }

    // Prioritas 4
    return a.kode.localeCompare(b.kode);

});

const hasil =
diagnosisResults[0];

console.log(hasil);

    const kemungkinanLain =
        diagnosisResults.slice(1);

    simpanDiagnosa(
        hasil,
        kemungkinanLain
);

}

function simpanDiagnosa(hasil,kemungkinanLain){

    console.log("DATA YANG DISIMPAN");
    console.table(jawabanPasien);

    fetch('/pasien/diagnosa/simpan',{

        method:'POST',

        headers:{

            'Content-Type':'application/json',

            'X-CSRF-TOKEN':
                document.querySelector(
                    'meta[name="csrf-token"]'
                ).content

        },

        body:JSON.stringify({

            penyakit_id:
                hasil.id,

            persentase:
                hasil.persentase,

            gejala:
                jawabanPasien,

            kemungkinan_lain: 
                kemungkinanLain

        })

    })

    .then(async response => {

    console.log("STATUS :", response.status);

    const data = await response.json();

    console.log("DATA :", data);

    return data;

})

    .then(res => {

    console.log("Response:");
    console.log(res);

    if (res.success) {

        console.log("SEBELUM SHOWRESULT");
        console.log(hasil);

        try {

            hideLoading();
            showResult(
                hasil,
                kemungkinanLain
            );

            console.log("SETELAH SHOWRESULT");

        } catch (e) {

            console.error("ERROR SHOWRESULT");
            console.error(e);

        }

    } else {

    hideLoading();

    console.error(res);

    alert(res.error ?? res.message ?? "Terjadi kesalahan saat menyimpan hasil diagnosa.");

}

});

}

function updateProgress(){

    let progress = Math.round(
        (currentDiseaseIndex / diseaseKeys.length) * 100
    );

    // Maksimal 100%
    progress = Math.min(progress, 100);

    document.getElementById("progress-text").textContent =
        progress + "%";

    document.getElementById("progress-bar").style.width =
        progress + "%";

}

document.querySelectorAll('.cf-option').forEach(btn=>{

    btn.addEventListener('click',function(){

        if(diagnosisComplete) return;

        const cfUser =
            parseFloat(this.dataset.value);

                    // Reset semua tombol
document.querySelectorAll('.cf-option').forEach(b => {

    b.classList.remove(
        'bg-blue-600',
        'text-white',
        'border-blue-600'
    );

    b.classList.add(
        'bg-gray-100',
        'text-gray-700',
        'border-gray-300'
    );

});

// Warnai tombol yang dipilih
this.classList.remove(
    'bg-gray-100',
    'text-gray-700',
    'border-gray-300'
);

this.classList.add(
    'bg-blue-600',
    'text-white',
    'border-blue-600'
);

        const soal =
        currentQuestions[currentQuestionIndex];
    

        const jawaban = {

            gejala_id: soal.id,

            kode: soal.kode,

            cf_user: cfUser

        };

        jawabanPasien.push(jawaban);

        currentDiseaseAnswers.push(jawaban);

        // dianggap memenuhi bila user memilih
        // minimal cukup yakin

        currentQuestionIndex++;

        setTimeout(()=>{

    if(!diagnosisComplete){

        nextQuestion();

    }

},250);

    });

});

document.addEventListener('DOMContentLoaded', function() {

    console.log('DATA PENYAKIT');
    console.table(diseases);

    if (Object.keys(diseases).length > 0) {
        startBackwardChaining();
    } else {
        console.warn('Data penyakit kosong');
    }
});
</script>
@endsection