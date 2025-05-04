<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Peserta
        $peserta = User::create([
            'name' => 'Bahauddin Arif',
            'email' => 'bahauddin@gmail.com',
            'password' => bcrypt('password123'),
        ]);
        $peserta->assignRole('peserta');
        $peserta->peserta()->create([
            'alamat' => 'Jl. Merdeka No.12, Banjarmasin',
            'instansi' => 'Politeknik Negeri Banjarmasin',
        ]);

        // Pembicara
        $pembicara = User::create([
            'name' => 'Dr. H. Dayat',
            'email' => 'dayat.pembicara@gmail.com',
            'password' => bcrypt('pembicara123'),
        ]);
        $pembicara->assignRole('pembicara');
        $pembicara->pembicara()->create([
            'instansi' => 'Universitas Indonesia',
            'bio' => 'Seorang dosen dan penulis aktif di bidang teknologi informasi.',
            'pengalaman' => 'Pernah menjadi pembicara di lebih dari 20 konferensi nasional.',
        ]);

        // Moderator
        $moderator = User::create([
            'name' => 'Ayu Rahmawati',
            'email' => 'ayu.moderator@gmail.com',
            'password' => bcrypt('moderator123'),
        ]);
        $moderator->assignRole('moderator');
        $moderator->moderator()->create([
            'instansi' => 'Event Organizer Nasional',
            'bio' => 'Berpengalaman menjadi moderator acara nasional dan internasional.',
            'pengalaman' => '5 tahun aktif menjadi moderator di berbagai event besar.',
        ]);

         // Keuangan
         $keuangan = User::create([
            'name' => 'Rina Putri',
            'email' => 'rina.keuangan@gmail.com',
            'password' => bcrypt('keuangan123'),
        ]);
        $keuangan->assignRole('keuangan');
        $keuangan->keuangan()->create(); // Relasi Keuangan

        // Panitia
        $panitia = User::create([
            'name' => 'Doni Saputra',
            'email' => 'doni.panitia@gmail.com',
            'password' => bcrypt('panitia123'),
        ]);
        $panitia->assignRole('panitia');
        $panitia->panitia()->create(); // Relasi Panitia
        
    }
}
