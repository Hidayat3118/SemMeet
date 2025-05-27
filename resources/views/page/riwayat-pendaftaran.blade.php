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
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-3 px-4 border-b">No.</th>
                            <th class="py-3 px-4 border-b">Nama</th>
                            <th class="py-3 px-4 border-b">Email</th>
                            <th class="py-3 px-4 border-b">Judul Seminar</th>
                            <th class="py-3 px-4 border-b">Status Pendaftaran</th>
                            <th class="py-3 px-4 border-b">Metode Pembayaran</th>
                            <th class="py-3 px-4 border-b">Jumlah Biaya</th>
                            <th class="py-3 px-4 border-b">Waktu Pendaftaran</th>
                            <th class="py-3 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($riwayat as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->peserta->user->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->peserta->user->email }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->seminar->judul }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->status }}</td>
                                <td class="py-3 px-4 border-b">
                                    <span
                                        class="inline-block px-2 py-1 bg-yellow-200 text-yellow-800 rounded text-sm font-medium">None</span>
                                </td>
                                <td class="py-3 px-4 border-b">{{ $item->seminar->harga }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->created_at->format('d M Y H:i') }} WITA</td>
                                 <td class="py-3 px-4 border-b"> <a href=""><i class="fa-solid fa-eye cursor-pointer"></i></a></td>
                            </tr>

                        @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="5" class="py-3 px-4 border-b">Belum ada pendaftaran.</td>
                            </tr>
                        @endforelse

                        <!-- Duplikasi baris jika ingin menampilkan data lainnya -->
                        <!-- <tr>...</tr> -->
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</x-app-layout>
