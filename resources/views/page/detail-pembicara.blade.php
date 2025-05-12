@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>

        <div class=" lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                {{-- Foto Pembicara --}}
                <div class="md:col-span-1 flex flex-col justify-center">
                    <div class="flex justify-center">
                        <img src="{{ $pembicara->foto ?? 'default.jpg' }}" alt="Foto Pembicara"
                            class="w-60 h-60 object-cover rounded-full border-4 border-blue-300 shadow-lg">
                    </div>
                    <div class="flex justify-center flex-col text-center mt-8">
                        <h2 class="text-3xl font-bold">{{ $pembicara->user->name ?? '-' }}</h2>
                        <p class="text-gray-600 text-lg font-medium"> <span class="text-blue-500">{{ $pembicara->instansi }}</span>
                        </p>
                    </div>
                </div>

                {{-- Informasi Pembicara --}}
                <div class="md:col-span-2 space-y-4 shadow-lg py-10 px-4 md:py-10 bg-white rounded-xl">
                    <div class="">
                        {{-- Media Sosial --}}
                        <div class="mb-2 pb-4">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2 md:mb-3 relative inline-block">
                                Pembicara
                                <span class="absolute left-0 bottom-0 translate-y-2 w-20 h-[3px] bg-blue-500 rounded-full"></span>
                              </h3>
                            <div class="flex space-x-2 mt-2 md:mt-3 text-xs">
                                <button class="bg-blue-500 py-2 px-4 rounded-full hover:bg-blue-600 font-semibold border-slate-400 border">
                                    <a href="https://linkedin.com/in/agussuparno" target="_blank"
                                        class="text-white  flex items-center gap-1">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                </button>
                                <button class="bg-gray-100 py-2 px-4 rounded-full hover:bg-gray-200 font-semibold border-slate-400 border">
                                    <a href="mailto:agus@example.com" 
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
                                <span class="absolute left-0 bottom-0 translate-y-2 w-20 h-[3px] bg-blue-500 rounded-full"></span>
                              </h3>
                            <p class="text-gray-700 mt-2 md:mt-3">
                                {{ $pembicara->bio }}
                            </p>
                        </div>

                        {{-- Pengalaman --}}
                        <div class="text-justify">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2 md:mb-3 relative inline-block">
                                Pengalaman Saya
                                <span class="absolute left-0 bottom-0 translate-y-2 w-20 h-[3px] bg-blue-500 rounded-full"></span>
                              </h3>
                                             
                            <p class=" text-gray-700 mt-2 md:mt-3">
                                Agus Suparno adalah seorang profesional di bidang data science dengan pengalaman lebih dari
                                10
                                tahun
                                di industri teknologi. Ia telah bekerja di berbagai proyek transformasi digital, serta aktif
                                menjadi
                                pembicara dalam konferensi teknologi nasional dan internasional.
                            </p>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <x-footer></x-footer>
    </main>
@endsection
