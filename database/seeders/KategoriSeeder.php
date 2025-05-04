<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Kecerdasan Buatan'],
            ['nama' => 'Keamanan Siber'],
            ['nama' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'Jaringan Komputer'],
            ['nama' => 'Pemrograman'],
            ['nama' => 'Big Data'],
            ['nama' => 'UI/UX Design'],
        ];

        foreach ($data as $item){
             Kategori::create($item);
        }
    }
}
