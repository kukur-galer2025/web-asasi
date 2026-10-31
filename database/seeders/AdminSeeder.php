<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Khusus membuat / memperbarui akun Super Admin ASASI.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@asasi.or.id');
        $password = env('ADMIN_PASSWORD', 'password123');
        $name = env('ADMIN_NAME', 'Super Admin ASASI');

        $admin = User::updateOrCreate(
            ['email' => $email],
            [
                'name'              => $name,
                'password'          => Hash::make($password),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        if ($this->command) {
            $this->command->info("✓ Akun Admin berhasil dibuat / diperbarui:");
            $this->command->line("  - Nama     : {$admin->name}");
            $this->command->line("  - Email    : {$admin->email}");
            $this->command->line("  - Role     : {$admin->role}");
            $this->command->line("  - Password : {$password}");
        }
    }
}
