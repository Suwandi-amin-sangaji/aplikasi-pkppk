<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kendaraan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pemeriksaan()
    {
        return $this->hasMany(PemeriksaanKendaraan::class, 'id_kendaraan', 'id');
    }
}
