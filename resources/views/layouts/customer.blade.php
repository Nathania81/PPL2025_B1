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
    @include('Components.NavbarCustomer')

    {{-- Main Content --}}
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

    {{-- @if (!isset($hideNavbar))
        @include('partials.navbar')
    @endif --}}

</body>
</html>
