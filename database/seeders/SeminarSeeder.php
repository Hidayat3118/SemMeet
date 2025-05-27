<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seminar;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SeminarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // OFFLINE 3
            [
                'judul' => 'Teknologi Cloud Computing',
                'deskripsi' => 'Memahami dasar-dasar dan implementasi cloud di industri.',
                'mode' => 'offline',
                'lokasi' => 'Swiss-Belhotel Borneo Banjarmasin - Jl. Pangeran Antasari No.86A, Banjarmasin.',
            ],
            [
                'judul' => 'Cybersecurity Awareness',
                'deskripsi' => 'Tips dan teknik melindungi data pribadi dan organisasi.',
                'mode' => 'offline',
                'lokasi' => 'FUGO Hotel Banjarmasin - Jl. Ahmad Yani Km 2, Banjarmasin.',
            ],
            [
                'judul' => 'Digital Marketing Strategy',
                'deskripsi' => 'Strategi pemasaran digital yang efektif.',
                'mode' => 'offline',
                'lokasi' => 'Gedung Serbaguna Raya - Jl. Pangeran Hidayatullah No.01 RT.15, Kel. Benua Anyar, Banjarmasin.',
            ],
            // ONLINE 2
            [
                'judul' => 'AI dan Machine Learning',
                'deskripsi' => 'Penerapan AI dalam kehidupan sehari-hari.',
                'mode' => 'online',
                'metting_link' => 'https://zoom.us/' . Str::random(10),
            ],
            [
                'judul' => 'Workshop Laravel Dasar',
                'deskripsi' => 'Belajar Laravel dari nol hingga CRUD.',
                'mode' => 'online',
                'metting_link' => 'https://zoom.us/' . Str::random(10),
            ],
        ];

        foreach ($data as $i => $item) {
            Seminar::create([
                'foto' => null,
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'mode' => $item['mode'],
                'harga' => rand(0, 300000),
                'status' => ['draft', 'aktif', 'selesai'][rand(0, 2)],
                'waktu_mulai' => Carbon::now()->addDays($i + 1),
                'waktu_selesai' => Carbon::now()->addDays($i + 1)->addHours(2),
                'lokasi' => $item['mode'] === 'offline' ? $item['lokasi'] : null,
                'metting_link' => $item['mode'] === 'online' ? $item['metting_link'] : null,
                'kouta' => rand(50, 100),
                'keuangan_id' => 1,
                'panitia_id' => null,
                'moderator_id' => rand(1, 5),
                'pembicara_id' => rand(1, 5),
                'kategori_id' => rand(1, 5),
            ]);
        }
    }
}
