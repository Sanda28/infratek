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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('jenis_pengajuan', ['baru', 'eksisting']);
            $table->foreignId('menara_id')->nullable()->constrained('menaras');
            $table->enum('status', ['draft', 'diproses', 'disetujui', 'ditolak'])->default('draft');
            $table->text('catatan_admin')->nullable();
            $table->date('tanggal_pengajuan');
            $table->json('menara_baru_data')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
