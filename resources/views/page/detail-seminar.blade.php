@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        {{-- hero section --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 ">
                {{-- Kiri: Deskripsi --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="">
                        <img src="{{ $seminar->foto }}"
                            alt="Poster" class="w-full h-[400px] md:h-[700px] rounded-lg mb-6 overflow-hidden object-cover">
                    </div>
                    {{-- judul + deskripsi --}}
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-blue-400 mb-2">
                        {{ $seminar->judul }}   
                        </h3>
                        <h2 class="text-xl md:text-2xl  font-semibold text-gray-800 my-4">Deskripsi</h2>
                        <p class="text-gray-700 mb-4">
                        {{ $seminar->deskripsi }}
                        </p>

                    </div>
                </div>
                {{-- Kanan --}}
                <div class="space-y-6">

                    <div class="space-y-2 text-sm text-gray-800">
                        <h3 class="text-xl md:text-2xl  my-4 font-semibold">Informasi Seminar</h3>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Tanggal</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ \Carbon\Carbon::parse($seminar->tanggal)->format('d M Y') }}</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Waktu</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ \Carbon\Carbon::parse($seminar->waktu_mulai)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($seminar->waktu_selesai)->format('H:i') }}</span>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Moderator</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ $seminar->moderator->name ?? '-' }}</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Pembicara</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ $seminar->pembicara->name ?? '-' }}</span></div>
                        </div>

                        <div class="flex">  
                            <div class="w-28 font-medium text-gray-600">Biaya</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>Rp. {{ number_format($seminar->harga, 0, ',', '.') }}</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Status</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ $seminar->status }}</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Lokasi</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ $seminar->lokasi }}</span></div>
                        </div>
                    </div>



                    {{-- Kouta --}}
                    <div class="font-semibold">
                        <h3 class="text-xl md:text-2xl  my-4 font-semibold">Kouta Peserta</h3>
                        <div class="flex">
                            <div class="w-28 font-medium text-gray-700">Kouta</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ $seminar->kouta }}</span></div>
                        </div>
                        <div class="flex">
                            <div class="w-28 font-medium text-gray-700">Sisa Kouta</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>50</span></div>
                        </div>
                    </div>
                    {{-- Keikutsertaan --}}
                    <div class="">
                        <h3 class="text-xl md:text-2xl  font-semibold text-gray-800 mb-2">Keikutsertaan</h3>
                        <p class="text-sm text-gray-600 mb-4">Silakan daftar ke acara seminar untuk mendapatkan pengalaman
                            belajar yang berharga.</p>
                        <button
                            class="w-full bg-blue-500 text-white py-2 rounded-full cursor-pointer font-semibold flex justify-center items-center gap-4 hover:bg-blue-600"
                            disabled>
                            <i class="fa-solid fa-cart-shopping "></i>
                            <p>Daftar</p>
                        </button>
                    </div>
                    {{-- jadwal --}}
                    <div class="">
                        <h3 class="text-xl md:text-2xl  font-semibold text-gray-800 mb-4">Jadwal Pelaksanaan</h3>
                        <div class="text-sm text-gray-700 space-y-1 font-semibold">
                            <div class="flex">
                                <div class="w-28 font-medium text-gray-700">Waktu Mulai</div>
                                <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ \Carbon\Carbon::parse($seminar->waktu_mulai)->format('H:i') }}</span></div>
                            </div>
                            <div class="flex">
                                <div class="w-28 font-medium text-gray-700">Waktu Selesai</div>
                                <div class="flex items-baseline"><span class="mr-2">:</span> <span> {{ \Carbon\Carbon::parse($seminar->waktu_selesai)->format('H:i') }}</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <h3 class="text-xl md:text-2xl  font-semibold text-gray-800 mb-4">Lokasi</h3>
                        <p class="text-sm text-gray-700">
                            📍 LIVE at <span class="text-pink-500 font-semibold">{{ $seminar->lokasi }} </span><br>
                            <span class="text-sm text-gray-500">{{ $seminar->mode }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </main>
@endsection
