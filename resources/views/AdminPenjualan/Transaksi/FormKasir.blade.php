@extends('layouts.Admin')

@section('content')
    <form action="{{Route('KlikSimpan')}}" method="POST">
         @csrf

        <div>
            <h1>Kasir</h1>
            <div>
                <p>Nama Pelanggan</p>
                <div>
                    isi profil
                </div>
                {{-- <select name="katalog_id" id="katalog">
                    @foreach($katalogs as $katalog)
                        <option value="{{ $katalog->id }}">{{ $katalog->nama_produk }}</option>
                    @endforeach
                </select> --}}

                <div id="produk-terpilih" class="mt-4 space-y-2"></div>

                <button type="button" onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded">
                    + tambah produk
                </button>

                <button>Buat Pesanan</button>
            </div>
        </div>
    </form>

        <!-- Modal -->
    <div id="modalProduk" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded w-1/2">
            <h2 class="text-lg font-bold mb-4">Pilih Produk</h2>
            <form id="formProduk">
                <div class="space-y-2 max-h-64 overflow-y-auto">
                    @foreach($katalogs as $katalog)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="produk[]" value="{{ $katalog->id }}" data-nama="{{ $katalog->nama_produk }} {{$katalog->harga}}">
                            <span>{{ $katalog->nama_produk}} {{$katalog->harga}}</span>
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
            const container = document.getElementById('produk-terpilih');

            checkboxes.forEach(cb => {
                // Cek apakah sudah ditambahkan sebelumnya
                if (document.getElementById('produk-' + cb.value)) return;

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'produk_terpilih[]';
                input.value = cb.value;

                const div = document.createElement('div');
                div.id = 'produk-' + cb.value;
                div.className = 'border px-3 py-2 rounded bg-gray-100 flex justify-between items-center';
                div.innerHTML = `<span>${cb.dataset.nama}</span>`;
                div.appendChild(input);

                container.appendChild(div);
            });

            tutupModal();
        }
    </script>


@endsection
