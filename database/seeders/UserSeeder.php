<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Administrator",
            "email" => "admin@gmail.com",
            "password" => bcrypt("1"),
            "email_verified_at" => now(),
            "phone" =>  "082256330920",
            "phone_verified_at" => now(),
            "akses" => "admin",
        ]);

        User::create([
            "name" => "Pimpinan",
            "email" => "pimpinan@gmail.com",
            "password" => bcrypt("2"),
            "email_verified_at" => now(),
            "phone" =>  "082256330920",
            "phone_verified_at" => now(),
            "akses" => "pimpinan",
        ]);

        User::create([
            "name" => "Petugas",
            "email" => "petugas@gmail.com",
            "password" => bcrypt("3"),
            "email_verified_at" => now(),
            "phone" =>  "082256330920",
            "phone_verified_at" => now(),
            "akses" => "petugas",
        ]);
    }
}
