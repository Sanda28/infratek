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
        Schema::create('log_status_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->enum('status', ['draft', 'diproses', 'disetujui', 'ditolak']);
            $table->text('catatan')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users'); // tanpa 'after'
            $table->timestamp('tanggal_status');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_status_pengajuan');
    }
};
