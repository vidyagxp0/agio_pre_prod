<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oosgrids extends Model
{
    use HasFactory;
    protected $table = 'oos_grids';
    protected $fillable = [
        'oos_id',
        'identifier',
        'data'
    ];
    protected $casts = [
        'data' => 'array'
    ];
}
