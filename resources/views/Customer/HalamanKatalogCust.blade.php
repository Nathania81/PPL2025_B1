@extends('layouts.customer')

@section('title', 'Katalog Produk')

@section('content')
    <div class="pt-[140px] text-center">
        <h1 class="text-4xl font-bold">Katalog Produk</h1>
    </div>

    <div class="flex flex-wrap px-[190px] pb-[120px]">
        <!-- Example Product -->
        <div class="bg-white max-w-[200px] rounded-2xl p-3 mx-[30px] my-[30px] text-center cursor-pointer 
                    border-2 border-transparent transition-shadow-border duration-300 ease-in-out
                    hover:border-secondary hover:shadow-lg" 
            onclick="editProduct('Susu Sapi Rasa Ori', '12.000')">
            <img src="{{ asset('Gambar_Katalog/download (13)-Photoroom 1.png') }}" alt="Susu Sapi Rasa Ori" class="max-w-[400px] transition-transform duration-300 hover:scale-[1.02]">
            <p class="text-secondary font-medium mt-2">Susu Sapi Rasa Ori</p>
            <p class="text-accent font-medium">RP 12.000</p>
        </div>
        <div class="bg-white max-w-[200px] rounded-2xl p-3 mx-[30px] my-[30px] text-center cursor-pointer 
                    border-2 border-transparent transition-shadow-border duration-300 ease-in-out
                    hover:border-secondary hover:shadow-lg" 
            onclick="editProduct('Susu Sapi Rasa Coklat', '12.000')">
            <img src="{{ asset('Gambar_Katalog/download (13)-Photoroom 1.png') }}" alt="Susu Sapi Rasa Coklat" class="max-w-[400px] transition-transform duration-300 hover:scale-[1.02]">
            <p class="text-secondary font-medium mt-2">Susu Sapi Rasa Coklat</p>
            <p class="text-accent font-medium">RP 12.000</p>
        </div>
        <!-- Add more products as needed -->
    </div>

    <div class="relative">
        <button class="bg-secondary text-white py-6 px-6 rounded-xl fixed bottom-10 right-[225px] 
                    transition-all duration-300 ease-in-out
                    hover:bg-secondary/90 hover:shadow-lg
                    focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-opacity-50" 
                onclick="redirectToAddForm()">+ Keranjang</button>
    </div>

    @push('scripts')
    <script>
        function editProduct(name, price) {
            // Your edit product function implementation
            console.log(`Editing product: ${name}, Price: ${price}`);
        }
        
        function redirectToAddForm() {
            // Your redirect function implementation
            console.log("Redirecting to add form");
            window.location.href = "{{ route('keranjang.create') }}";
        }
    </script>
    @endpush
@endsection