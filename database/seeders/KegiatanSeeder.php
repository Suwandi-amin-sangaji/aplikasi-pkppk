<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kegiatan::create([
            "name" => "Melakukan Prosedur Pengecekan Sebelum Menghidupkan Kendaraan (Mengecek Oli,AirRadiator, Dll)",

        ]);

        Kegiatan::create([
            "name" => "Melkuakan Pengencekan Indikator Pada Layar Dashboard kendaraan(tekanan oli, fuel, tekanan angin)",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan fungsi Lampu-lampu pada Kendaraan(lampu, depan, rotary, dll)",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan fungsi Lampu-lampu pada Kendaraan(lampu, depan, rotary, dll)",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan Layar-layar monitor yang ada pada kendaraan(pengoperasian Pompa Pemdam, Gps, Dll)",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan fungsi wiper,Klakson, dll",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan Perlatan Pada Masing-masing Compartment, Kendaraan",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan fungsi pada Bagian Luar Kendaraan(Kebersihan,Tekanan ban, Dll)",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Prosedur Untuk Mematikan Kendaraan",

        ]);

        Kegiatan::create([
            "name" => "Melakukan Pengecekan fungsi Peralatan Pemadam(Turret,Hose,reel,Dll)",

        ]);
    }
}
