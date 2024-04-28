<?php

namespace Database\Seeders;

use App\Models\Compartment;
use App\Models\Peralatan;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeralatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compartments = Compartment::all();
        $peralatanData = [
            [
                'item' => 'NOZZLE FOAM',
                'description' => 'NOZZLE FOAM',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:49:15',
                'updated_at' => '2024-04-28 12:50:11',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],

            [
                'item' => 'PIPA SUCTION/PENGHISAP',
                'description' => 'PIPA SUCTION/PENGHISAP',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PIPA DISCHARGE/PANCARAN',
                'description' => 'PIPA DISCHARGE/PANCARAN',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PIPA FOAM FILLING/PENGISIAN',
                'description' => 'PIPA FOAM FILLING/PENGISIAN',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            [
                'item' => 'PANEL MONITOR PTO',
                'description' => 'PANEL MONITOR PTO',
                'jumlah' => 1,
                'created_at' => '2024-04-28 12:50:50',
                'updated_at' => '2024-04-28 12:50:50',
            ],
            // Tambahkan item peralatan lainnya sesuai kebutuhan
        ];

        // Loop melalui setiap kompartemen dan tambahkan peralatan untuk masing-masing
        foreach ($compartments as $compartment) {
            foreach ($peralatanData as $data) {
                $data['id_compartment'] = $compartment->id;
                Peralatan::create($data);
            }
        }
    }
}
