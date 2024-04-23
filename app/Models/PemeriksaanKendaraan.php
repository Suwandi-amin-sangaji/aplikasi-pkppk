<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanKendaraan extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'pemeriksaan_kendaraans';

    protected $fillable = [
        'id_kendaraan',
        'id_baset_1',
        'id_baset_2',
        'nama_operator',
        'nama_asisten',
        'waktu',
        'tanggal',
        'mengetahui',
        'status',
        'catatan',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }

    public function hasilPemeriksaan()
    {
        return $this->hasMany(HasilPemeriksaan::class, 'id_pemeriksaan', 'id');
    }

    public function beset1()
    {
        return $this->belongsTo(BaSet1::class, 'id_baset_1', 'id');
    }

    public function beset2()
    {
        return $this->belongsTo(BaSet2::class, 'id_baset_2', 'id');
    }
}
