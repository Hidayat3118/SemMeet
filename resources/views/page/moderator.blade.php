@extends('layouts.layout')

@section('konten')
    <main>
        {{-- header --}}
        <x-header></x-header>
        {{-- container max-w-7xl --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto mt-10 md:mt-24 py-20">
            {{-- card pembicara --}}
            <section>
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        Pembicara Terbaru
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Dapatkan wawasan eksklusif dari para ahli dan tokoh inspiratif di bidangnya
                    </p>
                </div>
                {{-- tombol --}}
                <div class="flex justify-between">
                    <div class="flex space-x-2">
                        <button
                            class="px-4 py-2 bg-blue-500 text-white rounded-full border border-gray-300  shadow-sm">All</button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full border border-gray-300  shadow-sm">Front
                            End Developer</button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full border border-gray-300  shadow-sm">Back
                            End Developer</button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full border border-gray-300  shadow-sm">UI
                            UX Design</button>
                    </div>
                    {{-- serch --}}
                    <div class="flex gap-16 ">
                        <div class="flex items-center w-full mx-auto ">
                            <div class="relative w-full">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" placeholder="Cari Pembicara Anda..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400" />
                            </div>
                        </div>
                        {{-- drop down --}}
                        <div>
                            <select
                                class="px-4 pr-8 py-2 border bg-gray-100 border-gray-300 rounded-md shadow-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Default</option>
                                <option value="1">Opsi 1</option>
                                <option value="2">Opsi 2</option>
                                <option value="3">Opsi 3</option>
                            </select>
                        </div>
                    </div>
                    {{-- card pembicara --}}
                </div>
                <div class="grid grid-cols-3 my-8 gap-10">
                    @foreach (range(1, 6) as $i)
                        <div class="swiper-slide">
                            <x-card-moderator
                                gambar="https://cdn1-production-images-kly.akamaized.net/DWnBe8PTM828LOmQYXTgeal7wZc=/1200x1200/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4187379/original/051148000_1665460757-talking-audience.jpg"
                                nama="Muhammad Rizqi Ramadan" jabatan='Sekertaris' instansi='PT Bongkar Turet'
                                bio="Senior Front End Developer di PT Bongkar Turet dengan 7+ tahun pengalaman membangun antarmuka web yang responsif dan ramah pengguna. Fokus pada performa, aksesibilitas, dan kolaborasi lintas tim" />
                        </div>
                    @endforeach

                </div>
            </section>
        </div>
        {{-- Footer --}}
        <x-footer></x-footer>
    </main>
@endsection
