<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with complete, authentic dummy data.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MemberProfileSeeder::class,
            PostSeeder::class,
            PageSeeder::class,
        ]);
    }
}
