<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Pendaftaran') }}
        </h2>
    </x-slot>

    <main class="max-w-2xl lg:max-w-7xl mx-auto py-20">

        <div class="container mx-auto p-6 ">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                <table class="min-w-full text-left border border-gray-200">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-3 px-4 border-b">No.</th>
                            <th class="py-3 px-4 border-b">Nama</th>
                            <th class="py-3 px-4 border-b">Email</th>
                            <th class="py-3 px-4 border-b">Judul Seminar</th>
                            <th class="py-3 px-4 border-b">Status Pendaftaran</th>
                            <th class="py-3 px-4 border-b">Lokasi</th>
                            <th class="py-3 px-4 border-b">Jumlah Biaya</th>
                            <th class="py-3 px-4 border-b">Waktu Pendaftaran</th>
                            <th class="py-3 px-4 border-b">Detail</th>
                            <th class="py-3 px-4 border-b">Bukti Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($riwayat as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->peserta->user->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->peserta->user->email }}</td>
                                <td class="py-3 px-4 border-b">{{ $item->seminar->judul }}</td>
                                <td class="py-3 px-4 border-b">
                                    <span
                                        class="inline-block px-2 py-1 bg-yellow-200 text-yellow-800 rounded text-sm font-medium">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                @if ($item->status === 'paid' && $item->seminar->mode === 'online')
                                    <td class="py-3 px-4 border-b">{{ $item->seminar->metting_link ?? 'Online' }}</td>
                                @else
                                    <td class="py-3 px-4 border-b">{{ $item->seminar->lokasi ?? 'Online' }}</td>
                                @endif

                                @php $pembayaran = $item->payment->first(); @endphp
                                <td class="py-3 px-4 border-b">
                                    @if ($pembayaran)
                                        Rp. {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-400 italic">Belum membayar</span>
                                    @endif
                                </td>

                                <td class="py-3 px-4 border-b">{{ $item->created_at->format('d M Y H:i') }} WITA</td>
                                <td class="py-3 px-4 border-b">
                                    <a href=""><i class="fa-solid fa-eye cursor-pointer"></i></a>
                                </td>
                                <td class="py-3 px-4 border-b">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/foto_pendaftaran/' . $item->foto) }}"
                                            class="w-16 h-16 object-cover rounded">
                                    @elseif($item->peserta->user->id === Auth::id())
                                        <form action="{{ route('pendaftaran.upload', ['id' => $item->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="foto_validasi" accept="image/*" required
                                                class="text-sm mb-1">
                                            <button type="submit"
                                                class="text-blue-600 underline text-sm">Upload</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 italic text-sm">Belum ada</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="10" class="py-3 px-4 border-b text-center text-gray-500">
                                    Belum ada pendaftaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</x-app-layout>
