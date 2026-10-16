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
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@asasi.or.id'],
            [
                'name'     => 'Super Admin ASASI',
                'password' => bcrypt('password123'),
                'role'     => 'admin',
            ]
        );
    }
}
