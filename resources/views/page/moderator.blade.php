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
                        Pembicara Terbaru
                    </h1>
                    <p class="text-gray-600 text-lg md:py-2">
                        Dapatkan wawasan eksklusif dari para ahli dan tokoh inspiratif di bidangnya
                    </p>
                </div>
                {{-- tombol --}}
                <div class="flex justify-between flex-col lg:flex-row gap-y-7">
                    <div class="flex  flex-wrap justify-center lg:justify-start gap-2">
                        <button
                            class="px-4 py-2 bg-blue-500 text-white rounded-full border border-gray-300 shadow-sm">All</button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full border border-gray-300 shadow-sm">Front
                            End Developer</button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full border border-gray-300 shadow-sm">Back
                            End Developer</button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full border border-gray-300 shadow-sm">UI
                            UX Design</button>
                    </div>
                    {{-- serch --}}
                    <div class="flex gap-6 lg:gap-10  mx-6">
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
                {{-- card pembicara --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-8 gap-10">
                    @forelse ($moderators as $moderator)
                        <div class="swiper-slide px-4">
                            <x-card-moderator :moderator="$moderator" />
                        </div>
                        @empty
                        <p class="text-center col-span-3 text-gray-500">Belum ada data moderator.</p>
                        @endforelse
                </div>
            </section>
        </div>
        {{-- Footer --}}
        <x-footer></x-footer>
    </main>
@endsection
