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
            'jenis' => 'Ambulance',
            'plat' => 'A1',
            'merk' => 'Mitsubishi',
            'tahun' => 2011,
            'jumlah' => 1,
        ]);

        Kendaraan::create([
            'jenis' => 'Ambulance',
            'plat' => 'A2',
            'merk' => 'Isuzu',
            'tahun' => 2018,
            'jumlah' => 1,
        ]);

        Kendaraan::create([
            'jenis' => 'Foam Tender type II',
            'plat' => 'FI',
            'merk' => 'Fresia',
            'tahun' => 2017,
            'jumlah' => 1,
        ]);

        Kendaraan::create([
            'jenis' => 'Foam Tender Type IV',
            'plat' => 'FII',
            'merk' => 'Kenbri',
            'tahun' => 2014,
            'jumlah' => 1,
        ]);

        Kendaraan::create([
            'jenis' => 'Foam Tender type II',
            'plat' => 'FIII',
            'merk' => 'Fresia',
            'tahun' => 2018,
            'jumlah' => 1,
        ]);

        Kendaraan::create([
            'jenis' => 'Commando Car',
            'plat' => 'C',
            'merk' => 'Mitsubishi Triton',
            'tahun' => 2018,
            'jumlah' => 1,
        ]);


    }
}
