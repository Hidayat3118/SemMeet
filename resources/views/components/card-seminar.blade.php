@props(['gambar', 'judul', 'waktu', 'deskripsi'])

<article class="overflow-hidden rounded-2xl shadow-md bg-white transition duration-300 hover:shadow-xl group  border border-slate-300 cursor-pointer">
    <div class="relative overflow-hidden">
        <img src="{{ $gambar }}" alt="{{ $judul }}"
            class="h-72 w-full object-cover transition-transform duration-300 group-hover:scale-105" />
    </div>

    <div class="p-5">
        {{-- Kategori --}}
        <div class="flex items-center gap-2 mb-3">
            <span
                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-500 text-xs font-medium rounded-full">
                UI UX Design
            </span>
            {{-- waktu --}}
            <time datetime="2022-10-10" class="text-xs text-gray-400">{{ $waktu }}</time>
        </div>

        {{-- Judul --}}
        <h3
            class="text-lg md:text-xl font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
            {{ $judul }}
        </h3>

        {{-- Deskripsi --}}
        <p class="mt-2 text-sm text-gray-500 line-clamp-2">
            {{ $deskripsi }}
        </p>
    </div>
</article>
