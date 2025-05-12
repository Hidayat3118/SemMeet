@props(['moderator'])

<a href="{{ route('moderator.show', $moderator->id) }}">
    <article
        class="overflow-hidden rounded-xl shadow-md transition-all duration-300 ease-in-out hover:shadow-xl bg-white border border-slate-300 cursor-pointer">
        <div class="flex flex-col items-center p-6 space-y-4">
            <img alt="Foto {{ $moderator->user->name ?? '-' }}" src="{{ $moderator->foto ?? 'default.jpg' }}"
                class="w-32 h-32 object-cover rounded-full border-4 border-blue-100 shadow-sm transition duration-300 hover:scale-105" />

            <div class="text-center space-y-1">
                <h3 class="text-xl font-bold text-gray-900">{{ $moderator->user->name ?? '-' }}</h3>
                <p class="text-sm text-gray-500">{{ $moderator->jabatan }} <span class="text-blue-500 font-medium">@
                        {{ $moderator->instansi }}</span></p>
            </div>

            <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-2 px-2">
                {{ $moderator->bio }}
            </p>
        </div>
    </article>
</a>

{{-- <article class="overflow-hidden rounded-xl shadow-md transition-all duration-300 ease-in-out hover:shadow-xl bg-white border cursor-pointer">
    <div class="flex flex-col items-center p-6 space-y-4">
        <img alt="Foto {{ $moderator->user->name }}"
            src="{{ $moderator->foto }}"
            class="w-32 h-32 object-cover rounded-full border-4 border-blue-100 shadow-sm transition duration-300 hover:scale-105"/>

        <div class="text-center space-y-1">
            <h3 class="text-xl font-bold text-gray-900">{{ $moderator->user->name }}</h3>
            <p class="text-sm text-gray-500">{{ $moderator->jabatan }} <span class="text-blue-600 font-medium">@ {{ $moderator->instansi }}</span></p>
        </div>

        <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-2 px-2">
            {{ $moderabio }}
        </p>
    </div>
</article> --}}

