<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin ASASI (Satu-satunya akun default)
        User::updateOrCreate(
            ['email' => 'admin@asasi.or.id'],
            [
                'name'     => 'Super Admin ASASI',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );
    }
}

