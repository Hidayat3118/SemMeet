@extends('layouts.layout')

@section('konten')
    <main>
        {{-- Header --}}
        <x-header />

        {{-- Container Utama --}}
        <div class="max-w-7xl mx-auto px-4 md:mt-24 py-20">
            {{-- Judul Section --}}
            <section>
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-blue-500">
                        Seminar Terbaru
                    </h1>
                    <p class="text-gray-600 text-lg mt-2">
                        Kami menghadirkan seminar menarik yang memberikan wawasan dan inspirasi terbaik untuk Anda.
                    </p>
                </div>

                {{-- Filter dan Pencarian --}}
                <div class="flex gap-6 mb-10">
                    {{-- Tombol Kategori --}}
                    <div class="flex flex-wrap justify-center lg:justify-start gap-3 p-4 ">
                        {{-- Tombol All --}}
                        <a href="{{ route('seminar.index') }}">
                            <button
                                class="px-4 py-2 rounded-full border shadow-sm
                            {{ request()->routeIs('seminar.index') ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 rounded-full border border-gray-300 shadow-sm' }}">
                                All
                            </button>
                        </a>

                        {{-- Tombol per Kategori --}}
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('seminar.kategori', $kategori->id) }}">
                                <button
                                    class="px-4 py-2 rounded-full border shadow-sm
                                {{ request()->is('seminar/kategori/' . $kategori->id) ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 rounded-full border border-gray-300 shadow-sm' }}">
                                    {{ $kategori->nama }}
                                </button>
                            </a>
                        @endforeach
                    </div>

                    {{-- Form Pencarian --}}

                    <form method="GET" action="{{ route('seminar.index') }}"
                        class="flex flex-col md:flex-row items-start justify-between gap-4  p-4 ">
                        {{-- Input Pencarian --}}
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                            <i class="fas fa-search"></i>
                                        </span>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari seminar..."
                                class="flex-1 px-4 py-2 pl-10 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        {{-- Dropdown Mode --}}
                        <select name="mode" onchange="this.form.submit()"
                            class="px-7 py-2 border border-gray-300 bg-gray-100 rounded-full shadow-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Mode</option>
                            <option value="online" {{ request('mode') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ request('mode') == 'offline' ? 'selected' : '' }}>Offline</option>
                        </select>

                        {{-- Tombol Cari --}}
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">
                            Cari
                        </button>
                    </form>
                </div>

                {{-- Kartu Seminar --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($seminars as $seminar)
                        <div class="swiper-slide px-4">
                            <x-card-seminar :seminar="$seminar" />
                        </div>
                    @empty
                        <p class="text-center col-span-3 text-gray-500">Belum ada data seminar.</p>
                    @endforelse
                </div>
            </section>
        </div>

        {{-- Footer --}}
        <x-footer />
    </main>
@endsection
