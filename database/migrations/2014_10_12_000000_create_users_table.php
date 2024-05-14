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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('akses', ['admin', 'pimpinan', 'petugas']);
            $table->string('phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nip')->nullable();
            $table->enum('status', ['PNS', 'PPNPN'])->nullable();
            $table->string('pangkat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->string('pengabdian')->nullable();
            $table->string('pensiun')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
