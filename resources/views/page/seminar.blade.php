@extends('layouts.layout')

@section('konten')
    <main>
        {{-- header --}}
        <x-header></x-header>
        {{-- container max-w-7xl --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto md:mt-24 py-20">
            {{-- container --}}
            <section>
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        Seminar Terbaru
                    </h1>
                    <p class="text-gray-600 text-lg md:py-2">
                        Kami menghadirkan seminar-seminar menarik yang memberikan wawasan dan inspirasi terbaik untuk Anda
                    </p>
                </div>
                {{-- tombol kategori--}}
                <div class="flex justify-between flex-col lg:flex-row gap-y-7">
                    <div class="flex  flex-wrap justify-center lg:justify-start gap-2">
                    {{-- Tombol All --}}
                        <a href="{{ route('seminar.index') }}">
                            <button class="px-4 py-2 {{ request()->routeIs('seminar.index') ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700' }} rounded-full border border-gray-300 shadow-sm">
                                All
                            </button>
                        </a>
                        {{-- Tombol per kategori --}}
                        @foreach ($kategoris as $kategori)
                        <a href="{{ route('seminar.kategori', $kategori->id) }}">
                            <button class="px-4 py-2 {{ request()->is('seminar/kategori/'.$kategori->id) ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700' }} rounded-full border border-gray-300 shadow-sm">
                                {{ $kategori->nama }}
                            </button>
                        </a>
                        @endforeach
                    </div>
                    {{-- serch --}}
                    <div class="flex gap-6 lg:gap-10 mx-6">
                        <div class="flex items-center w-full mx-auto ">
                            <div class="relative w-full">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" placeholder="Cari Pembicara Anda..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400" />
                            </div>
                        </div>
                        {{-- drop down --}}
                        <div>
                            <select
                                class="px-4 pr-8 py-2 border bg-gray-100 border-gray-300 rounded-full shadow-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Default</option>
                                <option value="1">Opsi 1</option>
                                <option value="2">Opsi 2</option>
                                <option value="3">Opsi 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- card seminar --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-8 gap-10">
                @forelse ($seminars as $seminar)
                        <div class="swiper-slide px-4">
                            <x-card-seminar :seminar="$seminar"/>
                        </div>
                    @empty
                    <p class="text-center col-span-3 text-gray-500">Belum ada data seminar.</p>
                    @endforelse

                </div>
            </section>
        </div>
        {{-- Footer --}}
        <x-footer></x-footer>
    </main>
@endsection
