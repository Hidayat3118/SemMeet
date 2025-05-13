<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Pendaftaran') }}
        </h2>
    </x-slot>

    <main class="max-w-2xl lg:max-w-7xl mx-auto py-20">

        <div class="container mx-auto p-6">
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                <table class="min-w-full text-left border border-gray-200">
                    <thead class="bg-blue-100 text-blue-400">
                        <tr>
                            <th class="py-3 px-4 border-b">Nama</th>
                            <th class="py-3 px-4 border-b">Email</th>
                            <th class="py-3 px-4 border-b">Judul Seminar</th>
                            <th class="py-3 px-4 border-b">Status Pendaftaran</th>
                            <th class="py-3 px-4 border-b">Metode Pembayaran</th>
                            <th class="py-3 px-4 border-b">Jumlah Biaya</th>
                            <th class="py-3 px-4 border-b">Waktu Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 border-b">Ahmad Biawak Ramadan</td>
                            <td class="py-3 px-4 border-b">anurchan@gmail.com</td>
                            <td class="py-3 px-4 border-b">Cara Membuat Tampilan web yang Modern</td>
                            <td class="py-3 px-4 border-b">
                                <span
                                    class="inline-block px-2 py-1 bg-yellow-200 text-yellow-800 rounded text-sm font-medium">Pending</span>
                            </td>
                            <td class="py-3 px-4 border-b">Transfer Bank</td>
                            <td class="py-3 px-4 border-b">Rp 50.000,00</td>
                            <td class="py-3 px-4 border-b">23 Juni 2025 08.00</td>
                        </tr>

                        <!-- Duplikasi baris jika ingin menampilkan data lainnya -->
                        <!-- <tr>...</tr> -->
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</x-app-layout>
