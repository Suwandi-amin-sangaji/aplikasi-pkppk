<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compartment extends Model
{
    use HasFactory;

    protected $table = "compartments";
    protected $fillable = [
        "name",
    ];

    public function compartment()
    {
        return $this->belongsTo(Compartment::class);
    }
}
