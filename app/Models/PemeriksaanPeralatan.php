<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanPeralatan extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'pemeriksaan_peralatans';
    protected $fillable = [
        'id_user',
        'nama_operator',
        'nama_asisten',
        'jenis_peralatan',
        'waktu',
        'tanggal',
        'mengetahui',
        'status',
        'catatan',
    ];

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'id_peralatan', 'id');
    }

    public function compartment()
    {
        return $this->belongsTo(Compartment::class, 'id_compartment', 'id');
    }

    public function hasilPeralatan(){
        return $this->hasMany(HasilPeralatan::class, 'id_pemeriksaan', 'id');
    }
}
