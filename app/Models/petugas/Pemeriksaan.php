<?php

namespace App\Models\petugas;

use App\Models\admin\Kendaraan;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];


    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }
}
