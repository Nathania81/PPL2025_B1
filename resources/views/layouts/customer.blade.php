<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RDFarm - Customer' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#253a7d',
                        secondary: '#071952',
                        accent: '#37B7C3',
                        lightbg: '#eaf4f8',
                    },
                    transitionProperty: {
                        'shadow-border': 'box-shadow, border-color',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eaf4f8;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="bg-[#253a7d] text-white py-4 px-8 flex items-center fixed w-full z-10">
        <div class="font-bold text-3xl pr-5">RDFarm</div>
        <div class="flex flex-1">
            <a href="/dashboard" class="px-5 py-4 text-white no-underline hover:bg-[#071952]/20 transition-colors duration-300 ease-in-out {{ request()->is('dashboard') ? 'text-cyan-300' : '' }}">Dashboard</a>
            <a href="/produk" class="px-5 py-4 text-white no-underline hover:bg-[#071952]/20 transition-colors duration-300 ease-in-out">Katalog</a>
            <a href="/pesanan" class="px-5 py-4 text-white no-underline hover:bg-[#071952]/20 transition-colors duration-300 ease-in-out">Transaksi</a>
        </div>
        <div class="flex items-center space-x-4 ml-auto">
            <button class="text-white hover:text-cyan-300 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a2 2 0 00-4 0v1.083A6 6 0 004 11v3.159c0 .538-.214 1.055-.595 1.436L2 17h5m5 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <a href="{{ route('profil.show') }}" class="text-white hover:text-cyan-300 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.636 0 5.082.76 7.121 2.05M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>
    </nav>

    <main class="pt-[140px] px-[190px] pb-[120px]">
        @yield('content')

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-3 mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
                Data Tidak Valid
            </div>
        @endif
    </main>

    @if (!isset($hideNavbar))
        @include('partials.navbar')
    @endif

</body>
</html>