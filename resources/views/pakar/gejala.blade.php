@extends('layouts.pakar')

@section('title', 'Data Gejala')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Gejala</h1>
    <p class="text-gray-600">Kelola gejala penyakit THT dalam sistem</p>
</div>

    <div class="mt-3">

        <input
            id="searchGejala"
            type="text"
            placeholder="Cari kode, nama, kategori..."
            class="border rounded-lg px-4 py-2 w-80">

    </div>

<div class="bg-white rounded-lg shadow mb-6">

    <div class="p-4 border-b flex justify-between items-center">

        <h2 class="text-lg font-semibold text-gray-800">
            Daftar Gejala
        </h2>

        <button
            id="tambah-gejala-btn"
            class="btn-primary px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm flex items-center justify-center gap-2 w-full sm:w-auto">

            <i class="fas fa-plus"></i>

            Tambah Gejala

        </button>

    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Gejala</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="gejala-table-body" class="bg-white divide-y divide-gray-200">
                    <!-- Data gejala akan dimuat oleh JavaScript -->
                </tbody>
            </table>
            <div id="pagination" class="flex justify-center items-center gap-2 mt-5"></div>
        </div>
    </div>
</div>

<!-- Modal Form Gejala -->
<div id="gejala-modal" class="modal">
    <div class="modal-content">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800" id="gejala-modal-title">Tambah Gejala</h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal" data-modal="gejala-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-5">
            <form id="gejala-form">
                <input type="hidden" id="gejala-id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Gejala</label>
                    <input type="text" id="gejala-kode" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Gejala</label>
                    <input type="text" id="gejala-nama" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="gejala-kategori" class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Telinga">Telinga</option>
                        <option value="Hidung">Hidung</option>
                        <option value="Tenggorokan">Tenggorokan</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-200 px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm hover:bg-gray-300 close-modal" data-modal="gejala-modal">Batal</button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-md font-medium text-gray-800 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Gejala -->
<div id="detail-modal" class="modal">
    <div class="modal-content bg-white rounded-2xl w-[95%] sm:w-full max-w-2xl">
        <div class="flex justify-between items-center p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-800" id="detail-modal-title">Detail</h3>
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
    // Data contoh untuk simulasi (akan diganti dengan data dari database via controller)
    let gejalaData = @json($gejala ?? []); // jika kosong, gunakan data default di bawah
    console.log(gejalaData);
    if (gejalaData.length === 0) {
        gejalaData = [
            { id: 1, kode: 'G001', nama: 'Nyeri telinga', kategori: 'Telinga' },
            { id: 2, kode: 'G002', nama: 'Telinga berdenging', kategori: 'Telinga' },
            // ... tambahkan data default lainnya
        ];
    }

    let currentEditId = null;
    let currentDeleteId = null;
    let currentDeleteType = 'gejala';
    let filteredData = [...gejalaData];
    const rowsPerPage = 5;
    let currentPage = 1;

    function loadGejalaData() {
        console.log('Jumlah data:', gejalaData.length);
        console.log(gejalaData);

        const tbody = document.getElementById('gejala-table-body');
        tbody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
const end = start + rowsPerPage;

const currentData = filteredData.slice(start, end);

currentData.forEach(g => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${g.kode}</td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${g.nama}</td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${g.kategori}</td>
<td class="px-4 py-4 whitespace-nowrap">
    <div class="flex items-center justify-center gap-2">

        <button
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition edit-gejala"
            data-id="${g.id}"
            title="Edit">

            <i class="fas fa-pen"></i>

        </button>

        <button
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition delete-gejala"
            data-id="${g.id}"
            title="Hapus">

            <i class="fas fa-trash"></i>

        </button>

        <button
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition detail-gejala"
            data-id="${g.id}"
            title="Detail">

            <i class="fas fa-eye"></i>

        </button>

    </div>
</td>
            `;
            tbody.appendChild(row);
        });

        // Pasang event listener
        document.querySelectorAll('.edit-gejala').forEach(btn => {
            btn.addEventListener('click', () => editGejala(parseInt(btn.dataset.id)));
        });
        document.querySelectorAll('.delete-gejala').forEach(btn => {
            btn.addEventListener('click', () => {
                const nama = gejalaData.find(g => g.id === parseInt(btn.dataset.id)).nama;
                confirmDelete(btn.dataset.id, `Gejala "${nama}"`);
            });
        });
        document.querySelectorAll('.detail-gejala').forEach(btn => {
            btn.addEventListener('click', () => showDetail(parseInt(btn.dataset.id)));
        });
        renderPagination();
    }

    function renderPagination() {

    const totalPages = Math.ceil(filteredData.length / rowsPerPage);

    const pagination =
        document.getElementById('pagination');

    pagination.innerHTML = '';

    // tombol sebelumnya

    const prev = document.createElement('button');

    prev.innerHTML = '&laquo;';

    prev.className =
        'px-3 py-2 rounded bg-gray-200 hover:bg-gray-300';

    prev.disabled = currentPage === 1;

    prev.onclick = () => {

        currentPage--;

        loadGejalaData();

    };

    pagination.appendChild(prev);

    // nomor halaman

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

            loadGejalaData();

        };

        pagination.appendChild(btn);

    }

    // tombol selanjutnya

    const next=document.createElement('button');

    next.innerHTML='&raquo;';

    next.className=
    'px-3 py-2 rounded bg-gray-200 hover:bg-gray-300';

    next.disabled=currentPage===totalPages;

    next.onclick=()=>{

        currentPage++;

        loadGejalaData();

    };

    pagination.appendChild(next);

}

    function editGejala(id) {
        const gejala = gejalaData.find(g => g.id === id);
        if (!gejala) return;
        document.getElementById('gejala-modal-title').textContent = 'Edit Gejala';
        document.getElementById('gejala-id').value = gejala.id;
        document.getElementById('gejala-kode').value = gejala.kode;
        document.getElementById('gejala-nama').value = gejala.nama;
        document.getElementById('gejala-kategori').value = gejala.kategori;
        currentEditId = id;
        document.getElementById('gejala-modal').classList.add('active');
    }

    function showDetail(id)
{
    const gejala = gejalaData.find(g => g.id === id);

    if(!gejala) return;

    document.getElementById('detail-modal-title').innerHTML =
        '<i class="fas fa-stethoscope text-green-600 mr-2"></i> Detail Gejala';

    document.getElementById('detail-content').innerHTML = `

        <div class="space-y-6">

            <div class="bg-green-50 border border-green-100 rounded-xl p-6">

                <p class="text-sm font-semibold text-green-600">
                    ${gejala.kode}
                </p>

                <h2 class="text-3xl font-bold text-gray-800 mt-2">
                    ${gejala.nama}
                </h2>

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div class="bg-blue-50 rounded-xl p-5">

                    <div class="flex items-center mb-3">

                        <i class="fas fa-tag text-blue-600 mr-2"></i>

                        <h3 class="font-bold text-blue-700">
                            Kategori
                        </h3>

                    </div>

                    <span class="inline-flex px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                        ${gejala.kategori}

                    </span>

                </div>

                <div class="bg-gray-50 rounded-xl p-5">

                    <div class="flex items-center mb-3">

                        <i class="fas fa-info-circle text-gray-600 mr-2"></i>

                        <h3 class="font-bold text-gray-700">
                            Informasi
                        </h3>

                    </div>

                    <p class="text-gray-600 leading-7">

                        Gejala <b>${gejala.nama}</b>
                        termasuk dalam kategori
                        <b>${gejala.kategori}</b>
                        dan digunakan sebagai acuan dalam proses diagnosis penyakit THT.

                    </p>

                </div>

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

    showLoading("Menghapus data gejala...");

    try {

        const response = await fetch(
            `/pakar/gejala/${currentDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        );

        const result = await response.json();

    if (result.success) {

        hideLoading();

        alert('Data berhasil dihapus');

        location.reload();

    }

    } catch (error) {

    console.error(error);

    alert('Gagal menghapus data');

}
}

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    // Event listeners
    document.getElementById('tambah-gejala-btn').addEventListener('click', () => {
        document.getElementById('gejala-modal-title').textContent = 'Tambah Gejala';
        document.getElementById('gejala-form').reset();
        document.getElementById('gejala-id').value = '';
        currentEditId = null;
        document.getElementById('gejala-modal').classList.add('active');
    });

document.getElementById('gejala-form').addEventListener('submit', async (e) => {

    e.preventDefault();

    const id = document.getElementById('gejala-id').value;

    const btnSubmit = e.target.querySelector('button[type="submit"]');

    btnSubmit.disabled = true;

    showLoading(
        id
        ? "Memperbarui data gejala..."
        : "Menyimpan data gejala..."
    );
    const kode = document.getElementById('gejala-kode').value;
    const nama = document.getElementById('gejala-nama').value;
    const kategori = document.getElementById('gejala-kategori').value;

    try {

        let url = '/pakar/gejala/store';
        let method = 'POST';

        if (id) {
            url = `/pakar/gejala/${id}`;
            method = 'PUT';
        }

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                kode,
                nama,
                kategori,
                deskripsi: null
            })
        });

        const result = await response.json();

            if (result.success) {

                hideLoading();

                alert(
                    id
                    ? 'Gejala berhasil diperbarui!'
                    : 'Gejala berhasil ditambahkan!'
                );

                location.reload();

            }

    } catch (error) {

    hideLoading();

    btnSubmit.disabled = false;

    console.error(error);

    alert('Terjadi kesalahan');

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
.getElementById('searchGejala')
.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();

    filteredData = gejalaData.filter(g => {

        return (

            g.kode.toLowerCase().includes(keyword)

            ||

            g.nama.toLowerCase().includes(keyword)

            ||

            g.kategori.toLowerCase().includes(keyword)

        );

    });

    currentPage = 1;

    loadGejalaData();

});

loadGejalaData();
</script>
@endpush