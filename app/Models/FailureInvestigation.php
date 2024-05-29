<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailureInvestigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'Closure_Comments'
    ];

    public function failure_investigation_grid_data()
    {
        return $this->hasMany(FailureInvestigationGridData::class, 'failure_investigation_id');
    }

    public function failure_mode_investigation_grid()
    {
        return $this->hasMany(FailureInvestigationGridFailureMode::class, 'failure_investigation_id');
    }

    public function record_initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}
