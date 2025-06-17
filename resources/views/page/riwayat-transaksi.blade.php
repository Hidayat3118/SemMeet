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
                            <th class="py-3 px-4 border-b">Jumlah Pembayaran</th>
                            <th class="py-3 px-4 border-b">Status Pembayaran</th>
                            <th class="py-3 px-4 border-b">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">

                        @forelse($riwayat as $index => $data)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 border-b">{{ $data->seminar->judul ?? '-' }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{ \Carbon\Carbon::parse($data->seminar->created_at ?? '-')->format('d-M-Y') }}
                                </td>
                                <td class="py-3 px-4 border-b">Rp.
                                    {{ number_format($data->payment->first()->jumlah_pembayaran ?? '-', 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 border-b">{{ $data->status ?? '-' }}</td>
                                <td class="py-3 px-4 border-b"> <a href=""><i
                                            class="fa-solid fa-eye cursor-pointer"></i></a></td>
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="5" class="py-3 px-4 border-b">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                        <!-- Tambahkan baris lainnya di sini jika perlu -->
                    </tbody>

                </table>
            </div>
        </div>
    </main>
</x-app-layout>
