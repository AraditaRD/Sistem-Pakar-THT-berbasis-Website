@extends('layouts.pakar')

@section('title', 'Aturan Diagnosa')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Aturan Diagnosa</h1>
    <p class="text-gray-600">Kelola aturan sistem pakar untuk diagnosa penyakit THT</p>
</div>

<div class="mb-4">

    <label class="block text-sm font-medium text-gray-700 mb-1">

        Cari Aturan

    </label>

    <input
        id="searchAturan"
        type="text"
        placeholder="Cari kode, penyakit, gejala..."
        class="border rounded-lg px-4 py-2 w-72">

</div>

<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-4 border-b flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">

    <h2 class="text-lg font-semibold text-gray-800">
        Daftar Aturan
    </h2>

    <button
        id="tambah-aturan-btn"
        class="btn-primary px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm flex items-center justify-center gap-2 w-full sm:w-auto">

        <i class="fas fa-plus"></i>

        Tambah Aturan

    </button>

</div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Aturan</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyakit</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gejala</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="aturan-table-body" class="bg-white divide-y divide-gray-200">
                    <!-- Data aturan akan dimuat oleh JavaScript -->
                </tbody>
            </table>
        </div>
        <div id="rule-pagination" class="flex justify-center items-center gap-2 py-6">
        </div>
    </div>
</div>

<!-- Modal Form Aturan -->
<div id="aturan-modal" class="modal">
    <div class="modal-content bg-white rounded-2xl w-[95%] sm:w-full max-w-3xl">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800" id="aturan-modal-title">Tambah Aturan</h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal" data-modal="aturan-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4">
            <form id="aturan-form">
                <input type="hidden" id="aturan-id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Aturan</label>
                    <input type="text" id="aturan-kode" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penyakit</label>
                    <select id="aturan-penyakit" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                        <option value="">Pilih Penyakit</option>
                        <!-- Akan diisi JavaScript -->
                    </select>
                </div>
                <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Nilai Certainty Factor (CF Pakar)
    </label>


</div>
<div id="gejala-container" class="space-y-3"></div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-200 px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm hover:bg-gray-300 close-modal" data-modal="aturan-modal">Batal</button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Aturan -->
<div id="detail-modal" class="modal">
    <div class="modal-content bg-white rounded-2xl w-[95%] sm:w-full max-w-3xl">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800" id="detail-modal-title">Detail Aturan</h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal" data-modal="detail-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4" id="detail-content"></div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="delete-modal" class="modal">
    <div class="modal-content max-w-md">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal" data-modal="delete-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4">
            <p class="text-gray-700 mb-4" id="delete-message">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-end space-x-3">
                <button type="button" class="bg-gray-200 px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm hover:bg-gray-300 close-modal" data-modal="delete-modal">Batal</button>
                <button type="button" class="bg-red-600 px-4 py-2 rounded-md font-medium text-white shadow-sm hover:bg-red-700" id="confirm-delete">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

    let currentPageRule = 1;
    const rowsPerPageRule = 5;

    // Data contoh untuk simulasi
    let aturanData = @json($aturan);
    console.log('ATURAN:', aturanData);

    let penyakitList = @json($penyakit);
    console.log('PENYAKIT:', penyakitList);

    let gejalaList = @json($gejala);
    console.log('GEJALA:', gejalaList);

    let currentEditId = null;
    let currentDeleteId = null;
    let currentDeleteType = 'aturan';
    let filteredData = [...aturanData];

    function loadAturanData() {
        const tbody = document.getElementById('aturan-table-body');
        tbody.innerHTML = '';
        const start =
        (currentPageRule-1)*rowsPerPageRule;

        const end =
        start+rowsPerPageRule;

        filteredData
        .slice(start, end)
        .forEach(a => {

    const row = document.createElement('tr');

    row.innerHTML = `
        <td class="px-4 py-4 text-sm font-medium">
            ${a.kode}
        </td>

        <td class="px-4 py-4 text-sm">
            ${a.penyakit}
        </td>

        <td class="px-4 py-4 text-sm">
            ${a.gejala.length} Gejala
        </td>

        <td class="px-4 py-4 whitespace-nowrap">

    <div class="flex items-center justify-center gap-2">

        <button
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition edit-aturan"
            data-id="${a.id}"
            title="Edit">

            <i class="fas fa-pen"></i>

        </button>

        <button
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition delete-aturan"
            data-id="${a.id}"
            title="Hapus">

            <i class="fas fa-trash"></i>

        </button>

        <button
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition detail-aturan"
            data-id="${a.id}"
            title="Detail">

            <i class="fas fa-eye"></i>

        </button>

    </div>

</td>
    `;

    tbody.appendChild(row);
});

        document.querySelectorAll('.edit-aturan').forEach(btn => {
            btn.addEventListener('click', () => editAturan(parseInt(btn.dataset.id)));
        });
        document.querySelectorAll('.delete-aturan').forEach(btn => {
            btn.addEventListener('click', () => {
                const kode = aturanData.find(a => a.id === parseInt(btn.dataset.id)).kode;
                confirmDelete(btn.dataset.id, `Aturan "${kode}"`);
            });
        });
        document.querySelectorAll('.detail-aturan').forEach(btn => {
            btn.addEventListener('click', () => showDetail(parseInt(btn.dataset.id)));
        });

        renderPagination();
    }

function renderPagination(){

    const totalPages =
        Math.ceil(filteredData.length / rowsPerPageRule);

    const pagination =
        document.getElementById('rule-pagination');

    pagination.innerHTML='';

    // Previous
    const prev=document.createElement('button');
    prev.innerHTML='&laquo;';
    prev.className='px-3 py-2 rounded bg-gray-200 hover:bg-gray-300';
    prev.disabled=currentPageRule===1;

    prev.onclick=()=>{
        currentPageRule--;
        loadAturanData();
    };

    pagination.appendChild(prev);

    for(let i=1;i<=totalPages;i++){

        const btn=document.createElement('button');

        btn.textContent=i;

        btn.className=
        `px-4 py-2 rounded ${
            currentPageRule===i
            ?'bg-green-600 text-white'
            :'bg-gray-100 hover:bg-gray-200'
        }`;

        btn.onclick=()=>{
            currentPageRule=i;
            loadAturanData();
        };

        pagination.appendChild(btn);
    }

    const next=document.createElement('button');

    next.innerHTML='&raquo;';
    next.className='px-3 py-2 rounded bg-gray-200 hover:bg-gray-300';
    next.disabled=currentPageRule===totalPages;

    next.onclick=()=>{
        currentPageRule++;
        loadAturanData();
    };

    pagination.appendChild(next);

}

    function loadPenyakitOptions() {
        const select = document.getElementById('aturan-penyakit');
        select.innerHTML = '<option value="">Pilih Penyakit</option>';
        penyakitList.forEach(p => {
            const option = document.createElement('option');
            option.value = p.id;
            option.textContent = `${p.kode} - ${p.nama}`;
            select.appendChild(option);
        });
    }

    function loadGejalaOptions(selectedGejala = []) {

    const container =
        document.getElementById('gejala-container');

    container.innerHTML = '';

    gejalaList.forEach(g => {

        const data =
            selectedGejala.find(x => x.id == g.id);

        container.innerHTML += `

        <div class="border rounded-lg p-3">

            <label class="flex items-center gap-2">

                <input
                    type="checkbox"
                    class="gejala-check"
                    value="${g.id}"
                    ${data ? 'checked' : ''}>

                <span>${g.kode} - ${g.nama}</span>

            </label>

            <select
                class="cf-gejala mt-2 w-full border rounded px-3 py-2"
                data-id="${g.id}">

                ${cfOption(data ? data.cf_pakar : 1)}

            </select>

        </div>

        `;

    });

}


function cfOption(selected){

    const nilai=[
        [0,'Tidak Yakin'],
        [0.2,'Hampir Tidak Yakin'],
        [0.4,'Sedikit Yakin'],
        [0.6,'Cukup Yakin'],
        [0.8,'Yakin'],
        [1,'Sangat Yakin']
    ];

    return nilai.map(n=>`
        <option
            value="${n[0]}"
            ${selected==n[0]?'selected':''}>
            ${n[1]} (${n[0]})
        </option>
    `).join('');

}

    function editAturan(id) {

    const aturan =
        aturanData.find(a => a.id === id);

    if (!aturan) return;

    document.getElementById('aturan-modal-title')
        .textContent = 'Edit Aturan';

    document.getElementById('aturan-id').value =
        aturan.id;

    document.getElementById('aturan-kode').value =
        aturan.kode;

    document.getElementById('aturan-penyakit').value =
        aturan.penyakit_id;

    loadGejalaOptions(
        aturan.gejala
    );

    currentEditId = id;

    document
        .getElementById('aturan-modal')
        .classList.add('active');
}

    function showDetail(id)
{
    const aturan = aturanData.find(a => a.id === id);

    if (!aturan) return;

    let daftarGejala = '';

    if (aturan.gejala.length > 0) {

        aturan.gejala.forEach(g => {

            daftarGejala += `
                <tr class="border-b">
                    <td class="px-4 py-3">${g.kode}</td>
                    <td class="px-4 py-3">${g.nama}</td>
                    <td class="px-4 py-3 text-center">
                        ${g.cf_pakar}
                    </td>
                </tr>
            `;

        });

    } else {

        daftarGejala = `
            <tr>
                <td colspan="3" class="text-center py-4 text-gray-500">
                    Tidak ada gejala
                </td>
            </tr>
        `;

    }

    document.getElementById('detail-modal-title').innerHTML =
        '<i class="fas fa-project-diagram text-green-600 mr-2"></i> Detail Aturan';

    document.getElementById('detail-content').innerHTML = `

        <div class="space-y-5">

            <div class="bg-green-50 rounded-xl p-5 border">

                <p class="text-sm text-gray-500">
                    Kode Aturan
                </p>

                <h2 class="text-2xl font-bold text-green-700">
                    ${aturan.kode}
                </h2>

                <p class="mt-2 text-gray-700">
                    Penyakit :
                    <b>${aturan.penyakit}</b>
                </p>

            </div>

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="px-5 py-3 border-b bg-gray-50">

                    <h3 class="font-semibold text-gray-700">
                        Daftar Gejala
                    </h3>

                </div>

                <table class="w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                Kode
                            </th>

                            <th class="px-4 py-3 text-left">
                                Nama Gejala
                            </th>

                            <th class="px-4 py-3 text-center">
                                CF Pakar
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        ${daftarGejala}

                    </tbody>

                </table>

            </div>

        </div>

    `;

    document
        .getElementById('detail-modal')
        .classList.add('active');
}

    function confirmDelete(id, message) {
        currentDeleteId = id;
        document.getElementById('delete-message').textContent = `Apakah Anda yakin ingin menghapus ${message}?`;
        document.getElementById('delete-modal').classList.add('active');
    }

    function deleteData() {

        const btnDelete =
            document.getElementById("confirm-delete");

        btnDelete.disabled = true;

        showLoading(
            "Menghapus aturan diagnosa..."
        );

    fetch(`/pakar/aturan/${currentDeleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .content
        }
    })
    .then(async res => {

    const data = await res.json();

    console.log(data);

    if(!res.ok){

        alert(JSON.stringify(data));

        return;

    }

    return data;

})
.then(data=>{

    console.log(data);

if(data.success){

    hideLoading();

    alert("Aturan berhasil dihapus.");

    location.reload();

}

})
.catch(error => {

    hideLoading();

    btnDelete.disabled = false;

    console.log(error);

});

}

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    document.getElementById('tambah-aturan-btn').addEventListener('click', () => {
        document.getElementById('aturan-modal-title').textContent = 'Tambah Aturan';
        document.getElementById('aturan-form').reset();
        document.getElementById('aturan-id').value = '';
        loadGejalaOptions([]);
        currentEditId = null;
        document.getElementById('aturan-modal').classList.add('active');
    });

document.getElementById('aturan-form').addEventListener('submit', (e) => {

    e.preventDefault();

    const id = document.getElementById('aturan-id').value;

    const btnSubmit =
        e.target.querySelector('button[type="submit"]');

    btnSubmit.disabled = true;

    showLoading(
        id
        ? "Memperbarui aturan diagnosa..."
        : "Menyimpan aturan diagnosa..."
    );

    const kode = document.getElementById('aturan-kode').value;
    const penyakit = document.getElementById('aturan-penyakit').value;

const gejala = [];

document.querySelectorAll('.gejala-check').forEach(check => {

    if (check.checked) {

        const cf = document.querySelector(
            `.cf-gejala[data-id="${check.value}"]`
        ).value;

        gejala.push({

            gejala_id: check.value,

            cf_pakar: cf

        });

    }

});

if (gejala.length < 1) {

    alert("Minimal pilih 1 gejala.");

    return;

}

console.log({
    kode,
    penyakit_id: penyakit,
    gejala
});

   if (id) {

    fetch(`/pakar/aturan/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .content
        },
        body: JSON.stringify({

        kode,

        penyakit_id: penyakit,

        gejala

})
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {

    hideLoading();

    alert('Data aturan berhasil diperbarui.');

    location.reload();

}else{

    hideLoading();

    btnSubmit.disabled = false;

}

    })
    .catch(error => {

    hideLoading();

    btnSubmit.disabled = false;

    console.log(error);

});

    return;
} else {


        fetch('/pakar/aturan/store', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .content
    },
   body: JSON.stringify({

    kode,

    penyakit_id: penyakit,

    gejala

})
})
.then(async res => {

    const data = await res.json();

    console.log("STATUS :", res.status);
    console.log("RESPONSE :", data);

    if (!res.ok) {

        alert(JSON.stringify(data));

        return;

    }

    return data;

})
.then(data => {

    if (!data) return;

if (data.success) {

    hideLoading();

    alert(
        id
        ? 'Data aturan berhasil diperbarui.'
        : 'Data aturan berhasil disimpan.'
    );

    location.reload();

}else{

    hideLoading();

    btnSubmit.disabled = false;

}

})
.catch(error => {

    hideLoading();

    btnSubmit.disabled = false;

    console.log(error);

});
    }

});

    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.dataset.modal;
            closeModal(modalId);
        });
    });

document
.getElementById('searchAturan')
.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();

    filteredData = aturanData.filter(a => {

        const gejala =
            (a.gejala || [])
            .map(g => g.nama)
            .join(' ')
            .toLowerCase();

        return (

            a.kode.toLowerCase().includes(keyword)

            ||

            a.penyakit.toLowerCase().includes(keyword)

            ||

            gejala.includes(keyword)

        );

    });

    currentPageRule = 1;

    loadAturanData();

});

document.getElementById('confirm-delete')
.addEventListener('click', deleteData);

loadPenyakitOptions();
loadGejalaOptions();
loadAturanData();
</script>
@endpush