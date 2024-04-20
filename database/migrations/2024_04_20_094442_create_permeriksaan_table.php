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
        Schema::disableForeignKeyConstraints();

        Schema::create('permeriksaan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kegiatan');
            $table->foreign('id_kegiatan')->references('id')->on('kegiatan');
            $table->bigInteger('id_kendaraan');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan');
            $table->string('waktu_pemeriksaan');
            $table->string('nama_operator');
            $table->string('nama_asisten');
            $table->date('tanggal');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permeriksaan');
    }
};
