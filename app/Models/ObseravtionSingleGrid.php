<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObseravtionSingleGrid extends Model
{
    use HasFactory;
    
    protected $table = 'obseravtion_single_grids';
    protected $casts = ['data' => 'array'];
}
