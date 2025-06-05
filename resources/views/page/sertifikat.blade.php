<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sertifikat') }}
        </h2>
    </x-slot>

    <main class="">
        <main class="max-w-2xl lg:max-w-7xl mx-auto py-20">
            <div class="container mx-auto p-6">
                <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                    <table class="min-w-full text-left border border-gray-200">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="py-3 px-4 border-b">No</th>
                                <th class="py-3 px-4 border-b">Nama Peserta</th>
                                <th class="py-3 px-4 border-b">Judul Seminar</th>
                                <th class="py-3 px-4 border-b">Pembicara</th>
                                <th class="py-3 px-4 border-b">Waktu Seminar</th>
                                <th class="py-3 px-4 border-b">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse ($sertifikats as $index => $sertifikat)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 border-b">
                                        {{ $sertifikat->pendaftaran->peserta->user->name }}</td>
                                    <td class="py-3 px-4 border-b">{{ $sertifikat->pendaftaran->seminar->judul }}</td>
                                    <td class="py-3 px-4 border-b">
                                        {{ $sertifikat->pendaftaran->seminar->pembicara->user->name }}
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        {{ \Carbon\Carbon::parse($sertifikat->pendaftaran->seminar->waktu)->translatedFormat('d F Y - H:i') }}
                                        WITA</td>
                                    <td class="py-3 px-4 border-b"> <a
                                            href="{{ route('sertifikat.view', $sertifikat->id) }}"><i
                                                class="fa-solid fa-eye cursor-pointer"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada sertifikat.</td>
                                </tr>
                            @endforelse
                            <!-- Tambahkan baris lainnya di sini jika perlu -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </main>
</x-app-layout>
