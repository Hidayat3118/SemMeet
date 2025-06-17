@php
    $user = Auth::user();
@endphp

<div class="mx-auto mt-10 bg-white rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-2">Profil Pengguna</h2>
    <p class="text-gray-600 mb-6 text-sm">Edit Profil Anda sesuai dengan yang anda inginkan</p>

    <form action="{{ route('profile.update.extended') }}" method="POST" class="space-y-6 " enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- foto profil --}}
        <div class="w-full max-w-sm p-6 rounded-2xl text-center mx-auto">
            <div class="relative w-32 h-32 mx-auto mb-4">
                @php
                    $foto = 'default.png';
                    if ($user->hasRole('peserta') && $user->peserta && $user->peserta->foto) {
                        $foto = $user->peserta->foto;
                    } elseif ($user->hasRole('pembicara') && $user->pembicara && $user->pembicara->foto) {
                        $foto = $user->pembicara->foto;
                    } elseif ($user->hasRole('moderator') && $user->moderator && $user->moderator->foto) {
                        $foto = $user->moderator->foto;
                    }
                @endphp

                <img id="preview" src="{{ asset('storage/' . $foto) }}" alt="Foto Profil"
                    class="w-full h-full object-cover rounded-full border-2 border-blue-400 transition duration-300 ease-in-out">
                <label for="profilePhoto"
                    class="absolute bottom-0 right-0 bg-blue-400 hover:bg-blue-400 p-2 rounded-full text-white cursor-pointer transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                    </svg>
                </label>
            </div>
            <input type="file" id="profilePhoto" name="foto" accept="image/*" class="hidden"
                onchange="previewImage(event)">
            <h2 class="text-lg font-semibold text-gray-700">Upload Foto Profil</h2>
            <p class="text-sm text-gray-500 mb-4">Ukuran maksimal 2MB. Format: JPG, PNG.</p>
        </div>


        {{-- ALAMAT → hanya untuk peserta --}}
        @if ($user->hasRole('peserta'))
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" id="alamat" name="alamat"
                    value="{{ old('alamat', $user->peserta->alamat ?? '') }}"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        @endif

        {{-- INSTANSI → untuk semua --}}
        <div>
            <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
            <input type="text" id="instansi" name="instansi"
                value="{{ old('instansi', $user->peserta->instansi ?? ($user->pembicara->instansi ?? ($user->moderator->instansi ?? ''))) }}"
                class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Hanya moderator dan pembicara --}}
        @if ($user->hasRole('moderator') || $user->hasRole('pembicara'))
            <div>
                <label for="pengalaman" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman</label>
                <input type="text" id="pengalaman" name="pengalaman"
                    value="{{ old('pengalaman', $user->pembicara->pengalaman ?? ($user->moderator->pengalaman ?? '')) }}"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                <input type="url" id="linkedin" name="linkedin"
                    value="{{ old('linkedin', $user->pembicara->linkedin ?? ($user->moderator->linkedin ?? '')) }}"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                <textarea id="bio" name="bio" rows="4"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', $user->pembicara->bio ?? ($user->moderator->bio ?? '')) }}</textarea>
            </div>
        @endif

        <div>
            <button type="submit"
                class="px-5 py-3 w-full rounded-full bg-blue-500 text-white hover:bg-blue-600 focus:outline-none text-xs font-semibold">
                SAVE
            </button>
        </div>
    </form>


    {{-- Form Edit Kategori Pembicara --}}
    {{-- @if ($user->hasRole('moderator') || $user->hasRole('pembicara'))
        <form action="{{ route('profile.update.kategori') }}" method="POST" class="mt-8 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_id[]" id="kategori" multiple
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($semuaKategori as $kategori)
                        <option value="{{ $kategori->id }}" @if ($user->hasRole('pembicara') && $user->pembicara && $user->pembicara->kategoris->contains($kategori->id)) selected @endif
                            @if ($user->hasRole('moderator') && $user->moderator && $user->moderator->kategoris->contains($kategori->id)) selected @endif>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Tekan Ctrl / Cmd untuk memilih lebih dari satu.</p>
            </div>

            <div>
                <button type="submit"
                    class="px-5 py-3 rounded-full bg-green-500 text-white hover:bg-green-600 focus:outline-none text-sm font-semibold">
                    SIMPAN KATEGORI
                </button>
            </div>
        </form>
    @endif --}}

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
