@extends('layouts.Customer')

@section('content')

    <div class="container mx-auto px-4 py-8">
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800">Katalog Produk</h1>

        <form action="{{ route('KlikBeliSekarang') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($katalogs as $katalog)
                    <div class="border rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow duration-300 bg-white">
                        <div class="h-40 bg-gray-100 rounded-md mb-4 flex items-center justify-center">
                            <!-- Placeholder for product image -->
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-lg text-gray-800 mb-1">{{ $katalog->nama_produk }}</h2>
                        <p class="text-blue-600 font-medium mb-3">Rp{{ number_format($katalog->harga, 0, ',', '.') }}</p>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="katalog[]" value="{{ $katalog->id }}"
                                   class="rounded text-blue-600 focus:ring-blue-500 h-5 w-5">
                            <span class="ml-3 text-gray-700">Pilih Produk Ini</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 sticky bottom-4 z-10 flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Beli Sekarang
                </button>
            </div>
        </form>
    </div>
@endsection
