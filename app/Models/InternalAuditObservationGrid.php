<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalAuditObservationGrid extends Model
{
    use HasFactory;
    protected $table = 'internal_audit_observation_grids';
    protected $casts = ['data' => 'array'];
}
