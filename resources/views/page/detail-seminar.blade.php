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
                        <img src="https://assets.cdn.dicoding.com/original/event/dos-elevaite_x_dicoding_live_1_unlocking_ai_kunci_teknologi_talenta_masa_depan_logo_170125170540.png"
                            alt="Poster" class="w-full h-[400px] md:h-[700px] rounded-lg mb-6 overflow-hidden object-cover">
                    </div>
                    {{-- judul + deskripsi --}}
                    <div>
                        <h3 class="text-3xl font-bold text-blue-400 mb-2">
                            Data Driven Future: Kuasai Data Science dengan Platform Azure
                        </h3>
                        <h2 class="text-2xl font-semibold text-gray-800 my-4">Deskripsi</h2>
                        <p class="text-gray-700 mb-4">
                            Seminar ini akan membawa kamu menjelajahi dunia Data Science secara mendalam, mulai dari
                            pengenalan
                            konsep dasar hingga implementasi nyata dalam dunia industri. Kamu akan memahami bagaimana data
                            dapat
                            menjadi aset penting dalam pengambilan keputusan serta bagaimana teknologi cloud seperti
                            Microsoft
                            Azure mampu mempercepat proses analisis dan visualisasi data secara efektif.
                            <br><br>
                            Bersama para ahli di bidangnya, seminar ini juga akan membahas berbagai tools dan layanan Azure
                            yang
                            mendukung pengembangan solusi berbasis data. Tidak hanya itu, kamu juga akan mendapatkan insight
                            mengenai peluang karier di era digital saat ini, khususnya di bidang Data Science yang semakin
                            dibutuhkan oleh berbagai sektor industri.
                            <br><br>
                            Cocok bagi mahasiswa, profesional muda, atau siapa saja yang ingin meningkatkan pemahaman mereka
                            terhadap teknologi data modern dan mempersiapkan diri untuk tantangan dunia kerja masa depan.
                        </p>

                    </div>
                </div>
                {{-- Kanan --}}
                <div class="space-y-6">

                    <div class="space-y-2 text-sm text-gray-800">
                        <h3 class="text-xl md:text-2xl lg:text-3xl my-4 font-semibold">Informasi Seminar</h3>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Tanggal</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>21 Maret 2025</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Waktu</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>15:30 - 17:00 WIB</span>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Moderator</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>ilmi.barokah</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Pembicara</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>agus.suparno</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Harga</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>Gratis</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Status</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>Online</span></div>
                        </div>

                        <div class="flex">
                            <div class="w-28 font-medium text-gray-600">Lokasi</div>
                            <div class="flex items-baseline"><span class="mr-2">:</span> <span>Online (Zoom)</span></div>
                        </div>
                    </div>



                    {{-- Kouta --}}
                    <div class="font-semibold">
                        <h3 class="text-xl md:text-2xl lg:text-3xl my-4 font-semibold">Kouta Peserta</h3>
                        <p><span class="">Kouta :</span> 100</p>
                        <p><span class="">Sisa Kouta :</span> 50</p>
                    </div>
                    {{-- Keikutsertaan --}}
                    <div class="">
                        <h3 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-800 mb-2">Keikutsertaan</h3>
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
                        <h3 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-800 mb-4">Jadwal Pelaksanaan</h3>
                        <div class="text-sm text-gray-700 space-y-1 font-semibold">
                            <p><strong>Mulai:</strong>15:30</p>
                            <p><strong>Selesai:</strong>17:00</p>
                        </div>
                    </div>

                    <div class="">
                        <h3 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-800 mb-4">Lokasi</h3>
                        <p class="text-sm text-gray-700">
                            📍 LIVE at <span class="text-pink-500 font-semibold">Zoom</span><br>
                            <span class="text-sm text-gray-500">Online</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </main>
@endsection
