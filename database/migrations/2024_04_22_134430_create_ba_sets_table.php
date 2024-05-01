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
        Schema::create('ba_sets_1', function (Blueprint $table) {
            $table->id();
            $table->string('no_back_plate1')->nullable();
            $table->string('no_cylinder1')->nullable();
            $table->string('visual1')->nullable();
            $table->string('fungsi1')->nullable();
            $table->string('tekanan1')->nullable();
            $table->string('operator1')->nullable();
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
