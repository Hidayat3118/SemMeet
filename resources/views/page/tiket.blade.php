@extends('layouts.layout')

@section('konten')
    <main>
        <x-header />

        <div class="max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
            <div class="w-full max-w-4xl mx-auto border rounded-xl shadow-lg overflow-hidden font-mono">
                {{-- Header --}}
                <div class="bg-blue-400 text-white px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold tracking-wider">TICKET SEMINAR</h2>
                    <span class="text-sm uppercase font-semibold tracking-wider">Boarding Pass</span>
                </div>

                {{-- Content --}}
                <div class="grid md:grid-cols-3 grid-cols-1 gap-6 px-6 py-6 bg-white">
                    {{-- Passenger Info --}}
                    <div class="space-y-5 md:col-span-2 ">
                        <div class=" grid grid-cols-2">
                            <div>
                                <div class="text-xs font-bold text-gray-500 uppercase">Judul Seminar</div>
                                <div class="text-base font-semibold text-gray-800 tracking-wide">
                                    {{ $pendaftaran->seminar->judul }}</div>
                            </div>
                            <div class="">
                                <div class="text-xs font-bold text-gray-500 uppercase">Nama Peserta</div>
                                <div class="text-base font-semibold text-gray-800 tracking-wide">
                                    {{ $pendaftaran->peserta->user->name }}</div>
                            </div>
                        </div>

                        <div class=" grid grid-cols-2">
                            <div>
                                <div class="text-xs font-bold text-gray-500 uppercase">Lokasi</div>
                                <div class="text-base font-semibold text-gray-800 tracking-wide">
                                    {{ $pendaftaran->seminar->lokasi ?? '-' }}</div>
                            </div>
                            {{-- <div class="">
                                <div class="text-xs font-bold text-gray-500 uppercase">Name of Passenger</div>
                                <div class="text-base font-semibold text-gray-800 tracking-wide">James Doe</div>
                            </div> --}}
                        </div>

                        <div class="grid grid-cols-2 ">
                            <div>
                                <div class="text-xs font-bold text-gray-500 uppercase">Tanggal Seminar</div>
                                <div class="text-sm font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($pendaftaran->seminar->tanggal)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-xs font-bold text-gray-500 uppercase">Waktu Mulai</div>
                                    <div class="text-sm font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($pendaftaran->seminar->waktu_mulai)->format('H:i') }} WITA
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-500 uppercase">Waktu Selesai</div>
                                    <div class="text-sm font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($pendaftaran->seminar->waktu_selesai)->format('H:i') }}
                                        WITA
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs  mt-6 tracking-wider mt-10">
                            Datang Ke Seminar 15 Menit Sebelum Mulai
                        </div>
                    </div>

                    {{-- QR Code --}}
                    <div class="flex justify-center items-center">
                        {!! QrCode::format('svg')->size(300)->generate($karcis->qr_code) !!}
                    </div>
                </div>
            </div>
        </div>

        <x-footer />
    </main>
@endsection
