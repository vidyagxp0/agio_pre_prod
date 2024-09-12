<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalAuditorGrid extends Model
{

    use HasFactory;
    protected $table = 'internal_auditor_grids';

    protected $fillable = ['auditor_id','identifier', 'data'];

    protected $casts = ['data' => 'array'];
}
