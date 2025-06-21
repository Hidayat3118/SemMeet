
@php
    $user = Auth::user();
@endphp

<div class="mx-auto mt-10 rounded-lg ">
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
                    class="px-5 py-4 rounded-xl w-full bg-blue-500 text-white  hover:bg-blue-600 focus:outline-none text-sm font-semibold">
                    Simpan Kategori
                </button>
            </div>
        </form>
    @endif
</div>
