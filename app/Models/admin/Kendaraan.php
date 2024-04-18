<?php

namespace App\Models\admin;

use App\Models\petugas\Pemeriksaan;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kendaraan extends Model
{
    use HasFactory, HasUlids;
    protected $guarded = [];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
