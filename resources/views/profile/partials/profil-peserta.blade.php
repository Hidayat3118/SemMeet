@php
    $user = Auth::user();
@endphp

<div class="mx-auto mt-10 bg-white rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-2">Profil Pengguna</h2>
    <p class="text-gray-600 mb-6 text-sm">Edit Profil Anda sesuai dengan yang anda inginkan</p>

    <form action="#" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf

      
            <div class="w-full max-w-sm bg-white p-6 rounded-2xl text-center">
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <img id="preview" src="https://via.placeholder.com/150" alt="Foto Profil"
                        class="w-full h-full object-cover rounded-full border-2 border-blue-400 transition duration-300 ease-in-out">
                    <label for="profilePhoto"
                        class="absolute bottom-0 right-0 bg-blue-400 hover:bg-blue-400 p-2 rounded-full text-white cursor-pointer transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                        </svg>
                    </label>
                </div>
                <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" class="hidden"
                    onchange="previewImage(event)">
                <h2 class="text-lg font-semibold text-gray-700">Upload Foto Profil</h2>
                <p class="text-sm text-gray-500 mb-4">Ukuran maksimal 2MB. Format: JPG, PNG.</p>
            </div>
    

        {{-- ALAMAT → hanya untuk peserta --}}
        @if ($user->hasRole('peserta'))
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" id="alamat" name="alamat"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        @endif

        {{-- INSTANSI → untuk semua --}}
        <div>
            <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
            <input type="text" id="instansi" name="instansi"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Hanya moderator dan pembicara --}}
        @if ($user->hasRole('moderator') || $user->hasRole('pembicara'))
            <div>
                <label for="pengalaman" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman</label>
                <input type="text" id="pengalaman" name="pengalaman"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                <input type="url" id="linkedin" name="linkedin"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                <textarea id="bio" name="bio" rows="4"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
        @endif

        <div>
            <button type="submit"
                class="px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none text-xs font-semibold">
                SAVE
            </button>
        </div>
    </form>

    {{-- Script untuk preview gambar --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</div>
