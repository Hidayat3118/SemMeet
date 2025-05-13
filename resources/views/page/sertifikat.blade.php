<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sertifikat') }}
        </h2>
    </x-slot>

    <main class="py-12">
        <main class="max-w-2xl lg:max-w-7xl mx-auto py-20">
            <div class="container mx-auto p-6">
                <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                    <table class="min-w-full text-left border border-gray-200">
                        <thead class="bg-blue-100 text-blue-400">
                            <tr>
                                <th class="py-3 px-4 border-b">No</th>
                                <th class="py-3 px-4 border-b">Nama Peserta</th>
                                <th class="py-3 px-4 border-b">Judul Seminar</th>
                                <th class="py-3 px-4 border-b">Pembicara</th>
                                <th class="py-3 px-4 border-b">Waktu Seminar</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">1</td>
                                <td class="py-3 px-4 border-b">Anurchan Ghozali</td>
                                <td class="py-3 px-4 border-b">Cara Membuat Tampilan Web yang Modern</td>
                                <td class="py-3 px-4 border-b">Ahmad Biawak Ramadan</td>
                                <td class="py-3 px-4 border-b">23 Juni 2025 - 08:00 WIB</td>
                            </tr>

                            <!-- Tambahkan baris lainnya di sini jika perlu -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </main>
</x-app-layout>
