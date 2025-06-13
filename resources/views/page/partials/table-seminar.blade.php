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
            @forelse ($riwayat as $index => $data)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 border-b">{{ $data->judul ?? $data->seminar->judul }}</td>
                    <td class="py-3 px-4 border-b">
                        {{ \Carbon\Carbon::parse($data->tanggal ?? $data->seminar->created_at)->format('d-M-Y') }}
                    </td>
                    <td class="py-3 px-4 border-b">
                        {{ \Carbon\Carbon::parse($data->waktu_mulai ?? $data->seminar->waktu_mulai)->format('H:i') }} WITA
                    </td>
                    <td class="py-3 px-4 border-b">
                        {{ \Carbon\Carbon::parse($data->waktu_selesai ?? $data->seminar->waktu_selesai)->format('H:i') }} WITA
                    </td>
                    <td class="py-3 px-4 border-b">{{ $data->lokasi ?? $data->seminar->lokasi }}</td>
                    <td class="py-3 px-4 border-b">
                        {{ $data->moderator->user->name ?? $data->seminar->moderator->user->name ?? '-' }}
                    </td>
                    <td class="py-3 px-4 border-b">
                        {{ $data->pembicara->user->name ?? $data->seminar->pembicara->user->name ?? '-' }}
                    </td>
                    <td class="py-3 px-4 border-b">
                        <a href="{{ route('seminar.show', $data->id ?? $data->seminar->id) }}">
                            <i class="fa-solid fa-eye cursor-pointer"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada seminar</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
