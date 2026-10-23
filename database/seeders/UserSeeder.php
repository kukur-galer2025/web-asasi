<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin ASASI
        User::updateOrCreate(
            ['email' => 'admin@asasi.or.id'],
            [
                'name'     => 'Super Admin ASASI',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // 2. Member Akun Uji Coba (Ketua Umum)
        User::updateOrCreate(
            ['email' => 'elfahmi@asasi.or.id'],
            [
                'name'     => 'Prof. Dr. apt. Elfahmi, M.Si.',
                'password' => Hash::make('password123'),
                'role'     => 'member',
            ]
        );

        // 3. Member Akun Standar untuk Test Dashboard Member
        User::updateOrCreate(
            ['email' => 'member@asasi.or.id'],
            [
                'name'     => 'Dr. Budi Santoso, M.Eng., Ph.D.',
                'password' => Hash::make('password123'),
                'role'     => 'member',
            ]
        );

        // 4. Member Baru (Pengajuan Pending untuk Uji Coba Approval Admin)
        User::updateOrCreate(
            ['email' => 'fauzi@asasi.or.id'],
            [
                'name'     => 'Ahmad Fauzi, S.T., M.T.',
                'password' => Hash::make('password123'),
                'role'     => 'member',
            ]
        );
    }
}
