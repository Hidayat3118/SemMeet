@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>

        <div class=" lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                {{-- Foto Moderator --}}
                <div class="md:col-span-1 flex flex-col justify-center">
                    <div class="flex justify-center">
                        <img src="{{ $moderator->foto ? asset('storage/' . $moderator->foto) : asset('img/profil.png') }}"
                            class="w-60 h-60 object-cover rounded-full border-4 border-blue-300 shadow-lg">
                    </div>
                    <div class="flex justify-center flex-col text-center mt-8">
                        <h2 class="text-3xl font-bold">{{ $moderator->user->name ?? '-' }}</h2>
                        <p class="text-gray-600 text-lg font-medium"> <span
                                class="text-blue-500">{{ $moderator->instansi }}</span>
                        </p>
                    </div>
                </div>

                {{-- Informasi Moderator --}}
                <div class="md:col-span-2 space-y-4 shadow-lg py-10 px-4 md:py-10 bg-white rounded-xl">
                    <div class="">
                        {{-- Media Sosial --}}
                        <div class="mb-2 pb-4">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2 md:mb-3 relative inline-block">
                                Moderator
                                <span
                                    class="absolute left-0 bottom-0 translate-y-2 w-20 h-[3px] bg-blue-500 rounded-full"></span>
                            </h3>
                            <div class="flex space-x-2 mt-2 md:mt-3 text-xs">
                                @if (!empty($moderator->linkedin))
                                    <a href="{{ $moderator->linkedin }}" target="_blank"
                                        class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 py-2 px-4 rounded-full hover:bg-blue-200 font-semibold border border-blue-300">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                @else
                                    <button disabled
                                        class="inline-flex items-center gap-1 bg-gray-200 text-gray-500 py-2 px-4 rounded-full font-semibold border border-gray-300 cursor-not-allowed">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </button>
                                @endif
                                {{-- <button
                                    class="bg-blue-500 py-2 px-4 rounded-full hover:bg-blue-600 font-semibold border-slate-400 border">
                                    <a href="https://linkedin.com/in/agussuparno" target="_blank"
                                        class="text-white  flex items-center gap-1">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                </button> --}}
                                <button
                                    class="bg-gray-100 py-2 px-4 rounded-full hover:bg-gray-200 font-semibold border-slate-400 border">
                                    <a href="mailto:{{ $moderator->user->email }}"
                                        class="text-gray-600 hover:text-gray-800 flex items-center gap-1">
                                        <i class="fas fa-envelope"></i> Email
                                    </a>
                                </button>

                            </div>
                        </div>

                        {{-- Bio --}}
                        <div class="pb-4 text-justify">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2 md:mb-3 relative inline-block">
                                Bio Saya
                                <span
                                    class="absolute left-0 bottom-0 translate-y-2 w-20 h-[3px] bg-blue-500 rounded-full"></span>
                            </h3>
                            <p class="text-gray-700 mt-2 md:mt-3">
                                {{ $moderator->bio }}
                            </p>
                        </div>

                        {{-- Pengalaman --}}
                        <div class="text-justify">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2 md:mb-3 relative inline-block">
                                Pengalaman Saya
                                <span
                                    class="absolute left-0 bottom-0 translate-y-2 w-20 h-[3px] bg-blue-500 rounded-full"></span>
                            </h3>

                            <p class=" text-gray-700 mt-2 md:mt-3">
                                {{ $moderator->pengalaman }}
                            </p>
                        </div>


                    </div>
                </div>





                {{-- Tambahkan di bawah profil pembicara/moderator

                @if ($moderator->seminar->count() > 0)
                    <div class="mt-12 bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-2xl font-semibold mb-4 border-b pb-2 border-blue-500">Seminar yang Dibawakan</h3>

                        <ul class="space-y-4">
                            @foreach ($moderator->seminar as $seminar)
                                <li class="border rounded-lg p-4 hover:shadow-md transition">
                                    <a href="{{ route('seminar.show', $seminar->id) }}"
                                        class="text-blue-600 font-semibold hover:underline">
                                        {{ $seminar->judul }}
                                    </a>
                                    <p class="text-gray-600 text-sm mt-1">
                                        Tanggal: {{ \Carbon\Carbon::parse($seminar->tanggal)->format('d M Y') }}
                                    </p>
                                    <p class="text-gray-700 mt-2">
                                        {{ Str::limit($seminar->deskripsi, 150) }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
            </div>
            {{-- @if ($moderator->seminar && $moderator->seminar->count() > 0)
                <div class="mt-12 bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4 border-b pb-2 border-blue-500">Seminar yang Dibawakan</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($moderator->seminar as $seminar)
                            <div class="border rounded-lg p-4 bg-gray-50 hover:shadow-md transition">
                                <a href="{{ route('seminar.show', $seminar->id) }}"
                                    class="text-blue-600 font-semibold hover:underline">
                                    {{ $seminar->judul }}
                                </a>
                                <p class="text-gray-600 text-sm mt-1">
                                    Tanggal: {{ \Carbon\Carbon::parse($seminar->tanggal)->format('d M Y') }}
                                </p>
                                <p class="text-gray-700 mt-2">
                                    {{ Str::limit($seminar->deskripsi, 100) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif --}}

            @if ($moderator->seminar && $moderator->seminar->count() > 0)
                <div class="mt-12 bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4 border-b pb-2 border-blue-500">Seminar yang Dibawakan</h3>

                    <div class="flex space-x-4 overflow-x-auto pb-2">
                        @foreach ($moderator->seminar as $seminar)
                            <div
                                class="min-w-[300px] max-w-sm border rounded-lg p-4 bg-gray-50 hover:shadow-md transition flex-shrink-0">
                                <a href="{{ route('seminar.show', $seminar->id) }}"
                                    class="text-blue-600 font-semibold hover:underline">
                                    {{ $seminar->judul }}
                                </a>
                                <p class="text-gray-600 text-sm mt-1">
                                    Tanggal: {{ \Carbon\Carbon::parse($seminar->tanggal)->format('d M Y') }}
                                </p>
                                <p class="text-gray-700 mt-2">
                                    {{ Str::limit($seminar->deskripsi, 100) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <x-footer></x-footer>
    </main>
@endsection
