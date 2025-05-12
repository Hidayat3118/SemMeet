<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // 5 peserta
        for ($i = 1; $i <= 5; $i++) {
            $peserta = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('peserta123'),
            ]);
            $peserta->assignRole('peserta');
            $peserta->peserta()->create([
                // 'foto' => $faker->imageUrl(300, 300, 'people'), // Menambahkan gambar acak
                'alamat' => $faker->address,
                'instansi' => $faker->company,
            ]);
        }

        // 5 pembicara
        for ($i = 1; $i <= 5; $i++) {
            $pembicara = User::create([
                'name' => 'Dr. ' . $faker->name,
                'email' => 'pembicara' . $i . '@gmail.com',
                'password' => bcrypt('pembicara123'),
            ]);
            $pembicara->assignRole('pembicara');
            $pembicara->pembicara()->create([
                // 'foto' => $faker->imageUrl(300, 300, 'people'), // Menambahkan gambar acak
                'instansi' => $faker->company,
                'bio' => $faker->paragraph,
                'pengalaman' => $faker->sentence,
            ]);
        }

        // 5 moderator
        for ($i = 1; $i <= 5; $i++) {
            $moderator = User::create([
                'name' => 'Ayu Rahmawati ' . $i,
                'email' => 'moderator' . $i . '@gmail.com',
                'password' => bcrypt('moderator123'),
            ]);
            $moderator->assignRole('moderator');
            $moderator->moderator()->create([
                // 'foto' => $faker->imageUrl(300, 300, 'people'), // Menambahkan gambar acak
                'instansi' => 'Event Organizer Nasional',
                'bio' => 'Berpengalaman menjadi moderator acara nasional dan internasional.',
                'pengalaman' => '5 tahun aktif menjadi moderator di berbagai event besar.',
            ]);
        }

        // Keuangan - 1 
        $keuangan = User::create([
            'name' => 'Rina Putri',
            'email' => 'rina.keuangan@gmail.com',
            'password' => bcrypt('keuangan123'),
        ]);
        $keuangan->assignRole('keuangan');
        $keuangan->keuangan()->create(); // Relasi Keuangan

        // Panitia - 1 
        $panitia = User::create([
            'name' => 'Doni Saputra',
            'email' => 'doni.panitia@gmail.com',
            'password' => bcrypt('panitia123'),
        ]);
        $panitia->assignRole('panitia');
        $panitia->panitia()->create(); // Relasi Panitia
    }
}
