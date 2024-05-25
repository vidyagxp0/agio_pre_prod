<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailureInvestigationGridFailureMode extends Model
{
    use HasFactory;
    protected $table = 'failure_investigation_grid_failure_modes';

    protected $casts = [
        'data' => 'array'
    ];
}
