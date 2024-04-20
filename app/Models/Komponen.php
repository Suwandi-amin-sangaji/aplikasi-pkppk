<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        "id",
        "id_kendaraan",
        "id_pemeriksaan",
        "checklist",
        'status',
    ];
}
