<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sertifikat') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white p-6 shadow rounded-xl">
            <h3 class="text-2xl font-bold mb-4">Sertifikat Seminar</h3>

            <p><strong>Nama Peserta:</strong> {{ $sertifikat->pendaftaran->peserta->user->name }}</p>
            <p><strong>Judul Seminar:</strong> {{ $sertifikat->pendaftaran->seminar->judul }}</p>
            <p><strong>Pembicara:</strong> {{ $sertifikat->pendaftaran->seminar->pembicara->user->name }}</p>
            <p><strong>Tanggal:</strong>
                {{ \Carbon\Carbon::parse($sertifikat->pendaftaran->seminar->waktu)->translatedFormat('d F Y - H:i') }}
                WIB
            </p>

            <div class="mt-6">
                <a href="{{ route('sertifikat.download', $sertifikat->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                    Download PDF
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
