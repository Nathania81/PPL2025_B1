<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin RDFarm - @yield('title')</title>
    
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
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white py-4 px-8 flex items-center fixed w-full z-50">
        <div class="font-bold text-3xl pr-5">RDFarm</div>
        <nav class="flex">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
                class="px-5 py-4 hover:bg-secondary/20 transition duration-300 {{ request()->routeIs('dashboard') ? 'bg-secondary/20' : '' }}">
                Dashboard
            </a>
            
            <!-- Katalog Admin -->
            <a href="{{ route('katalog.index') }}" 
                class="px-5 py-4 hover:bg-secondary/20 transition duration-300 {{ request()->routeIs('katalog.*') ? 'bg-secondary/20' : '' }}">
                Katalog
            </a>
            
        </nav>
        <div class="ml-auto">
            <a href="#" class="hover:opacity-80 transition duration-300">
                <img src="{{ asset('Gambar_Katalog/account_circle.png') }}" alt="Profile" class="w-8 h-8">
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-[100px]">
        @yield('content')
    </main>

    <!-- Modal Structure -->
    <div id="modalDetail" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center" style="display: none;">
        <!-- Modal content will be loaded dynamically -->
    </div>

    <!-- Confirm Popup -->
    <div id="confirmPopup" class="fixed inset-0 hidden justify-center items-center bg-black bg-opacity-40 z-50">
        <!-- Popup content will be loaded dynamically -->
    </div>

    @stack('scripts')
</body>
</html>