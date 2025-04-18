@extends('layouts.admin')

@section('title', 'Katalog Produk')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-secondary">Katalog Produk</h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 px-8 pb-20">
        @foreach($katalog as $item)
        <div class="bg-white rounded-2xl p-4 text-center border-2 border-transparent hover:border-secondary hover:shadow-lg transition duration-300 cursor-pointer" onclick="showDetail({{ $item->id }})">
            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_produk }}" class="w-full h-40 object-contain mx-auto">
            <p class="text-secondary font-medium mt-3">{{ $item->nama_produk }}</p>
            <p class="text-accent font-medium">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
        </div>
        @endforeach

        <div onclick="window.location.href='{{ route('katalog.create') }}'" class="bg-gray-100 border-2 border-dashed border-gray-400 rounded-2xl p-4 flex items-center justify-center hover:border-secondary hover:bg-gray-200 transition duration-300 cursor-pointer">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <p class="text-gray-600 font-medium mt-2">Tambah Produk Baru</p>
            </div>
        </div>
    </div>

    <a href="{{ route('katalog.create') }}" class="fixed bottom-8 right-8 bg-secondary text-white p-4 rounded-full shadow-lg hover:bg-secondary/90 flex items-center justify-center transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        <span class="ml-2">Tambah Katalog</span>
    </a>

    @push('scripts')
    <script>
        async function showDetail(productId) {
            try {
                const response = await fetch(`/admin/katalog/${productId}/detail`);
                const item = await response.json();
                
                const modal = document.getElementById('modalDetail');
                modal.innerHTML = `
                    <div class="bg-white rounded-xl p-6 w-[500px] relative">
                        <button onclick="closeModal()" class="absolute top-2 right-3 text-xl font-bold">&times;</button>
                        <form id="editForm" method="POST" action="/admin/katalog/${item.id}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="${item.id}">
                            <div class="flex justify-center mb-4">
                                <img id="previewImage" src="/storage/${item.foto}" class="w-40 h-40 object-cover rounded-md" />
                            </div>
                            <input type="file" name="foto" id="fotoInput" class="hidden" onchange="previewFoto(event)">
                            <div class="grid gap-2">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" value="${item.nama_produk}" class="form-input" readonly>
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-input" readonly>${item.deskripsi}</textarea>
                                <label>Harga</label>
                                <input type="number" name="harga" value="${item.harga}" class="form-input" readonly>
                                <label>Stok</label>
                                <input type="number" name="stok" value="${item.stok}" class="form-input" readonly>
                            </div>
                            <div class="flex justify-between mt-4" id="actionButtons">
                                <button type="button" onclick="enableEdit()" class="bg-yellow-400 px-4 py-2 rounded">Ubah</button>
                                <button type="button" onclick="confirmHapus(${item.id})" class="bg-red-500 px-4 py-2 rounded text-white">Hapus</button>
                            </div>
                            <button type="submit" id="simpanBtn" class="hidden bg-green-500 text-white w-full mt-4 px-4 py-2 rounded">Simpan</button>
                        </form>
                    </div>
                `;
                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function closeModal() {
            document.getElementById('modalDetail').classList.add('hidden');
        }

        function enableEdit() {
            const form = document.getElementById('editForm');
            form.querySelectorAll('.form-input').forEach(input => input.removeAttribute('readonly'));
            form.querySelector('#fotoInput').classList.remove('hidden');
            form.querySelector('#actionButtons').classList.add('hidden');
            form.querySelector('#simpanBtn').classList.remove('hidden');
        }

        function previewFoto(event) {
            const reader = new FileReader();
            reader.onload = () => {
                document.getElementById('previewImage').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function confirmHapus(id) {
            const confirmPopup = document.getElementById('confirmPopup');
            confirmPopup.innerHTML = `
                <div class="bg-white p-6 rounded-xl text-center">
                    <p class="mb-4 font-semibold">Apakah Anda yakin ingin menghapus produk ini?</p>
                    <form id="deleteForm" method="POST" action="/admin/katalog/${id}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="closeConfirm()" class="bg-red-400 px-4 py-2 rounded mr-2">Tidak</button>
                        <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white">Ya</button>
                    </form>
                </div>
            `;
            confirmPopup.classList.remove('hidden');
        }

        function closeConfirm() {
            document.getElementById('confirmPopup').classList.add('hidden');
        }
    </script>
    @endpush
@endsection