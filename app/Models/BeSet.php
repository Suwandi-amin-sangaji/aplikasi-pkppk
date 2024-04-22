<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeSet extends Model
{
    use HasFactory;
    protected $table = 'ba_sets';
    protected $fillable = [
        'no_back_plate',
        'no_cylinder',
        'visual',
        'fungsi',
        'tekanan',
        'operator',
    ];
}
