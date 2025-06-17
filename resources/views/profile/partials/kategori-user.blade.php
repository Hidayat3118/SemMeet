{{-- @php
    $user = Auth::user();
@endphp

<div class="mx-auto mt-10 bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-2">Kategori Pengguna</h2>
    <p class="text-gray-600 mb-6 text-sm">Edit kategori Anda sebagai pembicara atau moderator.</p>

    @if ($user->hasRole('moderator') || $user->hasRole('pembicara'))
        <form action="{{ route('profile.kategoriExtended') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_id[]" id="kategori" multiple
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($semuaKategori as $kategori)
                        <option value="{{ $kategori->id }}" @if (($user->hasRole('pembicara') && $user->pembicara && $user->pembicara->kategoris->contains($kategori->id)) || ($user->hasRole('moderator') && $user->moderator && $user->moderator->kategoris->contains($kategori->id))) selected @endif>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Tekan Ctrl / Cmd untuk memilih lebih dari satu.</p>
            </div>

            <div>
                <button type="submit"
                    class="px-5 py-3 rounded-full bg-green-500 text-white hover:bg-green-600 focus:outline-none text-sm font-semibold">
                    Simpan Kategori
                </button>
            </div>
        </form>
    @endif
</div> --}}
@php
    $user = Auth::user();
@endphp

<div class="mx-auto mt-10 bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-2">Kategori Pengguna</h2>
    <p class="text-gray-600 mb-6 text-sm">Edit kategori Anda sebagai pembicara atau moderator.</p>

    @if ($user->hasRole('moderator') || $user->hasRole('pembicara'))
        <form action="{{ route('profile.kategoriExtended') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($semuaKategori as $kategori)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="kategori_id[]" value="{{ $kategori->id }}"
                                @if (
                                    ($user->hasRole('pembicara') && $user->pembicara && $user->pembicara->kategoris->contains($kategori->id)) ||
                                        ($user->hasRole('moderator') && $user->moderator && $user->moderator->kategoris->contains($kategori->id))) checked @endif
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-300">
                            <span class="text-sm text-gray-700">{{ $kategori->nama }}</span>
                        </label>
                    @endforeach
                </div>

                <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih kategori sesuai peran Anda.</p>
            </div>

            <div>
                <button type="submit"
                    class="px-5 py-3 rounded-full bg-green-500 text-white hover:bg-green-600 focus:outline-none text-sm font-semibold">
                    Simpan Kategori
                </button>
            </div>
        </form>
    @endif
</div>
