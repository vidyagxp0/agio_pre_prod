<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldVisitGrid extends Model
{
    use HasFactory;

    protected $table = 'field_visit_grids';
    protected $casts = ['data' => 'array'];

}
