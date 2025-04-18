<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KatalogCust</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- font poppins -->
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
    <!-- NAV BAR -->
    <header class="bg-primary text-white py-4 px-8 flex items-center fixed w-full">
        <div class="font-bold text-3xl pr-5">RDFarm</div>
        <nav class="flex">
            <a href="" class="px-5 py-4 text-white no-underline hover:bg-secondary/20 transition-colors duration-300 ease-in-out">Dashboard</a>
            <a href="" class="px-5 py-4 text-white no-underline hover:bg-secondary/20 transition-colors duration-300 ease-in-out">Katalog</a>
            <a href="" class="px-5 py-4 text-white no-underline hover:bg-secondary/20 transition-colors duration-300 ease-in-out">Stok susu</a>
            <a href="" class="px-5 py-4 text-white no-underline hover:bg-secondary/20 transition-colors duration-300 ease-in-out">Transaksi</a>
            <a href="" class="px-5 py-4 text-white no-underline hover:bg-secondary/20 transition-colors duration-300 ease-in-out">Laporan</a>
        </nav>
        <div class="ml-auto">
            <a href="" class="hover:opacity-80 transition-opacity duration-300 ease-in-out"><img src="Gambar_Katalog/account_circle.png" alt="Profile"></a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main>
        <div class="pt-[140px] text-center">
            <h1 class="text-4xl font-bold">Katalog Produk</h1>
        </div>

        <div class="flex flex-wrap px-[190px] pb-[120px]">
            <!-- Example Product -->
            <div class="bg-white max-w-[200px] rounded-2xl p-3 mx-[30px] my-[30px] text-center cursor-pointer 
                        border-2 border-transparent transition-shadow-border duration-300 ease-in-out
                        hover:border-secondary hover:shadow-lg" 
                onclick="editProduct('Susu Sapi Rasa Ori', '12.000')">
                <img src="Gambar_Katalog/download (13)-Photoroom 1.png" alt="Susu Sapi Rasa Ori" class="max-w-[400px] transition-transform duration-300 hover:scale-[1.02]">
                <p class="text-secondary font-medium mt-2">Susu Sapi Rasa Ori</p>
                <p class="text-accent font-medium">RP 12.000</p>
            </div>
            <div class="bg-white max-w-[200px] rounded-2xl p-3 mx-[30px] my-[30px] text-center cursor-pointer 
                        border-2 border-transparent transition-shadow-border duration-300 ease-in-out
                        hover:border-secondary hover:shadow-lg" 
                onclick="editProduct('Susu Sapi Rasa Coklat', '12.000')">
                <img src="Gambar_Katalog/download (13)-Photoroom 1.png" alt="Susu Sapi Rasa Coklat" class="max-w-[400px] transition-transform duration-300 hover:scale-[1.02]">
                <p class="text-secondary font-medium mt-2">Susu Sapi Rasa Coklat</p>
                <p class="text-accent font-medium">RP 12.000</p>
            </div>
            <!-- Repeat for other products -->
            <!-- ... -->
        </div>

        <div class="relative">
            <button class="bg-secondary text-white py-6 px-6 rounded-xl fixed bottom-10 right-[225px] 
                        transition-all duration-300 ease-in-out
                        hover:bg-secondary/90 hover:shadow-lg
                        focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-opacity-50" 
                    onclick="redirectToAddForm()">+ Keranjang</button>
        </div>
    </main>

    <script>
        function editProduct(name, price) {
            // Your edit product function implementation
            console.log(`Editing product: ${name}, Price: ${price}`);
        }
        
        function redirectToAddForm() {
            // Your redirect function implementation
            console.log("Redirecting to add form");
        }
    </script>
</body>

</html>