<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaSet2 extends Model
{

    use HasFactory, HasUlids;
    protected $table = 'ba_sets_2';

    protected $fillable = [
        'no_back_plate2',
        'no_cylinder2',
        'visual2',
        'fungsi2',
        'tekanan2',
        'operator2',
    ];
}
