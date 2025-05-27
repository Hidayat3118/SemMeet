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
                        <img src="{{ $seminar->foto ? asset('storage/' . $seminar->foto) : asset('images/default.jpg') }}"
                            alt="Poster" class="w-full h-[400px] md:h-[700px] rounded-lg mb-6 overflow-hidden object-cover">
                    </div>
                    {{-- judul + deskripsi --}}
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-blue-500 mb-2">
                            {{ $seminar->judul }}
                        </h3>
                        <h2 class="text-xl md:text-2xl  font-semibold text-gray-800 my-4">Deskripsi</h2>
                        <p class="text-gray-700 mb-4 text-justify">
                            {{ $seminar->deskripsi }}
                        </p>

                    </div>
                </div>
                {{-- Kanan --}}
                <div class="space-y-6">

                    <div class="space-y-2 text-sm text-gray-800">
                        <div class="flex  items-center gap-2">
                            <div><i class="fa-solid fa-chalkboard-user text-blue-500 mr-2 text-xl"></i></div>
                            <div>
                                <h3 class="text-xl md:text-2xl  my-4 font-semibold text-blue-500">Informasi Seminar</h3>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Tanggal</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span>
                                <span>{{ \Carbon\Carbon::parse($seminar->tanggal)->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Waktu</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span>
                                <span>{{ \Carbon\Carbon::parse($seminar->waktu_mulai)->format('H:i') }} WITA -
                                    {{ \Carbon\Carbon::parse($seminar->waktu_selesai)->format('H:i') }} WITA</span>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Moderator</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span>
                                @if ($seminar->moderator && $seminar->moderator->user)
                                    <a href="{{ route('moderator.show', $seminar->moderator->id) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $seminar->moderator->user->name }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Pembicara</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span>
                                @if ($seminar->pembicara && $seminar->pembicara->user)
                                    <a href="{{ route('pembicara.show', $seminar->pembicara->id) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $seminar->pembicara->user->name }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Biaya</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>Rp.
                                    {{ number_format($seminar->harga, 0, ',', '.') }}</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Status</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span>
                                <span>{{ $seminar->status }}</span>
                            </div>
                        </div>

                        <div class="flex ">
                            <div class="w-52 font-medium text-gray-600 ">Lokasi</div>
                            <div class="flex items-baseline"><span class="mr-2 ">:</span>
                                <span>{{ $seminar->lokasi }}</span>
                            </div>
                        </div>
                    </div>



                    {{-- Kouta --}}
                    <div class="font-semibold">
                        <div class="flex  items-center gap-2">
                            <div> <i class="fa-solid fa-ticket text-blue-500 mr-2"></i>
                            </div>
                            <div>
                                <h3 class="text-xl md:text-2xl my-4 font-semibold text-blue-500">Kouta Peserta</h3>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-28 font-medium text-gray-700">Kouta</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span>
                                <span>{{ $seminar->kouta }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-28 font-medium text-gray-700">Sisa Kouta</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>{{ $sisa_kouta }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- Keikutsertaan --}}
                    <div class="">
                        <div class="flex  items-center gap-2">
                            <div> <i class="fa-solid fa-user-group text-blue-500 mr-2"></i>
                            </div>
                            <div>
                                <h3 class="text-xl md:text-2xl my-4 font-semibold text-blue-500">Keikutsertaan Peserta</h3>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Silakan daftar ke acara seminar untuk mendapatkan pengalaman
                            belajar yang berharga.</p>
                        @auth
                            <form action="{{ route('pendaftaran.daftar', $seminar->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-blue-500 text-white py-2 rounded-full cursor-pointer font-semibold flex justify-center items-center gap-4 hover:bg-blue-600">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <p>Daftar</p>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">
                                <button
                                    class="w-full bg-blue-500 text-white py-2 rounded-full cursor-pointer font-semibold flex justify-center items-center gap-4 hover:bg-blue-600">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    <p>Login untuk Daftar</p>
                                </button>
                            </a>
                        @endauth


                    </div>
                    {{-- jadwal --}}

                    <div class="">
                        <div class="flex  items-center gap-2">
                            <div> <i class="fa-regular fa-clock mr-2 text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl md:text-2xl my-4 font-semibold text-blue-500">Pelaksanaan</h3>
                            </div>
                        </div>
                        <div class="text-sm text-gray-700 space-y-1 font-semibold">
                            <div class="flex">
                                <div class="w-28 font-medium text-gray-700">Mulai</div>
                                <div class="flex items-baseline"><span class="mr-2">:</span>
                                    <span>{{ \Carbon\Carbon::parse($seminar->waktu_mulai)->format('H:i') }}</span>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-28 font-medium text-gray-700">Selesai</div>
                                <div class="flex items-baseline"><span class="mr-2">:</span> <span>
                                        {{ \Carbon\Carbon::parse($seminar->waktu_selesai)->format('H:i') }}</span></div>
                            </div>
                        </div>
                    </div>
                    {{-- Lokasi --}}
                    <div class="space-y-3">
                        <h3 class="text-2xl font-semibold  mb-2 text-blue-500">Lokasi</h3>
                        <div class="flex text-gray-700 text-sm space-x-2">
                            <i class="fa-solid fa-location-dot text-blue-500"></i>
                            <span class="font-semibold text-blue-500">Lokasi:</span>
                            <span>{{ $seminar->lokasi }}</span>
                        </div>
                        <div class="flex items-center text-gray-700 text-sm space-x-2">
                            <i class="fa-solid fa-circle-half-stroke text-blue-500"></i>
                            <span class="font-semibold text-blue-500">Mode:</span>
                            <span>{{ $seminar->mode }}</span>
                        </div>
                    </div>

                </div>
            </div>

    </main>
    <x-footer></x-footer>
@endsection
