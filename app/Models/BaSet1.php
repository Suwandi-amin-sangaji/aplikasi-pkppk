<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaSet1 extends Model
{
    use HasFactory;
    protected $table = 'ba_sets_1';

    protected $fillable = [
        'no_back_plate1',
        'no_cylinder1',
        'visual1',
        'fungsi1',
        'tekanan1',
        'operator1',
    ];

    public function pemeriksaanKendaraan()
    {
        return $this->hasMany(PemeriksaanKendaraan::class, 'id_baset', 'id');
    }
}
