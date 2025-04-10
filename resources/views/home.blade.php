@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        <div id="MainContent"></div>
        <div class="max-w-2xl lg:max-w-7xl mx-auto mt-10 md:mt-32">
            <!-- Hero Section -->
            <section class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 items-center gap-10">
                <div class="space-y-6 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-500">Selamat Datang Di WebSinar</h1>
                    <p class="text-gray-500 text-xl mt-4">
                        WebSinar platform informasi dan edukasi bantu Anda terhubung di berbagai
                        seminar dan acara inspiratif. Temukan wawasan baru, kembangkan diri, dan jadilah bagian dari
                        komunitas yang terus bersinar.
                    </p>

                    <div class="flex space-x-4 justify-center md:justify-start">
                        <a
                            class="group relative inline-block text-sm font-medium text-blue-500 focus:ring-3 focus:outline-hidden cursor-pointer">
                            <span
                                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></span>

                            <span class="relative block border border-current bg-white px-8 py-3">Lihat Seminar</span>
                        </a>
                    </div>

                </div>
                <div class="flex justify-center">
                    <img src="https://i.ytimg.com/vi/Lj1D5ykXIxQ/hq720.jpg?sqp=-oaymwE7CK4FEIIDSFryq4qpAy0IARUAAAAAGAElAADIQj0AgKJD8AEB-AH-CYAC0AWKAgwIABABGD4gVShlMA8=&rs=AOn4CLDb3z89h36iFZVal0XHdFG0QeVywA"
                        alt="App Screenshot" class="rounded shadow-lg">
                </div>
            </section>

            {{-- card seminar --}}
            <section>
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-500 ">
                        Seminar Terbaru
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Kami menghadirkan seminar-seminar menarik yang memberikan wawasan dan inspirasi terbaik untuk Anda
                    </p>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide border-4 p-4">
                                <x-card-seminar
                                    gambar="https://assets.cdn.dicoding.com/original/event/dos-elevaite_x_dicoding_live_1_unlocking_ai_kunci_teknologi_talenta_masa_depan_logo_170125170540.png"
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

            {{-- card pembicara --}}
            <section class="mt-20">
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-500 ">
                        Pembicara Top
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Dapatkan wawasan eksklusif dari para ahli dan tokoh inspiratif di bidangnya
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

            {{-- card moderator --}}
            <section class="mt-20">
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-500 ">
                        moderator Top
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Dipandu oleh moderator berpengalaman untuk menjaga diskusi tetap menarik dan informatif
                    </p>
                </div>
                <div class="swiper mySwiper3">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide border-4 p-4">
                                <x-card-moderator gambar="" nama="Anur" jabatan='anur keren' instansi='poliban'
                                    bio="aku hilang akun" />
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
        {{-- button top --}}
        <x-button-top></x-button-top>
        {{-- Footer --}}
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

        // card moderator
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.mySwiper3', {
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

        // js tombol top
        const backToTopBtn = document.getElementById("backToTopBtn");

        // Tampilkan tombol saat scroll ke bawah
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove("opacity-0", "invisible");
            } else {
                backToTopBtn.classList.add("opacity-0", "invisible");
            }
        });

        // Scroll halus ke atas saat tombol diklik
        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
@endsection
