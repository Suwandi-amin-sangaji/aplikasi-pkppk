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
        Schema::create('pemeriksaan_peralatan', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('id_user');
            $table->ulid('id_peralatan');
            $table->string('nama_operator');
            $table->string('nama_asisten')->nullable();
            $table->time('waktu');
            $table->string('tanggal');
            $table->string('mengetahui')->nullable();
            $table->string('status')->default('baru');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_peralatan');
    }
};
