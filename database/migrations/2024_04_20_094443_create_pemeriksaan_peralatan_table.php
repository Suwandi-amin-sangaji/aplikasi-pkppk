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

        Schema::create('pemeriksaan_peralatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_peralatan');
            $table->foreign('id_peralatan')->references('id')->on('peralatan');
            $table->bigInteger('id_pemeriksaan');
            $table->foreign('id_pemeriksaan')->references('id')->on('permeriksaan');
            $table->enum('checklist', [""]);
            $table->enum('status', [""]);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_peralatan');
    }
};
