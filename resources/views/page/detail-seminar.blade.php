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
                            Seminar ini akan membawa kamu menjelajahi dunia Data Science secara mendalam, mulai dari pengenalan
                            konsep dasar hingga implementasi nyata dalam dunia industri. Kamu akan memahami bagaimana data dapat
                            menjadi aset penting dalam pengambilan keputusan serta bagaimana teknologi cloud seperti Microsoft
                            Azure mampu mempercepat proses analisis dan visualisasi data secara efektif.
                            <br><br>
                            Bersama para ahli di bidangnya, seminar ini juga akan membahas berbagai tools dan layanan Azure yang
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
                    <div class="space-y-1 text-sm text-gray-700">
                        <h3 class="text-2xl my-4 font-semibold">Informasi Seminar</h3>
                        <p><span class="font-semibold">Tanggal :</span> 21 Maret 2025</p>
                        <p><span class="font-semibold">Waktu :</span> 15:30 - 17:00 WIB</p>
                        <p><span class="font-semibold">Moderator :</span> ilmi.barokah</p>
                        <p><span class="font-semibold">Pembicara :</span> agus.suparno</p>
                        <p><span class="font-semibold">Harga :</span> Gratis</p>
                        <p><span class="font-semibold">Status :</span> Online</p>
                        <p><span class="font-semibold">Lokasi :</span> Online (Zoom)</p>
                    </div>
                    {{-- Kouta --}}
                    <div class="">
                        <h3 class="text-2xl my-4 font-semibold">Kouta Peserta</h3>
                        <p><span class="font-semibold">Kouta :</span> 100</p>
                        <p><span class="font-semibold">Sisa Kouta :</span> 50</p>
                    </div>
                    {{-- Keikutsertaan --}}
                    <div class="">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Keikutsertaan</h3>
                        <p class="text-sm text-gray-600 mb-4">Silakan daftar ke acara seminar untuk mendapatkan pengalaman
                            belajar yang berharga.</p>
                        <button class="w-full bg-blue-500 text-white py-2 rounded-full cursor-pointer" disabled>
                            Daftar
                        </button>
                    </div>
                    {{-- jadwal --}}
                    <div class="">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Jadwal Pelaksanaan</h3>
                        <div class="text-sm text-gray-700 space-y-1">
                            <p><strong>Mulai:</strong>15:30</p>
                            <p><strong>Selesai:</strong>17:00</p>
                        </div>
                    </div>
    
                    <div class="">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Lokasi</h3>
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

