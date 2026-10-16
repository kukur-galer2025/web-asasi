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
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nomor_anggota')->unique()->nullable(); // Contoh: ASASI-2026-0001
            $table->string('nama_lengkap'); // Nama lengkap beserta gelar akademik
            $table->string('nik', 20)->nullable();
            $table->string('instansi'); // Universitas / Lembaga asal
            $table->string('bidang_keahlian')->nullable();
            $table->string('wilayah_dpw')->nullable(); // Provinsi Cabang
            $table->string('no_whatsapp', 20);
            $table->string('foto_profil')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
            $table->date('masa_berlaku_sampai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_profiles');
    }
};
