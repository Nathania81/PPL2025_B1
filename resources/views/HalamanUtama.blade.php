<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDFarm Dashboard</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- font poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-[#253a7d] text-white py-4 px-8 flex items-center fixed w-full">
        <div class="font-bold text-3xl pr-5">RDFarm</div>
        <div class="flex flex-1">
            <a href="#" class="px-5 py-4 text-white no-underline hover:bg-[#071952]/20 transition-colors duration-300 ease-in-out {{ request()->is('dashboard') ? 'text-cyan-300' : '' }}">Dashboard</a>
            <a href="#" class="px-5 py-4 text-white no-underline hover:bg-[#071952]/20 transition-colors duration-300 ease-in-out">Katalog</a>
            <a href="#" class="px-5 py-4 text-white no-underline hover:bg-[#071952]/20 transition-colors duration-300 ease-in-out">Transaksi</a>
        </div>
        <div class="flex items-center space-x-4 ml-auto">
            <button class="text-white hover:text-cyan-300 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a2 2 0 00-4 0v1.083A6 6 0 004 11v3.159c0 .538-.214 1.055-.595 1.436L2 17h5m5 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <button class="text-white hover:text-cyan-300 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.636 0 5.082.76 7.121 2.05M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Hero Section --}}
    <div class="pt-[140px] p-4 flex justify-center">
        <div class="w-full md:w-3/4 lg:w-2/3 relative rounded overflow-hidden">
            <img src="{{ asset('images/sapi.png') }}" alt="Rembangan Dairy Farm" class="w-full h-64 object-cover rounded-lg shadow-lg">
            <div class="absolute inset-0 bg-black/10 bg-opacity-40 flex flex-col justify-center items-center text-white p-6 text-center">
                <h1 class="text-2xl md:text-4xl font-bold mb-2">Rembangan Dairy Farm</h1>
                <p class="text-sm md:text-base">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae lacus lorem. Phasellus finibus, enim eget ultrices venenatis, nulla magna faucibus ex, elementum posuere diam dui tempus risus.
                    Sed congue vitae libero vitae ultrices. Aliquam vehicula mi eget tellus commodo, a porttitor lectus dictum.
                </p>
            </div>
        </div>
    </div>

</body>
</html>