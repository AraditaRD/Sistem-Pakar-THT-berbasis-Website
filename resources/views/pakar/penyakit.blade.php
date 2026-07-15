@extends('layouts.pakar')

@section('title', 'Data Penyakit')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Penyakit</h1>
    <p class="text-gray-600">Kelola data penyakit THT dalam sistem</p>
</div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Penyakit</label>
                    <input
                        id="searchPenyakit"
                        type="text"
                        placeholder="Cari penyakit..."
                        class="border rounded-lg px-4 py-2">
                </div>

<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Penyakit</h2>
        <button id="tambah-penyakit-btn" class="btn-primary px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm flex items-center gap-2">
            <i class="fas fa-plus mr-2"></i> Tambah Penyakit
        </button>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penyakit</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyebab</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pencegahan</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Solusi</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="penyakit-table-body" class="bg-white divide-y divide-gray-200">
                    <!-- Data penyakit akan dimuat oleh JavaScript -->
                </tbody>
            </table>

            <div
                id="pagination"
                class="flex justify-center items-center gap-2 py-6">
            </div>

        </div>
    </div>

</div>

<!-- Modal Form Penyakit -->
<div id="penyakit-modal" class="modal">
    <div class="modal-content bg-white rounded-2xl w-[95%] sm:w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-800" id="penyakit-modal-title">Tambah Penyakit</h3>
            <button class="close-modal text-gray-500 hover:text-gray-700"
                data-modal="penyakit-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-5">
            <form id="penyakit-form">
                <input type="hidden" id="penyakit-id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Penyakit</label>
                    <input type="text" id="penyakit-kode" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penyakit</label>
                    <input type="text" id="penyakit-nama" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="penyakit-deskripsi" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" rows="3" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penyebab</label>
                    <textarea id="penyakit-penyebab" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" rows="3" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pencegahan</label>
                    <textarea id="penyakit-pencegahan" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" rows="3" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Solusi</label>
                    <textarea id="penyakit-solusi" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" rows="3" required></textarea>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-200 px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm hover:bg-gray-300 close-modal" data-modal="penyakit-modal">Batal</button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Penyakit -->
<div id="detail-modal" class="modal">
    <div class="modal-content bg-white rounded-2xl w-[95%] sm:w-full max-w-lg">
        <div class="flex justify-between items-center p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-800" id="detail-modal-title">Detail Penyakit</h3>
            <button class="close-modal text-gray-500 hover:text-gray-700"
                data-modal="detail-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-5" id="detail-content"></div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="delete-modal" class="modal">
    <div class="modal-content bg-white rounded-2xl w-[95%] sm:w-full max-w-md">
        <div class="flex justify-between items-center p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h3>
            <button class="close-modal text-gray-500 hover:text-gray-700"
                data-modal="delete-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-5">
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
    let currentPage = 1;
    const rowsPerPage = 5;

    let penyakitData = @json($penyakit ?? []);

    let currentEditId = null;
    let currentDeleteId = null;
    let currentDeleteType = 'penyakit';
    let filteredData = [...penyakitData];

    function truncate(text, length = 45){

    if(!text) return '-';

    return text.length > length
        ? text.substring(0, length) + '...'
        : text;

}

function renderPagination(){

    const totalPages =
        Math.ceil(penyakitData.length / rowsPerPage);

    const pagination =
        document.getElementById('pagination');

    pagination.innerHTML='';

    // Previous
    const prev=document.createElement('button');

    prev.innerHTML='&laquo;';

    prev.className=
    'px-3 py-2 rounded bg-gray-200 hover:bg-gray-300';

    prev.disabled=currentPage===1;

    prev.onclick=()=>{

        currentPage--;

        loadPenyakitData();

    };

    pagination.appendChild(prev);

    // Nomor halaman
    for(let i=1;i<=totalPages;i++){

        const btn=document.createElement('button');

        btn.textContent=i;

        btn.className=
        `px-4 py-2 rounded ${
            currentPage===i
            ?'bg-green-600 text-white'
            :'bg-gray-100 hover:bg-gray-200'
        }`;

        btn.onclick=()=>{

            currentPage=i;

            loadPenyakitData();

        };

        pagination.appendChild(btn);

    }

    // Next
    const next=document.createElement('button');

    next.innerHTML='&raquo;';

    next.className=
    'px-3 py-2 rounded bg-gray-200 hover:bg-gray-300';

    next.disabled=currentPage===totalPages;

    next.onclick=()=>{

        currentPage++;

        loadPenyakitData();

    };

    pagination.appendChild(next);

}

    function loadPenyakitData() {
        const tbody = document.getElementById('penyakit-table-body');
        tbody.innerHTML = '';

        const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            filteredData
                .slice(start, end)
                .forEach(p => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${p.kode}</td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${p.nama}</td>
                <td class="px-4 py-4 text-sm text-gray-500">${truncate(p.deskripsi)}</td>
                <td class="px-4 py-4 text-sm text-gray-500">${truncate(p.penyebab)}</td>
                <td class="px-4 py-4 text-sm text-gray-500">${truncate(p.pencegahan)}</td>
                <td class="px-4 py-4 text-sm text-gray-500">${truncate(p.solusi)}</td>


                <td class="px-4 py-4 whitespace-nowrap">

            <div class="flex items-center justify-center gap-2">

                <button
                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition edit-penyakit"
                    data-id="${p.id}"
                    title="Edit">

                        <i class="fas fa-pen"></i>

                    </button>

                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition delete-penyakit"
                        data-id="${p.id}"
                        title="Hapus">

                        <i class="fas fa-trash"></i>

                    </button>

                        <button
                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition detail-penyakit"
                            data-id="${p.id}"
                            title="Detail">

                            <i class="fas fa-eye"></i>

                        </button>

    </div>

</td>
            `;
            tbody.appendChild(row);
        });

        document.querySelectorAll('.edit-penyakit').forEach(btn => {
            btn.addEventListener('click', () => editPenyakit(parseInt(btn.dataset.id)));
        });
        document.querySelectorAll('.delete-penyakit').forEach(btn => {
            btn.addEventListener('click', () => {
                const nama = penyakitData.find(p => p.id === parseInt(btn.dataset.id)).nama;
                confirmDelete(btn.dataset.id, `Penyakit "${nama}"`);
            });
        });
        document.querySelectorAll('.detail-penyakit').forEach(btn => {
            btn.addEventListener('click', () => showDetail(parseInt(btn.dataset.id)));
        });

        renderPagination();

    }

    function editPenyakit(id) {
        const p = penyakitData.find(p => p.id === id);
        if (!p) return;
        document.getElementById('penyakit-modal-title').textContent = 'Edit Penyakit';
        document.getElementById('penyakit-id').value = p.id;
        document.getElementById('penyakit-kode').value = p.kode;
        document.getElementById('penyakit-nama').value = p.nama;
        document.getElementById('penyakit-deskripsi').value = p.deskripsi;
        document.getElementById('penyakit-penyebab').value = p.penyebab;
        document.getElementById('penyakit-pencegahan').value = p.pencegahan;
        document.getElementById('penyakit-solusi').value = p.solusi;
        currentEditId = id;
        document.getElementById('penyakit-modal').classList.add('active');
    }

    function showDetail(id)
{
    const p = penyakitData.find(x => x.id === id);

    if(!p) return;

    document.getElementById('detail-modal-title').innerHTML =
        '<i class="fas fa-notes-medical text-green-600 mr-2"></i> Detail Penyakit';

    document.getElementById('detail-content').innerHTML = `

        <div class="space-y-6">

            <div class="bg-green-50 border border-green-100 rounded-xl p-6">

                <p class="text-sm text-green-600 font-semibold">
                    ${p.kode}
                </p>

                <h2 class="text-3xl font-bold text-gray-800 mt-2">
                    ${p.nama}
                </h2>

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div class="bg-gray-50 rounded-xl p-5">

                    <h3 class="font-bold text-blue-700 mb-3">
                        <i class="fas fa-book-medical mr-2"></i>
                        Deskripsi
                    </h3>

                    <p class="text-gray-700 leading-7">
                        ${p.deskripsi}
                    </p>

                </div>

                <div class="bg-gray-50 rounded-xl p-5">

                    <h3 class="font-bold text-red-600 mb-3">
                        <i class="fas fa-virus mr-2"></i>
                        Penyebab
                    </h3>

                    <p class="text-gray-700 leading-7">
                        ${p.penyebab}
                    </p>

                </div>

            </div>

            <div class="bg-blue-50 rounded-xl p-6">

                <h3 class="font-bold text-blue-700 mb-3">

                    <i class="fas fa-shield-alt mr-2"></i>

                    Pencegahan

                </h3>

                <p class="text-gray-700 leading-7">
                    ${p.pencegahan}
                </p>

            </div>

            <div class="bg-green-50 rounded-xl p-6">

                <h3 class="font-bold text-green-700 mb-3">

                    <i class="fas fa-hand-holding-medical mr-2"></i>

                    Solusi

                </h3>

                <p class="text-gray-700 leading-7">
                    ${p.solusi}
                </p>

            </div>

        </div>

    `;

    document.getElementById('detail-modal').classList.add('active');
}

    function confirmDelete(id, message) {
        currentDeleteId = id;
        document.getElementById('delete-message').textContent = `Apakah Anda yakin ingin menghapus ${message}?`;
        document.getElementById('delete-modal').classList.add('active');
    }

    async function deleteData() {

    if (!currentDeleteId) return;

        const btnDelete =
        document.getElementById("confirm-delete");

        btnDelete.disabled = true;

        showLoading("Menghapus data penyakit...");

    try {

        const response = await fetch(
            `/pakar/penyakit/${currentDeleteId}`,
            {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN':
                        document.querySelector('meta[name="csrf-token"]').content
                }
            }
        );

        const result = await response.json();

        if (result.success) {

        hideLoading();

        alert("Data penyakit berhasil dihapus.");

        location.reload();

    }

    } catch (error) {

    hideLoading();

    btnDelete.disabled = false;

    console.error(error);

    alert("Gagal menghapus data.");

}
}

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    document.getElementById('tambah-penyakit-btn').addEventListener('click', () => {
        document.getElementById('penyakit-modal-title').textContent = 'Tambah Penyakit';
        document.getElementById('penyakit-form').reset();
        document.getElementById('penyakit-id').value = '';
        currentEditId = null;
        document.getElementById('penyakit-modal').classList.add('active');
    });

    document.getElementById('penyakit-form').addEventListener('submit', async (e) => {

    e.preventDefault();

    const id = document.getElementById('penyakit-id').value;

    // tombol simpan
    const btnSubmit =
        e.target.querySelector('button[type="submit"]');

    btnSubmit.disabled = true;

    showLoading(
        id
        ? "Memperbarui data penyakit..."
        : "Menyimpan data penyakit..."
    );

    const data = {
        kode: document.getElementById('penyakit-kode').value,
        nama: document.getElementById('penyakit-nama').value,
        deskripsi: document.getElementById('penyakit-deskripsi').value,
        penyebab: document.getElementById('penyakit-penyebab').value,
        pencegahan: document.getElementById('penyakit-pencegahan').value,
        solusi: document.getElementById('penyakit-solusi').value
    };

    try {

        let response;

        if (id) {

            response = await fetch(`/pakar/penyakit/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN':
                        document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

        } else {

            response = await fetch(`/pakar/penyakit/store`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN':
                        document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

        }

        const result = await response.json();

        if (result.success) {

                hideLoading();

                alert(
                    id
                    ? "Data penyakit berhasil diperbarui."
                    : "Data penyakit berhasil ditambahkan."
                );

                location.reload();

            }else{

                hideLoading();

                btnSubmit.disabled = false;

                alert("Gagal menyimpan data.");

            }

    } catch (error) {

    hideLoading();

    btnSubmit.disabled = false;

    console.error(error);

    alert("Terjadi kesalahan.");

}
});

    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.dataset.modal;
            closeModal(modalId);
        });
    });

    document.getElementById('confirm-delete').addEventListener('click', deleteData);

 document
.getElementById('searchPenyakit')
.addEventListener('keyup',function(){

    const keyword =
        this.value.toLowerCase();

    filteredData =
        penyakitData.filter(p=>{

            return (

                p.kode.toLowerCase().includes(keyword)

                ||

                p.nama.toLowerCase().includes(keyword)

            );

        });

    currentPage=1;

    loadPenyakitData();

});

    loadPenyakitData();
</script>
@endpush