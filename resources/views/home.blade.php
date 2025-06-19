@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        {{-- hero section --}}
        <section class=" mx-auto mt-10 md:mt-24 bg-blue-100 md:py-20">
            <div class=" mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 items-center gap-10  max-w-2xl lg:max-w-7xl">
                <div class="space-y-6 text-center md:text-left">
                    <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold text-slate-700">Selamat Datang Di <span
                            class="text-blue-400">SemMeet</span></h1>
                    <p class="text-md md:text-xl mt-4 text-justify">
                        SemMet platform informasi dan edukasi bantu Anda terhubung di berbagai
                        seminar dan acara inspiratif. Temukan wawasan baru, kembangkan diri, dan jadilah bagian dari
                        komunitas yang terus bersinar.
                    </p>
                    <div class="flex space-x-2 justify-center md:justify-start">
                        <a class="group relative inline-block text-xs md:text-sm font-medium text-white focus:ring-3 focus:outline-hidden cursor-pointer"
                            href="{{ route('register') }}">
                            <span
                                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>

                            <span
                                class="relative block border border-current bg-blue-500 px-6 py-3 rounded-full flex items-center gap-2">
                                <i class="fas fa-user-plus"></i>
                                Daftar Sekarang
                            </span>
                        </a>
                        <a href="/seminar"
                            class="group relative inline-block text-xs md:text-sm font-medium text-blue-400 focus:ring-3 focus:outline-hidden cursor-pointer">
                            <span
                                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>

                            <span
                                class="relative block border border-current bg-white px-6 py-3 rounded-full flex items-center gap-2">
                                <i class="fas fa-calendar-alt"></i>
                                Lihat Seminar
                            </span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('img/people.png') }}" alt="App Screenshot" class="">
                </div>
            </div>
        </section>
        {{-- pentingnya seminar --}}
        <section class="text-center py-20 px-4 md:px-0 max-w-7xl mx-auto">
            <h2 class="text-xl md:text-3xl lg:text-4xl font-bold mb-4 text-gray-800">
                Kenapa <span class="text-blue-400">Event Penting</span> bagi Jenjang<span class="text-blue-400">
                    Karirmu</span>
            </h2>
            <p class="text-gray-600 mb-16  md:text-lg mx-auto">
                Berikut ini adalah manfaat yang akan kamu dapatkan jika aktif bergabung dalam Seminar Metting.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Card 1 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl border border-gray-300 transition-shadow duration-300 group">
                    <img src="{{ asset('img/satu.png') }}" alt="Upgrade"
                        class="w-20 h-20 mx-auto mb-6 transition-transform duration-300 group-hover:scale-110">
                    <h3 class="text-xl font-semibold mb-3 text-blue-400">Upgrade Kemampuan Teknis</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Banyak pembicara yang sudah lama di dunia IT dari berbagai bidang, sehingga Anda dapat memilih event
                        yang sesuai dengan kemampuan/minat anda.
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl border border-gray-300 transition-shadow duration-300 group">
                    <img src="{{ asset('img/dua.png') }}" alt="Jaringan"
                        class="w-20 h-20 mx-auto mb-6 transition-transform duration-300 group-hover:scale-110">
                    <h3 class="text-xl font-semibold mb-3 text-blue-400">Bangun Jaringan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Event dihadiri oleh pembicara yang top dan peserta dari berbagai daerah, sehingga Anda bisa
                        membangun relasi dengan mereka.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl border border-gray-300 transition-shadow duration-300 group">
                    <img src="{{ asset('img/tiga.png') }}" alt="Update"
                        class="w-20 h-20 mx-auto mb-6 transition-transform duration-300 group-hover:scale-110">
                    <h3 class="text-xl font-semibold mb-3 text-blue-400">Up-to-Date Perkembangan Teknologi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Materi yang dibawakan sesuai perkembangan IT saat ini, sehingga Anda tidak ketinggalan perkembangan
                        teknologi terkini.
                    </p>
                </div>
            </div>
        </section>
        {{-- container max-w-7xl --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto">
            {{-- card seminar --}}
            <section>
                <div class="py-12 md:py-16 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        Seminar Terbaru
                    </h1>
                    <p class="text-gray-600 text-lg md:py-2">
                        Kami menghadirkan seminar-seminar menarik yang memberikan wawasan dan inspirasi terbaik untuk Anda
                    </p>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @forelse ($seminars as $seminar)
                            <div class="swiper-slide px-4">
                                <x-card-seminar :seminar="$seminar" />
                            </div>
                        @empty
                            <div class="w-full flex justify-center items-center py-10 px-4">
                                <div class="text-center text-gray-500 space-y-3">
                                    <i class="fas fa-calendar-times text-4xl md:text-5xl text-gray-400"></i>
                                    <p class="text-base md:text-lg font-medium">Belum ada data seminar.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Swiper Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </section>

            {{-- card pembicara --}}
            <section class="mt-20">
                <div class="py-12 md:py-16 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        Pembicara Top
                    </h1>
                    <p class="text-gray-600 text-lg md:py-2">
                        Dapatkan wawasan eksklusif dari para ahli dan tokoh inspiratif di bidangnya
                    </p>
                </div>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @forelse ($pembicaras as $pembicara)
                            <div class="swiper-slide px-4">
                                <x-card-pembicara :pembicara="$pembicara" />
                            </div>
                        @empty
                            <p class="text-center col-span-3 text-gray-500">Belum ada data pembicara.</p>
                        @endforelse
                    </div>

                    <!-- Swiper Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>

            {{-- card moderator --}}
            <section class="mt-20">
                <div class="py-12 md:py-16 text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-400 ">
                        moderator Top
                    </h1>
                    <p class="text-gray-600 text-lg md:py-2">
                        Dipandu oleh moderator berpengalaman untuk menjaga diskusi tetap menarik dan informatif
                    </p>
                </div>
                <div class="swiper mySwiper3 ">
                    <div class="swiper-wrapper">
                        @forelse ($moderators as $moderator)
                            <div class="swiper-slide px-4">
                                <x-card-moderator :moderator="$moderator" />
                            </div>
                        @empty
                            <p class="text-center col-span-3 text-gray-500">Belum ada data moderator.</p>
                        @endforelse
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
