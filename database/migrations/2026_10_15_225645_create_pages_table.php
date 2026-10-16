<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('menu_induk', 30); // Semua menu bisa dipilih
            $table->string('judul'); 
            $table->string('slug')->unique();
            $table->string('hero_image')->nullable(); // Kolom untuk upload gambar beda-beda
            $table->string('hero_subtitle')->nullable();
            $table->longText('konten');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
