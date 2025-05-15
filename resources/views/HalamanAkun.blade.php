<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akun</title>
    <!-- Sertakan Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Sertakan Axios untuk HTTP requests -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="flex justify-center items-center h-screen bg-[#f0f4f8]" style="background-image: linear-gradient(to bottom, #2c3e50 50%, transparent 50%); font-family: Arial, sans-serif;">
    <!-- Container utama -->
    <div class="bg-white p-5 rounded-lg w-[400px] shadow-md text-center">
        <h2 class="mb-4 text-[#2c3e50] font-bold text-xl">Informasi Akun</h2>
        
        <!-- Informasi User -->
        <div class="mb-4 text-left">
            <label class="block font-medium text-[#2c3e50]">Username</label>
            <input
                type="text"
                id="username"
                class="w-full p-2 my-2 border border-gray-300 rounded text-base"
                readonly
            >
        </div>
        
        <div class="mb-4 text-left">
            <label class="block font-medium text-[#2c3e50]">Email</label>
            <input
                type="text"
                id="email"
                class="w-full p-2 my-2 border border-gray-300 rounded text-base"
                readonly
            >
        </div>
        
        <button id="ubahPasswordButton" class="bg-[#2c3e50] text-white px-5 py-2.5 rounded mt-2.5 hover:bg-[#34495e] w-full">
            Ubah Password
        </button>
    </div>

    <!-- Popup untuk ubah password -->
    <div id="ubahPasswordPopup" class="hidden fixed inset-0 z-[999] bg-black/50 flex items-center justify-center">
        <div class="bg-white w-[300px] p-5 rounded-lg text-center">
            <h3 class="text-[#2c3e50] mb-4 font-bold text-lg">Ubah Password</h3>
            
            <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4"></div>
            
            <div class="text-left mb-4">
                <label class="block font-medium text-[#2c3e50]">Password Lama</label>
                <input
                    type="password"
                    id="oldPassword"
                    class="w-full p-2 my-1 border border-gray-300 rounded text-base"
                    placeholder="Masukkan password lama"
                >
            </div>
            
            <div class="text-left mb-4">
                <label class="block font-medium text-[#2c3e50]">Password Baru</label>
                <input
                    type="password"
                    id="newPassword"
                    class="w-full p-2 my-1 border border-gray-300 rounded text-base"
                    placeholder="Masukkan password baru"
                >
            </div>
            
            <div class="text-left mb-4">
                <label class="block font-medium text-[#2c3e50]">Konfirmasi Password</label>
                <input
                    type="password"
                    id="confirmPassword"
                    class="w-full p-2 my-1 border border-gray-300 rounded text-base"
                    placeholder="Konfirmasi password baru"
                >
            </div>
            
            <div class="flex justify-between">
                <button id="simpanPasswordButton" class="bg-[#2c3e50] text-white px-5 py-2 rounded hover:bg-[#34495e]">
                    Simpan
                </button>
                <button id="batalButton" class="bg-[#e74c3c] text-white px-5 py-2 rounded hover:bg-[#c0392b]">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ubahPasswordButton = document.getElementById("ubahPasswordButton");
        const popup = document.getElementById("ubahPasswordPopup");
        const simpanPasswordButton = document.getElementById("simpanPasswordButton");
        const batalButton = document.getElementById("batalButton");
        const errorMessage = document.getElementById("errorMessage");

        // Load user data saat halaman dimuat
        loadUserData();

        // Tampilkan pop-up form ubah password
        ubahPasswordButton.addEventListener("click", function() {
            popup.classList.remove("hidden");
            document.getElementById("errorMessage").classList.add("hidden");
        });

        // Fungsi simpan password dengan API
        simpanPasswordButton.addEventListener("click", async function() {
            const oldPassword = document.getElementById("oldPassword").value.trim();
            const newPassword = document.getElementById("newPassword").value.trim();
            const confirmPassword = document.getElementById("confirmPassword").value.trim();

            // Validasi client-side
            if (!oldPassword || !newPassword || !confirmPassword) {
                showError("Semua field harus diisi");
                return;
            }
            
            if (newPassword !== confirmPassword) {
                showError("Password baru dan konfirmasi password tidak cocok");
                return;
            }
            
            if (newPassword.length < 8) {
                showError("Password harus minimal 8 karakter");
                return;
            }

            try {
                // Kirim request ke API
                const response = await axios.put('/api/change-password', {
                    current_password: oldPassword,
                    new_password: newPassword,
                    new_password_confirmation: confirmPassword
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                // Jika berhasil
                alert("Password berhasil diubah!");
                popup.classList.add("hidden");
                resetPasswordForm();
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        // Validasi error dari server
                        const errors = error.response.data.errors;
                        const errorText = Object.values(errors).flat().join(', ');
                        showError(errorText);
                    } else if (error.response.status === 401) {
                        showError("Password lama tidak sesuai");
                    } else {
                        showError("Terjadi kesalahan saat mengubah password");
                    }
                } else {
                    showError("Tidak dapat terhubung ke server");
                }
            }
        });

        // Tombol batal
        batalButton.addEventListener("click", function() {
            popup.classList.add("hidden");
            resetPasswordForm();
        });

        // Fungsi untuk load data user
        async function loadUserData() {
            try {
                const response = await axios.get('/api/user');
                const user = response.data;
                
                document.getElementById("username").value = user.name || '-';
                document.getElementById("email").value = user.email || '-';
            } catch (error) {
                console.error("Gagal memuat data user:", error);
            }
        }

        // Fungsi helper untuk menampilkan error
        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.classList.remove("hidden");
        }

        // Fungsi untuk reset form password
        function resetPasswordForm() {
            document.getElementById("oldPassword").value = "";
            document.getElementById("newPassword").value = "";
            document.getElementById("confirmPassword").value = "";
            errorMessage.classList.add("hidden");
        }
    });
    </script>
</body>
</html>