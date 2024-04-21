<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kendaraan::create([
            "jenis" => "Ambulance",
            "plat" => "1111",
            "merk" => "Toyota",
            "jumlah" => 1
        ]);
    }
}
