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
                           
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">

                        @forelse($riwayat as $index => $data)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 border-b">{{ $data->seminar->judul ?? '-' }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{ \Carbon\Carbon::parse($data->seminar->created_at ?? now())->format('d-M-Y') }}
                                </td>

                                {{-- Jumlah Pembayaran --}}
                                @php
                                    $pembayaran = $data->payment->first();
                                @endphp
                                <td class="py-3 px-4 border-b">
                                    @if ($pembayaran && is_numeric($pembayaran->jumlah_pembayaran))
                                        Rp. {{ number_format((int) $pembayaran->jumlah_pembayaran, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-400 italic">Belum membayar</span>
                                    @endif
                                </td>

                                {{-- Status Pembayaran --}}
                                <td class="py-3 px-4 border-b">
                                    @php $status = $data->status ?? 'unknown'; @endphp
                                    <span class="inline-block px-2 py-1 text-sm rounded
                                        @if ($status === 'paid')
                                            bg-green-100 text-green-700
                                        @elseif ($status === 'pending')
                                            bg-yellow-100 text-yellow-700
                                        @else
                                            bg-gray-200 text-gray-700
                                        @endif">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                               
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="6" class="py-3 px-4 border-b text-center text-gray-500">
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-app-layout>
