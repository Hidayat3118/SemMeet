@extends('layouts.layout')

@section('konten')
    <main class="bg-blue-500 ">
        <x-header />

        <div class="max-w-full mx-auto md:mt-24 py-20 px-4 my-8 bg-blue-500">
            <div class=" mx-auto w-[320px] rounded-xl p-4 text-center">
                <h1 class="text-lg font-semibold mb-2 text-white">QR Code and Barcode Scanner</h1>
                <div class="bg-white py-10 rounded-xl">
                    <!-- Judul -->

                    <!-- Petunjuk -->
                    <p class="text-sm mb-4 px-4">
                        Tekan Tombol Scan dan Arahkan Kamera ke Barcode ataupun QR Code
                    </p>

                    <!-- Tampilan QR Code -->
                    <!-- QR Code + Sudut scanner -->
                    <div
                        class="relative w-[200px] h-[200px] bg-white mx-auto mb-6 flex items-center justify-center rounded-md">
                        <!-- QR Code -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?data=ContohKode123&size=150x150"
                            alt="QR Code" />

                        <!-- Sudut scanner biru -->
                        <div class="absolute top-0 left-0 w-5 h-5 border-t-4 border-l-4 border-blue-500 rounded-none"></div>
                        <div class="absolute top-0 right-0 w-5 h-5 border-t-4 border-r-4 border-blue-500 rounded-none"></div>
                        <div class="absolute bottom-0 left-0 w-5 h-5 border-b-4 border-l-4 border-blue-500 rounded-none">
                        </div>
                        <div class="absolute bottom-0 right-0 w-5 h-5 border-b-4 border-r-4 border-blue-500 rounded-none">
                        </div>
                    </div>
                </div>
                <!-- Tombol Scan -->
                <button
                    class=" mt-4 bg-transparent border border-white text-white py-2 px-8 rounded-full hover:bg-white hover:text-blue-500 transition">
                    SCAN
                </button>
            </div>
        </div>

        <x-footer />
    </main>
@endsection
