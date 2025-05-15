@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        {{-- hero section --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">

            <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl border border-slate-200 shadow-lg shadow-blue-200">
                <div class="max-w-lg flex justify-center flex-col mx-auto">
                    <h2 class="text-2xl md:text-3xl font-bold text-blue-400 text-center mb-2">Pendaftaran Kamu</h2>
                    <p class="text-center text-gray-500 mb-8 md:mb-12 text-lg md:text-xl md:mt-4 mt-2">Berikut adalah
                        informasi pembayaran
                        yang telah terdaftar atas nama
                        Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-10 max-w-3xl mx-auto md:px-16 ">

                    <!-- Nama -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-user text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Nama</p>
                            <p>{{ $peserta->user->name }}</p>
                        </div>
                    </div>

                    <!-- Judul Seminar -->
                    <div class="flex items-start">
                        <i class="fa-solid fa-chalkboard text-xl text-gray-700 mr-3"></i>
                        <div class=" w-full">
                            <p class="text-blue-400 font-semibold">Judul Seminar</p>
                            <p>a</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-envelope text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Email</p>
                            <p>{{ $peserta->user->email }}</p>
                        </div>
                    </div>

                    <!-- Status Pendaftaran -->
                    <div class="flex items-start">
                        <i class="fa-solid fa-clock-rotate-left text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Status Pendaftaran</p>
                            <span
                                class="inline-block px-4 py-1 mt-1 text-sm font-medium bg-yellow-200 rounded shadow">Pending</span>
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-credit-card text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Metode Pembayaran</p>
                            <p>Transfer Bank</p>
                        </div>
                    </div>

                    <!-- Jumlah Biaya -->
                    <div class="flex items-start">
                        <i class="fa-solid fa-dollar-sign text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Jumlah Biaya</p>
                            <p>a</p>
                        </div>
                    </div>

                    <!-- Waktu Pendaftaran -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-clock  text-gray-700 text-xl mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Waktu Pendaftaran</p>
                            <p>23 Juni 2025 08.00</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between md:px-24 pt-4">
                    <!-- Tombol Kembali -->
                    <div class="mt-10 flex justify-start font-bold">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition">
                            <i class="fa-solid fa-arrow-left mr-2 "></i> Kembali
                        </a>
                    </div>

                    <div
                        class="mt-10 flex items-center justify-center bg-blue-500 py-2 px-4 rounded-full text-white font-bold w-32  cursor-pointer hover:bg-blue-600">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="pl-2">Daftar</span>
                    </div>

                </div>
            </div>




        </div>
        <x-footer></x-footer>
    </main>
@endsection
