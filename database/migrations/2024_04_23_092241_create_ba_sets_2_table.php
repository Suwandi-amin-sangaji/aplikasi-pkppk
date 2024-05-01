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
        Schema::create('ba_sets_2', function (Blueprint $table) {
            $table->id();
            $table->string('no_back_plate2')->nullable();
            $table->string('no_cylinder2')->nullable();
            $table->string('visual2')->nullable();
            $table->string('fungsi2')->nullable();
            $table->string('tekanan2')->nullable();
            $table->string('operator2')->nullable();
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
