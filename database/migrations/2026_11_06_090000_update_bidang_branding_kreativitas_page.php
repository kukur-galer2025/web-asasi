<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Isi halaman Bidang Branding & Kreativitas diganti dengan deck Program Kerja 2027 (10 slide).
     */
    public function up(): void
    {
        DB::table('pages')
            ->where('slug', 'bidang-branding-kreativitas')
            ->update([
                'konten'     => File::get(database_path('seeders/data/pages/bidang-branding-kreativitas.html')),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        // Konten lama tidak dipulihkan
    }
};
