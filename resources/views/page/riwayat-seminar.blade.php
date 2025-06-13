<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Seminar') }}
        </h2>
    </x-slot>


    <main class="max-w-2xl lg:max-w-7xl mx-auto py-20">

        <div class="container mx-auto p-6">
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                <table class="min-w-full text-left border border-gray-200">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-3 px-4 border-b">No</th>
                            <th class="py-3 px-4 border-b">Judul Seminar</th>
                            <th class="py-3 px-4 border-b">Tanggal</th>
                            <th class="py-3 px-4 border-b">Waktu Mulai</th>
                            <th class="py-3 px-4 border-b">Waktu Selesai</th>
                            <th class="py-3 px-4 border-b">Lokasi</th>
                            <th class="py-3 px-4 border-b">Moderator</th>
                            <th class="py-3 px-4 border-b">Pembicara</th>
                            <th class="py-3 px-4 border-b">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($seminars as $index => $data)
                            @php
                                // Jika peserta, data adalah dari tabel pendaftaran
                                $seminar = $data->seminar ?? $data;
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 border-b">{{ $seminar->judul }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{ \Carbon\Carbon::parse($seminar->created_at)->format('d-M-Y') }}
                                </td>
                                <td class="py-3 px-4 border-b">
                                    {{ \Carbon\Carbon::parse($seminar->waktu_mulai)->format('H:i') }} WITA
                                </td>
                                <td class="py-3 px-4 border-b">
                                    {{ \Carbon\Carbon::parse($seminar->waktu_selesai)->format('H:i') }} WITA
                                </td>
                                <td class="py-3 px-4 border-b">{{ $seminar->lokasi }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{ $seminar->moderator->user->name ?? '-' }}
                                </td>
                                <td class="py-3 px-4 border-b">
                                    {{ $seminar->pembicara->user->name ?? '-' }}
                                </td>
                                <td class="py-3 px-4 border-b">
                                    <a href="{{ route('seminar.show', $seminar->id) }}">
                                        <i class="fa-solid fa-eye cursor-pointer"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="9" class="py-3 px-4 border-b text-center text-gray-500">
                                    Tidak ada seminar
                                </td>
                            </tr>
                        @endforelse
                        <!-- Tambahkan baris lainnya di sini jika perlu -->
                    </tbody>

                </table>
            </div>
        </div>
    </main>
</x-app-layout>
