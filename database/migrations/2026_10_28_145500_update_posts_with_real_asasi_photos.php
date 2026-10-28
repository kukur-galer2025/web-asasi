<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Post;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update gambar artikel dengan foto kegiatan asli ASASI yang telah dioptimasi
        Post::where('slug', 'aicast-2026-siap-digelar-di-bandung')->update([
            'gambar' => 'images/kegiatan/kegiatan-asasi-pelantikan.webp',
        ]);

        Post::where('slug', 'thwa-seri-48-genomik-dan-ai-presisi-medis')->update([
            'gambar' => 'images/kegiatan/kegiatan-asasi-seminar.webp',
        ]);

        Post::where('slug', 'peluncuran-konsorsium-riset-nasional-ketahanan-pangan')->update([
            'gambar' => 'images/kegiatan/rakornas-asasi-bersama.webp',
        ]);

        Post::where('slug', 'klinik-manuskrip-scopus-q1-percepatan-guru-besar-angkatan-3')->update([
            'gambar' => 'images/kegiatan/kegiatan-asasi-diskusi.webp',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert down if needed
    }
};
