<?php

namespace App\Exports;

use App\Models\PemeriksaanKendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemeriksaanKendaraanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PemeriksaanKendaraan::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Kendaraan',
            'ID User',
            'ID Baset 1',
            'ID Baset 2',
            'Nama Operator',
            'Nama Asisten',
            'Waktu',
            'Tanggal',
            'Mengetahui',
            'Status',
            'Catatan',
        ];
    }
}
