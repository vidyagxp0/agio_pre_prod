<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGridOot extends Model
{
    use HasFactory;

    protected $table = 'grid_product_materiales';

    protected $casts = [
        'data' => 'array'
    ];
}
