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
            $table->ulid('id')->primary(); // ULID
            $table->ulid('id_kendaraan')->constrained('kendaraans');
            $table->string('nama_operator');
            $table->string('nama_asisten')->nullable();
            $table->time('waktu');
            $table->date('tanggal');
            $table->string('mengetahui')->nullable();
            $table->string('status')->default('baru');
            $table->text('catatan')->nullable();
            $table->ulid('id_baset_1'); // ULID
            $table->ulid('id_baset_2');
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
