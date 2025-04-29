@extends('layouts.layout')

@section('konten')
<main>
    <x-header></x-header>

    <div class=" lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            {{-- Foto Pembicara --}}
            <div class="md:col-span-1 flex justify-center">
                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Foto Pembicara"
                    class="w-60 h-60 object-cover rounded-full border-4 border-blue-300 shadow-lg">
            </div>

            {{-- Informasi Pembicara --}}
            <div class="md:col-span-2 space-y-4">
                <h2 class="text-3xl font-bold text-blue-600">Agus Suparno</h2>
                <p class="text-gray-600 text-lg font-medium">Senior Data Scientist di <span class="text-blue-500">Microsoft Indonesia</span></p>

                {{-- Bio --}}
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tentang Pembicara</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Agus Suparno adalah seorang profesional di bidang data science dengan pengalaman lebih dari 10 tahun
                        di industri teknologi. Ia telah bekerja di berbagai proyek transformasi digital, serta aktif menjadi
                        pembicara dalam konferensi teknologi nasional dan internasional.
                    </p>
                </div>

                {{-- Pengalaman --}}
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Pengalaman</h3>
                    <ul class="list-disc pl-6 text-gray-700">
                        <li>Lead Data Scientist di Microsoft (2020 - sekarang)</li>
                        <li>Data Analyst di Gojek (2016 - 2020)</li>
                        <li>Research Assistant di LIPI (2012 - 2015)</li>
                    </ul>
                </div>

                {{-- Media Sosial --}}
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Terhubung dengan Agus</h3>
                    <div class="flex space-x-4">
                        <a href="https://linkedin.com/in/agussuparno" target="_blank"
                            class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="https://twitter.com/agussuparno" target="_blank"
                            class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="mailto:agus@example.com"
                            class="text-gray-600 hover:text-gray-800 flex items-center gap-1">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</main>
@endsection
