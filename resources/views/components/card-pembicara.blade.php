@props(['pembicara'])

<a href="{{ route('pembicara.show', $pembicara->id) }}">
    <article
        class="overflow-hidden rounded-xl shadow-md transition-all duration-300 ease-in-out hover:shadow-xl bg-white border border-slate-300 cursor-pointer">
        <div class="flex flex-col items-center p-6 space-y-4">
            <img alt="Foto {{ $pembicara->user->name ?? '-' }}" src="{{ $pembicara->foto ?? 'default.jpg' }}"
                class="w-32 h-32 object-cover rounded-full border-4 border-blue-100 shadow-sm transition duration-300 hover:scale-105" />

            <div class="text-center space-y-1">
                <span
                    class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-500 text-xs font-medium rounded-full">
                    UI UX Design
                </span>
                <h3 class="text-xl font-bold text-gray-900">{{ $pembicara->user->name ?? '-' }}</h3>
                <p class="text-sm text-gray-500">{{ $pembicara->jabatan }} <span class="text-blue-500 font-medium">@
                        {{ $pembicara->instansi }}</span></p>
            </div>

            <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-2 px-2">
                {{ $pembicara->bio }}
            </p>
        </div>
    </article>
</a>

{{-- @props(['gambar', 'nama', 'jabatan', 'instansi', 'bio']) --}}

{{-- <article
    class="overflow-hidden rounded-xl shadow-md transition-all duration-300 ease-in-out hover:shadow-xl bg-white border border-slate-300 cursor-pointer">
    <div class="flex flex-col items-center p-6 space-y-4">
        <img alt="Foto {{ $nama }}" src="{{ $gambar }}"
            class="w-32 h-32 object-cover rounded-full border-4 border-blue-100 shadow-sm transition duration-300 hover:scale-105" />

        <div class="text-center space-y-1">
            {{--kategori --}}
           {{-- <span
                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-500 text-xs font-medium rounded-full">
                UI UX Design
            </span>
            <h3 class="text-xl font-bold text-gray-900">{{ $nama }}</h3>
            <p class="text-sm text-gray-500">{{ $jabatan }} <span class="text-blue-500 font-medium">@
                    {{ $instansi }}</span></p>
        </div>

        <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-2 px-2">
            {{ $bio }}
        </p>
    </div>
</article> --}} 
