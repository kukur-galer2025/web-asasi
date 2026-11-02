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
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_profile_id')->constrained('member_profiles')->cascadeOnDelete();
            $table->enum('jenis', ['pendaftaran', 'perpanjangan']);
            $table->unsignedTinyInteger('durasi_tahun');
            $table->unsignedInteger('nominal'); // snapshot biaya saat pengajuan (Rupiah)
            $table->string('bukti_path');       // disimpan di disk privat 'local'
            $table->string('bukti_nama_asli')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->date('periode_mulai')->nullable();  // diisi saat disetujui
            $table->date('periode_sampai')->nullable();
            $table->timestamps();

            $table->index(['member_profile_id', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_payments');
    }
};
