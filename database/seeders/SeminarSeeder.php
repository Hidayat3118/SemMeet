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
            [
                'judul' => 'Teknologi Cloud Computing',
                'deskripsi' => 'Memahami dasar-dasar dan implementasi cloud di industri.',
                'mode' => 'offline',
                'lokasi' => 'Universitas Lambung Mangkurat, Banjarmasin',
            ],
            [
                'judul' => 'AI dan Machine Learning',
                'deskripsi' => 'Penerapan AI dalam kehidupan sehari-hari.',
                'mode' => 'online',
                'metting_link' => 'https://zoom.us/' . Str::random(10),
            ],
            [
                'judul' => 'Cybersecurity Awareness',
                'deskripsi' => 'Tips dan teknik melindungi data pribadi dan organisasi.',
                'mode' => 'offline',
                'lokasi' => 'STMIK Indonesia Banjarmasin',
            ],
            [
                'judul' => 'UI/UX Design Modern',
                'deskripsi' => 'Tren desain antarmuka terkini untuk web dan mobile.',
                'mode' => 'online',
                'metting_link' => 'https://zoom.us/' . Str::random(10),
            ],
            [
                'judul' => 'Digital Marketing Strategy',
                'deskripsi' => 'Strategi pemasaran digital yang efektif.',
                'mode' => 'offline',
                'lokasi' => 'Balai Kota Banjarmasin',
            ],
            [
                'judul' => 'Pengembangan Aplikasi Mobile',
                'deskripsi' => 'Langkah awal membuat aplikasi Android/iOS.',
                'mode' => 'online',
                'metting_link' => 'https://zoom.us/' . Str::random(10),
            ],
            [
                'judul' => 'IoT dan Smart Home',
                'deskripsi' => 'Penerapan IoT dalam kehidupan rumah tangga.',
                'mode' => 'offline',
                'lokasi' => 'SMK Negeri 1 Banjarmasin',
            ],
            [
                'judul' => 'Pengenalan Data Science',
                'deskripsi' => 'Dasar-dasar analisis data dan visualisasi.',
                'mode' => 'online',
                'metting_link' => 'https://zoom.us/' . Str::random(10),
            ],
            [
                'judul' => 'Etika Profesi IT',
                'deskripsi' => 'Tanggung jawab etis seorang profesional TI.',
                'mode' => 'offline',
                'lokasi' => 'Politeknik Negeri Banjarmasin',
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
                'kouta' => rand(20, 100),
                'keuangan_id' => 1,
                'panitia_id' => null,
                'moderator_id' => 1,
                'pembicara_id' => 1,
                'kategori_id' => rand(1, 5),
            ]);
        }
    }
}
