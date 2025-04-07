<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'pembicara']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'peserta']);
        Role::create(['name' => 'panitia']);
        Role::create(['name' => 'keuangan']);
    }
}
