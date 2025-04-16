@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        {{-- hero section --}}
        <section class=" mx-auto mt-10 md:mt-24 bg-blue-100 md:py-20">
            <div class=" mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 items-center gap-10  max-w-2xl lg:max-w-7xl">
                <div class="space-y-6 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-400">Selamat Datang Di SemMet</h1>
                    <p class=" text-xl mt-4">
                        SemMet platform informasi dan edukasi bantu Anda terhubung di berbagai
                        seminar dan acara inspiratif. Temukan wawasan baru, kembangkan diri, dan jadilah bagian dari
                        komunitas yang terus bersinar.
                    </p>
                    <div class="flex space-x-4 justify-center md:justify-start">
                        <a href="/seminar"
                            class="group relative inline-block text-sm font-medium text-blue-400 focus:ring-3 focus:outline-hidden cursor-pointer">
                            <span
                                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-lg"></span>

                            <span class="relative block border border-current bg-white px-8 py-3 rounded-lg">Lihat
                                Seminar</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('img/people.png') }}" alt="App Screenshot" class="">
                </div>
            </div>
        </section>
        {{-- container max-w-7xl --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto mt-10 md:mt-16">
            {{-- card seminar --}}
            <section>
                <div class="my-8 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        Seminar Terbaru
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Kami menghadirkan seminar-seminar menarik yang memberikan wawasan dan inspirasi terbaik untuk Anda
                    </p>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide">
                                <x-card-seminar
                                    gambar="https://assets.cdn.dicoding.com/original/event/dos-elevaite_x_dicoding_live_1_unlocking_ai_kunci_teknologi_talenta_masa_depan_logo_170125170540.png"
                                    judul="Judul {{ $i }}" waktu="12 Juli 2025"
                                    deskripsi="Pelajari bagaimana kecerdasan buatan membentuk masa depan teknologi dan peran talenta digital dalam ekosistem AI. Seminar ini menghadirkan para ahli industri untuk membahas tren, tantangan, dan peluang karier di era AI." />
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
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        Pembicara Top
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Dapatkan wawasan eksklusif dari para ahli dan tokoh inspiratif di bidangnya
                    </p>
                </div>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide">
                                <x-card-pembicara
                                    gambar="https://www.bizhare.id/media/wp-content/uploads/2023/12/1214_Thumbnail_Artikel-Media_Ciri-ciri-Orang-Sukses-Apakah-Anda-Salah-Satunya_.jpg"
                                    nama="Anur" jabatan="Kepala Bidang" instansi="PT Mencari Cinta Sejati"
                                    bio="Senior UI/UX Designer di PT Mencari Cinta Sejati dengan 7+ tahun pengalaman merancang produk digital yang berfokus pada user experience. Aktif membagikan insight tentang desain inklusif dan usability." />
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
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        moderator Top
                    </h1>
                    <p class="text-gray-500 text-lg md:py-2">
                        Dipandu oleh moderator berpengalaman untuk menjaga diskusi tetap menarik dan informatif
                    </p>
                </div>
                <div class="swiper mySwiper3">
                    <div class="swiper-wrapper">
                        @foreach (range(1, 5) as $i)
                            <div class="swiper-slide">
                                <x-card-moderator
                                    gambar="https://cdn1-production-images-kly.akamaized.net/DWnBe8PTM828LOmQYXTgeal7wZc=/1200x1200/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4187379/original/051148000_1665460757-talking-audience.jpg"
                                    nama="Muhammad Rizqi Ramadan" jabatan='Sekertaris' instansi='PT Bongkar Turet'
                                    bio="Senior Front End Developer di PT Bongkar Turet dengan 7+ tahun pengalaman membangun antarmuka web yang responsif dan ramah pengguna. Fokus pada performa, aksesibilitas, dan kolaborasi lintas tim" />
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

        // Fungsi untuk cek posisi scroll
        function toggleBackToTopBtn() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove("opacity-0", "invisible");
            } else {
                backToTopBtn.classList.add("opacity-0", "invisible");
            }
        }

        // Jalankan saat scroll
        window.addEventListener("scroll", toggleBackToTopBtn);

        // Jalankan saat halaman pertama kali dimuat
        window.addEventListener("DOMContentLoaded", toggleBackToTopBtn);

        // Scroll halus ke atas saat tombol diklik
        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
@endsection
