<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyan-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">Login</h1>
        <p class="text-gray-500 mb-6 text-center">
            Masukkan <span class="font-bold text-gray-800">email</span> dan <span class="font-bold text-gray-800">password</span> untuk login
        </p>
        
        <form id="form" method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Masukkan email" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="show-password" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="show-password" class="ml-2 text-gray-700">Tampilkan Password</label>
                </div>
                <a href="#" class="text-blue-500 hover:text-blue-700 hover:underline">Lupa kata sandi?</a>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Masuk
            </button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi toggle password
            const passwordInput = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("show-password");
            showPasswordCheckbox.addEventListener("change", function() {
                passwordInput.type = this.checked ? "text" : "password";
            });

            // Proses dan validasi login form
            const loginForm = document.getElementById("form");
            loginForm.addEventListener("submit", function(event) {
                event.preventDefault(); // Mencegah submit bawaan form

                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;

                // Validasi sederhana: pastikan kedua field terisi
                if (email.trim() === "" || password.trim() === "") {
                    alert("Mohon masukkan email dan password Anda.");
                    return;
                }

                // Di sini Anda dapat menambahkan logika autentikasi, misalnya mengirim data ke server menggunakan AJAX
                console.log("Email:", email);
                console.log("Password:", password);

                // Simulasi login berhasil
                alert("Login berhasil!");
                
                Redirect ke halaman dashboard (jika diperlukan)
                window.location.href = "welcome.blade.php"; // Ganti dengan URL dashboard Anda
            });
        });
    </script>
</body>

</html>