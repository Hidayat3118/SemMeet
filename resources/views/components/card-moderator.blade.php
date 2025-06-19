@props(['moderator'])

<a href="{{ route('moderator.show', $moderator->id) }}">
    <article class="overflow-hidden rounded-xl shadow-md transition-all duration-300 ease-in-out hover:shadow-xl bg-white border border-slate-300 cursor-pointer h-full">
        <div class="flex flex-col items-center p-6 h-full">
            {{-- Avatar Section - Fixed height --}}
            <div class="flex-shrink-0 mb-4">
                <img alt="Foto {{ $moderator->user->name ?? '-' }}"
                    src="{{ $moderator->foto ? asset('storage/' . $moderator->foto) : asset('img/profil.png') }}"
                    class="w-32 h-32 object-cover rounded-full border-4 border-blue-100 shadow-sm transition duration-300 hover:scale-105" />
            </div>

            {{-- Info Section - Flexible but structured --}}
            <div class="text-center w-full flex-grow flex flex-col">
                {{-- Categories Section - Fixed minimum height --}}
                <div class="flex justify-center mb-3 min-h-8 items-center">
                    @if($moderator->kategoris && $moderator->kategoris->count() > 0)
                        <div class="flex gap-2 overflow-x-auto overflow-y-hidden scrollbar-hide pb-1 max-w-full">
                            @foreach ($moderator->kategoris as $kategori)
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-500 text-xs font-medium rounded-full whitespace-nowrap flex-shrink-0">
                                    {{ $kategori->nama }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                {{-- Name and Position - Fixed structure --}}
                <div class="mb-4 flex-shrink-0">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $moderator->user->name ?? '-' }}</h3>
                    <p class="text-sm text-gray-500 min-h-5">
                        {{ $moderator->jabatan }} 
                        @if($moderator->instansi)
                            <span class="text-blue-500 font-medium">@ {{ $moderator->instansi }}</span>
                        @endif
                    </p>
                </div>

                {{-- Bio Section - Takes remaining space --}}
                <div class="flex-grow flex items-start">
                    <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-2 px-2">
                        {{ $moderator->bio ?? 'Belum ada bio tersedia.' }}
                    </p>
                </div>
            </div>
        </div>
    </article>
</a>