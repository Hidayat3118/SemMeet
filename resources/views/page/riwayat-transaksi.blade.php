<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Transaksi') }}
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
                            <th class="py-3 px-4 border-b">Metode Pembayaran</th>
                            <th class="py-3 px-4 border-b">Lokasi</th>
                            <th class="py-3 px-4 border-b">Moderator</th>
                            <th class="py-3 px-4 border-b">Pembicara</th>
                            <th class="py-3 px-4 border-b">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 border-b">1</td>
                            <td class="py-3 px-4 border-b">Cara Membuat Tampilan web yang Modern</td>
                            <td class="py-3 px-4 border-b">23 Juni 2025</td>
                            <td class="py-3 px-4 border-b">08:00</td>
                            <td class="py-3 px-4 border-b">10:00</td>
                            <td class="py-3 px-4 border-b">Transfer Bank</td>
                            <td class="py-3 px-4 border-b">Online via Zoom</td>
                            <td class="py-3 px-4 border-b">Budi Santoso</td>
                            <td class="py-3 px-4 border-b">Ahmad Biawak Ramadan</td>
                            <td class="py-3 px-4 border-b"> <a href=""><i class="fa-solid fa-eye cursor-pointer"></i></a></td>
                        </tr>

                        <!-- Tambahkan baris lainnya di sini jika perlu -->
                    </tbody>

                </table>
            </div>
        </div>
    </main>
</x-app-layout>
