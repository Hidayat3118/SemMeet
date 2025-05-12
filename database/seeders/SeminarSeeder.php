<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seminar;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class SeminarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 5; $i++) {
            Seminar::create([
                'foto' => null, 
                'mode' => ['online', 'offline'][rand(0, 1)],
                'judul' => 'Seminar ke-' . $i,
                'deskripsi' => 'Deskripsi lengkap untuk seminar ke-' . $i,
                'harga' => rand(0, 500000),
                'status' => ['draft', 'aktif', 'selesai'][rand(0, 2)],
                'waktu_mulai' => Carbon::now()->addDays($i),
                'waktu_selesai' => Carbon::now()->addDays($i)->addHours(2),
                'lokasi' => rand(0, 1) ? 'Ruang A' : null,
                'metting_link' => rand(0, 1) ? 'https://zoom.us/' . Str::random(10) : null,
                'kouta' => rand(10, 100),
                'keuangan_id' => 1,
                'panitia_id' => null,
                'moderator_id' => 1,
                'pembicara_id' => 1,
                'kategori_id' => rand(1, 5),
            ]);
        }
    }
}
