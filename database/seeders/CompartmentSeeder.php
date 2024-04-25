<?php

namespace Database\Seeders;

use App\Models\Compartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Compartment::create([
            "name" => "COMPARTMENT 1",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 2",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 3",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 4",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 5",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 6",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 7",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 8",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 9",
        ]);
        Compartment::create([
            "name" => "COMPARTMENT 10",
        ]);
        Compartment::create([
            "name" => "CABIN KENDARAAN",
        ]);
        Compartment::create([
            "name" => "CABIN KENDARAAN",
        ]);
        Compartment::create([
            "name" => "ATAS/ROOF FIRE TRUCK",
        ]);
        Compartment::create([
            "name" => "ATAS/ROOF FIRE TRUCK",
        ]);
    }
}
