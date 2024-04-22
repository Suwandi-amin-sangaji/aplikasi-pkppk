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
        Schema::create('ba_sets', function (Blueprint $table) {
            $table->ulid();
            $table->string('no_back_plate')->nullable();
            $table->string('no_cylinder')->nullable();
            $table->string('visual')->nullable();
            $table->string('fungsi')->nullable();
            $table->string('tekanan')->nullable();
            $table->string('opertaor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ba_sets');
    }
};
