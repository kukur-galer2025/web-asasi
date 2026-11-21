<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Mencatat cara akun dibuat (Google / manual), tautan Google, status kata sandi, dan login terakhir,
     * agar admin dapat melihat metode masuk tiap akun.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('registered_via', 10)->default('manual')->after('role'); // google | manual
            $table->string('google_id')->nullable()->unique()->after('registered_via');
            $table->timestamp('password_set_at')->nullable()->after('password'); // kata sandi yang dapat dipakai masuk
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_via', 10)->nullable(); // google | password
        });

        // Data lama: akun anggota hanya dapat dibuat lewat Google; akun admin dibuat manual (seeder)
        DB::table('users')->where('role', 'member')->update(['registered_via' => 'google']);
        DB::table('users')->where('role', 'admin')->update(['password_set_at' => DB::raw('created_at')]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['google_id']);
            $table->dropColumn(['registered_via', 'google_id', 'password_set_at', 'last_login_at', 'last_login_via']);
        });
    }
};
