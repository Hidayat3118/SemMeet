@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        <div class="max-w-2xl lg:max-w-7xl mx-auto">
            <!-- Hero Section -->
            <section class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 items-center gap-10">
                <div class="space-y-6 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-500">Selamat Datang Di WebSinar</h1>
                    <p class="text-gray-500 text-lg">
                        Remember everything and accomplish anything with the best notes app for tackling
                        projects. Keep your notes, tasks, and schedule all in one place.
                    </p>
                    <div class="space-x-4">
                        <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded font-semibold hover:bg-blue-600">
                            Lihat Seminar
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="https://i.ytimg.com/vi/Lj1D5ykXIxQ/hq720.jpg?sqp=-oaymwE7CK4FEIIDSFryq4qpAy0IARUAAAAAGAElAADIQj0AgKJD8AEB-AH-CYAC0AWKAgwIABABGD4gVShlMA8=&rs=AOn4CLDb3z89h36iFZVal0XHdFG0QeVywA"
                        alt="App Screenshot" class="rounded shadow-lg">
                </div>
            </section>

            <!-- Seminar Cards Section -->
            <section>
                <div class="my-8 text-center">
                    <h1 class="text-xl md:text-3xl font-bold text-center text-blue-500 ">
                        Seminar Terbaru
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Remember everything and accomplish anything with the best notes
                    </p>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide border-4 p-4">
                                <x-card-seminar gambar="https://assets.cdn.dicoding.com/original/event/dos-elevaite_x_dicoding_live_1_unlocking_ai_kunci_teknologi_talenta_masa_depan_logo_170125170540.png"
                                    judul="Judul {{ $i }}" waktu="jumat besok"
                                    deskripsi="Deskripsi card ke-{{ $i }}" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Swiper Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </section>

            <!-- Speaker Cards Section -->
            <section class="mt-20">
                <div class="my-8 text-center">
                    <h1 class="text-xl md:text-3xl font-bold text-center text-blue-500 ">
                        Pembicara Top
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Remember everything and accomplish anything with the best notes 
                    </p>
                </div>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide border-4 p-4">
                                <x-card-pembicara
                                    gambar="https://www.bizhare.id/media/wp-content/uploads/2023/12/1214_Thumbnail_Artikel-Media_Ciri-ciri-Orang-Sukses-Apakah-Anda-Salah-Satunya_.jpg"
                                    nama="Anur" jabatan="Jendral Menejer" instansi="Poliban" bio="Saya jago ngoding" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Swiper Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>
        </div>

        <x-footer></x-footer>
    </main>

    <script>
        // card seminar
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.mySwiper', {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                },
            });
        });

        // card pembicara
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.mySwiper2', {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                },
            });
        });
    </script>
@endsection
