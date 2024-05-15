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
        Schema::create('pemeriksaan_peralatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_operator');
            $table->string('nama_asisten')->nullable();
            $table->string('jenis_peralatan')->nullable();
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
        Schema::dropIfExists('pemeriksaan_peralatans');
    }
};
