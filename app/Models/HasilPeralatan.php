<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPeralatan extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'hasil_peralatans';

    protected $fillable = [
        "id_pemeriksaan",
        "id_peralatan",
        "hasil",
    ];
}
