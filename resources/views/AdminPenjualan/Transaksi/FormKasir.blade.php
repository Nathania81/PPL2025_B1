@extends('layouts.Admin')

@section('content')
<form action="{{ Route('KlikSimpan') }}" method="POST">
    @csrf

    <div class="p-6 bg-white rounded-xl">
        <h1 class="text-2xl font-bold mb-6">Kasir</h1>

        <div>
            <p class="mb-2 font-semibold">Nama Pelanggan</p>
            <input type="text" name="nama_pelanggan" class="border px-3 py-2 rounded w-full mb-4" placeholder="Masukkan nama pelanggan...">
        </div>

        <div id="produk-terpilih-container" class="mb-6">
            <table class="w-full text-left border-collapse" id="produk-terpilih-table">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Harga Satuan</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="produk-terpilih-body"></tbody>
            </table>
            <div class="text-right mt-2 font-semibold" id="total-harga-wrapper" style="display:none;">
                Total Semua: <span id="total-harga">Rp0</span>
            </div>
        </div>

        <button type="button" onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded mb-4 w-full">
            + Tambah Produk
        </button>

        <div class="flex justify-end">
            <button type="submit" class="flex justify-end bg-blue-600 text-white px-6 py-2 rounded shadow-md hover:bg-blue-700">
            Buat Pesanan
            </button>
        </div>
    </div>
</form>

<!-- Modal Produk -->
<div id="modalProduk" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded w-full max-w-xl">
        <h2 class="text-xl font-bold mb-4">Pilih Produk</h2>
        <form id="formProduk">
            <div class="space-y-2 max-h-64 overflow-y-auto">
                @foreach($katalogs as $katalog)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="produk[]" value="{{ $katalog->id }}"
                            data-nama="{{ $katalog->nama_produk }}"
                            data-harga="{{ $katalog->harga }}">
                        <span>{{ $katalog->nama_produk }} - Rp{{ number_format($katalog->harga, 0, ',', '.') }}</span>
                    </label>
                @endforeach
            </div>
            <div class="mt-4 text-right">
                <button type="button" onclick="tutupModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="button" onclick="simpanProduk()" class="px-4 py-2 bg-blue-600 text-white rounded">OK</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalProduk').classList.remove('hidden');
    }

    function tutupModal() {
        document.getElementById('modalProduk').classList.add('hidden');
    }

    function simpanProduk() {
        const checkboxes = document.querySelectorAll('#formProduk input[name="produk[]"]:checked');
        const tbody = document.getElementById('produk-terpilih-body');
        const table = document.getElementById('produk-terpilih-table');
        const totalWrapper = document.getElementById('total-harga-wrapper');

        checkboxes.forEach(cb => {
            if (document.getElementById('row-' + cb.value)) return;

            const id = cb.value;
            const nama = cb.dataset.nama;
            const harga = parseInt(cb.dataset.harga);

            const row = document.createElement('tr');
            row.id = 'row-' + id;

            row.innerHTML = `
                <td class="px-4 py-2">${nama}
                    <input type="hidden" name="produk_terpilih[]" value="${id}">
                </td>
                <td class="px-4 py-2">Rp${harga.toLocaleString('id-ID')}</td>
                <td class="px-4 py-2 flex items-center gap-1">
                    <button type="button" onclick="ubahJumlah(${id}, -1, ${harga})"
                        class="bg-gray-300 px-2 py-1 rounded">-</button>
                    <input type="number" name="jumlah_produk[${id}]" id="jumlah-${id}" value="1"
                        min="1" class="w-12 text-center border rounded">
                    <button type="button" onclick="ubahJumlah(${id}, 1, ${harga})"
                        class="bg-gray-300 px-2 py-1 rounded">+</button>
                </td>
                <td class="px-4 py-2">
                    <span id="label-harga-${id}">Rp${harga.toLocaleString('id-ID')}</span>
                    <input type="hidden" name="harga_total[${id}]" id="harga-${id}" value="${harga}">
                </td>
                <td class="px-4 py-2 text-center">
                    <button type="button" onclick="hapusProduk(${id})" class="text-red-600 hover:text-red-800">
                        🗑️
                    </button>
                </td>
            `;

            tbody.appendChild(row);
        });

        if (tbody.children.length > 0) {
            table.classList.remove('hidden');
            totalWrapper.style.display = 'block';
        }

        updateTotalHargaKeseluruhan();
        tutupModal();
    }

    function ubahJumlah(id, delta, hargaSatuan) {
        const jumlahInput = document.getElementById('jumlah-' + id);
        let jumlah = parseInt(jumlahInput.value);
        jumlah = Math.max(1, jumlah + delta);
        jumlahInput.value = jumlah;

        const totalHarga = jumlah * hargaSatuan;
        document.getElementById('harga-' + id).value = totalHarga;
        document.getElementById('label-harga-' + id).textContent = 'Rp' + totalHarga.toLocaleString('id-ID');

        updateTotalHargaKeseluruhan();
    }

    function hapusProduk(id) {
        const row = document.getElementById('row-' + id);
        if (row) {
            row.remove();
            updateTotalHargaKeseluruhan();

            const tbody = document.getElementById('produk-terpilih-body');
            const totalWrapper = document.getElementById('total-harga-wrapper');
            if (tbody.children.length === 0) {
                totalWrapper.style.display = 'none';
            }
        }
    }

    function updateTotalHargaKeseluruhan() {
        const hargaInputs = document.querySelectorAll('input[id^="harga-"]');
        let total = 0;

        hargaInputs.forEach(input => {
            total += parseInt(input.value);
        });

        document.getElementById('total-harga').textContent = 'Rp' + total.toLocaleString('id-ID');
    }
</script>
@endsection
