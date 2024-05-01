<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaan extends Model
{
    use HasFactory;
    protected $table = "hasil_pemeriksaans";

    protected $fillable = [
        "id_pemeriksaan",
        "id_kegiatan",
        "hasil"
    ];
}
