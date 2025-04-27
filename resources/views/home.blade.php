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
                    <p class="text-md md:text-xl mt-4">
                        SemMet platform informasi dan edukasi bantu Anda terhubung di berbagai
                        seminar dan acara inspiratif. Temukan wawasan baru, kembangkan diri, dan jadilah bagian dari
                        komunitas yang terus bersinar.
                    </p>
                    <div class="flex space-x-2 justify-center md:justify-start">
                        <a class="group relative inline-block text-sm font-medium text-white focus:ring-3 focus:outline-hidden cursor-pointer" href="{{ route('register') }}">
                            <span
                                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>

                            <span
                                class="relative block border border-current bg-blue-500 px-6 py-3 rounded-full">Daftar Sekarang</span>
                        </a>
                        <a href="/seminar"
                            class="group relative inline-block text-sm font-medium text-blue-400 focus:ring-3 focus:outline-hidden cursor-pointer">
                            <span
                                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>

                            <span class="relative block border border-current bg-white px-6 py-3 rounded-full">Lihat
                                Seminar</span>
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
                  Kenapa <span class="text-blue-400">Event Penting</span> bagi Jenjang Karirmu
                </h2>
                <p class="text-gray-600 mb-16  md:text-lg mx-auto">
                  Berikut ini adalah manfaat yang akan kamu dapatkan jika aktif bergabung dalam Seminar Metting.
                </p>
            
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                  <!-- Card 1 -->
                  <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl border border-gray-300 transition-shadow duration-300 group">
                    <img src="https://cdn-icons-png.flaticon.com/512/158/158737.png" alt="Upgrade" class="w-20 h-20 mx-auto mb-6 transition-transform duration-300 group-hover:scale-110">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Upgrade Kemampuan Teknis</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                      Banyak pembicara yang sudah lama di dunia IT dari berbagai bidang, sehingga Anda dapat memilih event yang sesuai dengan kemampuan/minat anda.
                    </p>
                  </div>
            
                  <!-- Card 2 -->
                  <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl border border-gray-300 transition-shadow duration-300 group">
                    <img src="https://cdn-icons-png.flaticon.com/512/25/25363.png" alt="Jaringan" class="w-20 h-20 mx-auto mb-6 transition-transform duration-300 group-hover:scale-110">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Bangun Jaringan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                      Event dihadiri oleh pembicara yang top dan peserta dari berbagai daerah, sehingga Anda bisa membangun relasi dengan mereka.
                    </p>
                  </div>
            
                  <!-- Card 3 -->
                  <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl border border-gray-300 transition-shadow duration-300 group">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828673.png" alt="Update" class="w-20 h-20 mx-auto mb-6 transition-transform duration-300 group-hover:scale-110">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Up-to-Date Perkembangan Teknologi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                      Materi yang dibawakan sesuai perkembangan IT saat ini, sehingga Anda tidak ketinggalan perkembangan teknologi terkini.
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
                             @foreach (range(1, 5) as $i)
                            <div class="swiper-slide px-4 md:px-0">
                                <a href="/detail-seminar">
                                    <x-card-seminar
                                        gambar="https://assets.cdn.dicoding.com/original/event/dos-elevaite_x_dicoding_live_1_unlocking_ai_kunci_teknologi_talenta_masa_depan_logo_170125170540.png"
                                        judul="Judul {{ $i }}" waktu="12 Juli 2025"
                                        deskripsi="Pelajari bagaimana kecerdasan buatan membentuk masa depan teknologi dan peran talenta digital dalam ekosistem AI. Seminar ini menghadirkan para ahli industri untuk membahas tren, tantangan, dan peluang karier di era AI." />
                                </a>
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
                    @foreach (range(1, 5) as $i)
                        <div class="swiper-slide px-4 md:px-0">
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
                    @foreach (range(1, 5) as $i)
                        <div class="swiper-slide px-4 md:px-0">
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
