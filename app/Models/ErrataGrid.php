<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrataGrid extends Model
{
    use HasFactory;
    protected $table = 'errata_grids';
    // protected $fillable = ['useridentifier', 'data'];
    protected $casts = ['data' => 'array'];
}
