<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ===== PESERTA =====
        $pesertaData = [
            ['name' => 'Rizky Maulana', 'email' => 'rizky.peserta@gmail.com'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti.peserta@gmail.com'],
            ['name' => 'Andi Saputra', 'email' => 'andi.peserta@gmail.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi.peserta@gmail.com'],
            ['name' => 'Teguh Prabowo', 'email' => 'teguh.peserta@gmail.com'],
        ];

        foreach ($pesertaData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('peserta123'),
            ]);
            $user->assignRole('peserta');
            $user->peserta()->create([
                'alamat' => 'Jl. Contoh Alamat No. 1',
                'instansi' => 'Poli Teknik Negeri Banjarmasin',
            ]);
        }

        // ===== PEMBICARA =====
        $pembicaraData = [
            ['name' => 'Dr. Hendra Saputra', 'email' => 'hendra.pembicara@gmail.com'],
            ['name' => 'Dr. Maya Sari', 'email' => 'maya.pembicara@gmail.com'],
            ['name' => 'Dr. Anton Wijaya', 'email' => 'anton.pembicara@gmail.com'],
            ['name' => 'Dr. Nia Ramadhani', 'email' => 'nia.pembicara@gmail.com'],
            ['name' => 'Dr. Budi Santoso', 'email' => 'budi.pembicara@gmail.com'],
        ];

        foreach ($pembicaraData as $index => $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('pembicara123'),
            ]);
            $user->assignRole('pembicara');
            $user->pembicara()->create([
                'instansi' => 'PT Bank Central Asia Tbk',
                'bio' => 'Seorang ahli di bidang Teknologi Informasi dengan keahlian dalam pengembangan sistem, keamanan data.',
                'pengalaman' => 'Berpengalaman lebih dari 10 tahun di bidangnya.',
                'kategori_id' => $index + 1, // asumsi kategori_id dari 1 sampai 5
            ]);
        }

        // ===== MODERATOR =====
        $moderatorData = [
            ['name' => 'Ayu Rahmawati', 'email' => 'ayu.rahmawati@gmail.com'],
            ['name' => 'Dedi Prasetyo', 'email' => 'dedi.prasetyo@gmail.com'],
            ['name' => 'Fitria Handayani', 'email' => 'fitria.handayani@gmail.com'],
            ['name' => 'Gilang Ramadhan', 'email' => 'gilang.ramadhan@gmail.com'],
            ['name' => 'Hana Putri', 'email' => 'hana.putri@gmail.com'],
        ];

        foreach ($moderatorData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('moderator123'),
            ]);
            $user->assignRole('moderator');
            $user->moderator()->create([
                'instansi' => 'Event Organizer Nasional',
                'bio' => 'Berpengalaman menjadi moderator acara nasional dan internasional di berbagai bidang dan juga wawasan.',
                'pengalaman' => '5 tahun aktif menjadi moderator di berbagai event besar.',
            ]);
        }

        // ===== KEUANGAN =====
        $keuangan = User::create([
            'name' => 'Rina Putri',
            'email' => 'rina.keuangan@gmail.com',
            'password' => bcrypt('keuangan123'),
        ]);
        $keuangan->assignRole('keuangan');
        $keuangan->keuangan()->create();

        // ===== PANITIA =====
        $panitia = User::create([
            'name' => 'Doni Saputra',
            'email' => 'doni.panitia@gmail.com',
            'password' => bcrypt('panitia123'),
        ]);
        $panitia->assignRole('panitia');
        $panitia->panitia()->create();
    }
}
