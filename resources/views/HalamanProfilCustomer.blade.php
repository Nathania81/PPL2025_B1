<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen" style="background-color: #f0f4f8; background-image: linear-gradient(to bottom, #2c3e50 50%, #f0f4f8 50%);">
    <div class="w-[600px] mt-[-100px]">
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md flex p-5">
            @csrf

            <div class="flex-1 mr-5">
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" readonly class="block w-full p-2.5 mb-4 border border-gray-300 rounded text-base" id="name">
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon) }}" readonly class="block w-full p-2.5 mb-4 border border-gray-300 rounded text-base" id="phone">
                <input type="text" name="alamat" value="{{ old('alamat', $profil->alamat) }}" readonly class="block w-full p-2.5 mb-4 border border-gray-300 rounded text-base" id="address">
            </div>

            <div class="w-[200px] flex flex-col items-center">
                <div class="mb-5">
                    <img src="{{ $profil->foto_profil ? asset('storage/' . $profil->foto_profil) : asset('default.png') }}" alt="foto profil" class="w-[150px] h-[150px] rounded-full object-cover">
                </div>
                <input type="file" name="foto_profil" class="hidden" id="fotoInput">
                <div class="flex flex-col w-full">
                    <button type="button" id="editProfile" class="p-2 bg-[#2c3e50] rounded text-white cursor-pointer my-1 text-base hover:bg-[#34495e]">
                        Ubah Profile
                    </button>
                    <a href="/HalamanAkun" class="my-1">
                        <button type="button" class="p-2 bg-[#2c3e50] rounded text-white cursor-pointer text-base hover:bg-[#34495e]">Akun</button>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nameInput = document.getElementById("name");
            const phoneInput = document.getElementById("phone");
            const addressInput = document.getElementById("address");
            const fotoInput = document.getElementById("fotoInput");
            const editButton = document.getElementById("editProfile");

            editButton.addEventListener("click", function () {
                if (nameInput.hasAttribute("readonly")) {
                    nameInput.removeAttribute("readonly");
                    phoneInput.removeAttribute("readonly");
                    addressInput.removeAttribute("readonly");
                    fotoInput.classList.remove("hidden");
                    editButton.textContent = "Simpan";
                    editButton.type = "submit";
                }
            });
        });
    </script>
</body>
</html>
