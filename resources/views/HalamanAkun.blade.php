<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akun</title>
    <!-- Sertakan Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center h-screen bg-[#f0f4f8]" style="background-image: linear-gradient(to bottom, #2c3e50 50%, transparent 50%); font-family: Arial, sans-serif;">
    <!-- Container utama -->
    <div class="bg-white p-5 rounded-lg w-[400px] shadow-md text-center">
    <h2 class="mb-4 text-[#2c3e50]">Informasi Akun</h2>
    <input
        type="text"
        class="w-[90%] p-2.5 my-2.5 border border-gray-300 rounded text-base text-center"
        value="nathaniapemimpinhandal@gmail.com"
    >
    <input
        type="password"
        class="w-[90%] p-2.5 my-2.5 border border-gray-300 rounded text-base text-center"
        value="********"
    >
    <button id="ubahPasswordButton" class="bg-[#2c3e50] text-white px-5 py-2.5 rounded mt-2.5 hover:bg-[#34495e]">
        Ubah Password
    </button>
    </div>

    <!-- Popup untuk ubah password -->
    <div id="ubahPasswordPopup" class="hidden fixed inset-0 z-[999] bg-black/50">
    <div class="bg-white w-[300px] p-5 rounded-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
        <h3 class="text-[#2c3e50] mb-4">Ubah Password</h3>
        <label class="block text-left mt-2.5 font-bold text-[#2c3e50]">Password Lama</label>
        <input
        type="password"
        class="w-full p-2.5 my-1 border border-gray-300 rounded text-base text-center"
        value="********"
        >
        <label class="block text-left mt-2.5 font-bold text-[#2c3e50]">Password Baru</label>
        <input
        type="password"
        class="w-full p-2.5 my-1 border border-gray-300 rounded text-base text-center"
        id="newPassword"
        placeholder="Masukkan password baru"
        >
        <label class="block text-left mt-2.5 font-bold text-[#2c3e50]">Konfirmasi Password</label>
        <input
        type="password"
        class="w-full p-2.5 my-1 border border-gray-300 rounded text-base text-center"
        id="confirmPassword"
        placeholder="Konfirmasi password baru"
        >
        <button id="simpanPasswordButton" class="bg-[#2c3e50] text-white px-5 py-2.5 rounded mt-2.5 hover:bg-[#34495e]">
        Simpan
        </button>
        <button id="batalButton" class="bg-[#e74c3c] text-white px-5 py-2.5 rounded mt-2.5 hover:bg-[#c0392b]">
        Batal
        </button>
    </div>
    </div>

    <!-- JavaScript -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ubahPasswordButton = document.getElementById("ubahPasswordButton");
        const popup = document.getElementById("ubahPasswordPopup");
        const simpanPasswordButton = document.getElementById("simpanPasswordButton");
        const batalButton = document.getElementById("batalButton");

      // Tampilkan pop-up form ubah password ketika tombol "Ubah Password" ditekan
        ubahPasswordButton.addEventListener("click", function() {
        popup.classList.remove("hidden");
        });

      // Fungsi simpan password, lakukan validasi dan simulasikan penyimpanan
        simpanPasswordButton.addEventListener("click", function() {
        const newPassword = document.getElementById("newPassword").value.trim();
        const confirmPassword = document.getElementById("confirmPassword").value.trim();

        if (newPassword === "" || confirmPassword === "") {
            alert("Mohon masukkan password baru dan konfirmasi password");
            return;
        }
        if (newPassword !== confirmPassword) {
            alert("Password baru dan konfirmasi password tidak cocok!");
            return;
        }

        alert("Password berhasil diubah!");
        popup.classList.add("hidden");
        document.getElementById("newPassword").value = "";
        document.getElementById("confirmPassword").value = "";
        });

      // Tombol batal untuk menyembunyikan pop-up tanpa mengubah apa pun
        batalButton.addEventListener("click", function() {
        popup.classList.add("hidden");
        document.getElementById("newPassword").value = "";
        document.getElementById("confirmPassword").value = "";
        });
    });
    </script>
</body>
</html>