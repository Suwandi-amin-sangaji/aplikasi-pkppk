<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory, HasUlids;

    protected $tabel = 'peralatans';
    protected $fillable = [
        "id_compartment",
        'item',
        "description",
        "jumlah"
    ];

    public function compartment()
    {
        return $this->belongsTo(Compartment::class, 'id_compartment', 'id');
    }
}
