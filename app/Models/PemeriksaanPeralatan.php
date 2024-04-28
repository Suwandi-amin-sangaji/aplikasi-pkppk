<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanPeralatan extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];

    public function perlatan()
    {
        $this->belongsTo(Peralatan::class, 'id_peralatan', 'id');
    }

    public function compartment()
    {
        return $this->belongsTo(Compartment::class, 'id_compartment', 'id');
    }
}
