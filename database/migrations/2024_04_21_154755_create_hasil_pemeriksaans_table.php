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
        Schema::create('hasil_pemeriksaans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama_operator');
            $table->string('nama_asisten');
            $table->time('waktu');
            $table->date('tanggal');
            $table->enum('status', ['baru', 'selesai'])->default('baru');
            $table->ulid('id_kegiatan');
            $table->ulid('id_pemeriksaan');
            $table->enum('checklist',['Yes', 'No']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pemeriksaans');
    }
};
