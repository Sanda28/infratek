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
        Schema::create('menaras', function (Blueprint $table) {
            $table->id();
            $table->string('site_code')->unique();
            $table->string('site_name');
            $table->foreignId('desa_id')->constrained('desa');
            $table->foreignId('kecamatan_id')->constrained('kecamatan');
            $table->foreignId('user_id')->constrained('users'); // perusahaan
            $table->string('alamat');
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->float('tinggi_menara');
            $table->string('imb');
            $table->string('rekom');
            $table->string('tahun_rekom')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menaras');
    }
};
