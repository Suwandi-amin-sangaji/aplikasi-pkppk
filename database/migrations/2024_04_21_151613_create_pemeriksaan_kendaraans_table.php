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
        Schema::create('pemeriksaan_kendaraans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('id_kendaraan');
            $table->ulid('id_kegiatan');
            $table->string('nama_operator');
            $table->string('nama_asisten');
            $table->time('waktu');
            $table->date('tanggal');
            $table->enum('status', ['baru', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kendaraans');
    }
};
