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
            "nama" => "Melakukan Prosedur Pengecekan Sebelum Menghidupkan Kendaraan (Mengecek Oli,AirRadiator, Dll)",
            "id_kendaraan" => 2

        ]);

        Kegiatan::create([
            "nama" => "Melkuakan Pengencekan Indikator Pada Layar Dashboard kendaraan(tekanan oli, fuel, tekanan angin)",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan fungsi Lampu-lampu pada Kendaraan(lampu, depan, rotary, dll)",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan fungsi Lampu-lampu pada Kendaraan(lampu, depan, rotary, dll)",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan Layar-layar monitor yang ada pada kendaraan(pengoperasian Pompa Pemdam, Gps, Dll)",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan fungsi wiper,Klakson, dll",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan Perlatan Pada Masing-masing Compartment, Kendaraan",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan fungsi pada Bagian Luar Kendaraan(Kebersihan,Tekanan ban, Dll)",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Prosedur Untuk Mematikan Kendaraan",
            "id_kendaraan" => 2
        ]);

        Kegiatan::create([
            "nama" => "Melakukan Pengecekan fungsi Peralatan Pemadam(Turret,Hose,reel,Dll)",
            "id_kendaraan" => 2
        ]);
    }
}
