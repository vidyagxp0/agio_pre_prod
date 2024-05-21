<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOS_Mirco_grid extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array'
    ];
}
