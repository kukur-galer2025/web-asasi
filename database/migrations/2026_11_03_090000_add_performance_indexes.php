<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Index untuk kolom yang dipakai filter di hampir setiap halaman:
     * - direktori/statistik/admin memfilter anggota berdasarkan status & masa berlaku
     * - pengingat terjadwal mencari anggota berdasarkan tanggal masa berlaku
     * - lonceng menghitung notifikasi belum dibaca setiap polling
     */
    public function up(): void
    {
        Schema::table('member_profiles', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
            $table->index('masa_berlaku_sampai');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->index(['notifiable_type', 'notifiable_id', 'read_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_profiles', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['masa_berlaku_sampai']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex(['notifiable_type', 'notifiable_id', 'read_at']);
        });
    }
};
