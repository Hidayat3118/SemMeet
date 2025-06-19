@props(['seminar'])

<a href="{{ route('seminar.show', $seminar->id) }}"
    class="block overflow-hidden rounded-2xl shadow-md bg-white transition duration-300 hover:shadow-xl group border border-slate-300">
    <div class="relative overflow-hidden">
        {{-- ini yang ubah --}}
        <img src="{{ $seminar->foto ? asset('storage/' . $seminar->foto) : asset('images/default.jpg') }}"
            class="h-72 w-full object-cover transition-transform duration-300 group-hover:scale-105" />
    </div>

    <div class="p-5">
        {{-- Kategori dan Waktu --}}
        <div class="mb-3">
            {{-- Container untuk kategori yang bisa di-scroll --}}
            <div class="flex gap-2 overflow-x-auto overflow-y-hidden pb-2" 
                 style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach ($seminar->kategoris as $kategori)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-500 text-xs font-medium rounded-full whitespace-nowrap flex-shrink-0">
                        {{ $kategori->nama }}
                    </span>
                @endforeach
            </div>
        </div>
        
        <time datetime="{{ $seminar->created_at }}" class="text-xs text-gray-400">
            {{ \Carbon\Carbon::parse($seminar->created_at)->format('d M Y') }}
        </time>
        
        {{-- Judul --}}
        <h3 class="text-lg md:text-xl font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 line-clamp-1">
            {{ $seminar->judul }}
        </h3>

        {{-- Deskripsi --}}
        <p class="mt-2 text-sm text-gray-500 line-clamp-1">
            {{ Str::limit($seminar->deskripsi, 100, '...') }}
        </p>
    </div>
</a>


