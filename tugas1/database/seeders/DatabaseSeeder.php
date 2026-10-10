<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'budi',
            'nama_lengkap' => 'Budi Santoso',
            'password' => 'rahasia123',
        ]);

        User::create([
            'username' => 'siti',
            'nama_lengkap' => 'Siti Aminah',
            'password' => 'password123',
        ]);
    }
}