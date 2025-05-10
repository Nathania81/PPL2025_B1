@extends('layouts.admin')

@section('content')
<h1 class="text-4xl font-bold text-center mb-10">Katalog Produk</h1>
<div class="flex flex-wrap">
    @foreach ($katalog as $product)
        <a href="{{ route('admin.katalog.edit', $product->id) }}" class="bg-white max-w-[200px] rounded-2xl p-3 mx-[30px] my-[30px] text-center cursor-pointer
                        border-2 border-transparent transition-shadow-border duration-300 ease-in-out
                        hover:border-secondary hover:shadow-lg">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-w-[400px] transition-transform duration-300 hover:scale-[1.02]">
            <p class="text-secondary font-medium mt-2">{{ $product->name }}</p>
            <p class="text-accent font-medium">RP {{ number_format($product->price, 0, ',', '.') }}</p>
        </a>
    @endforeach
</div>

<div class="relative">
    <a href="{{ route('admin.katalog.create') }}">
        <button class="bg-secondary text-white py-6 px-6 rounded-xl fixed bottom-10 right-[225px]
                    transition-all duration-300 ease-in-out
                    hover:bg-secondary/90 hover:shadow-lg">
            + Tambah Produk
        </button>
    </a>
</div>
@endsection
