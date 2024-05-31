<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConformance extends Model
{
    use HasFactory;

    public function failure_investigation_grid_data()
    {
        return $this->hasMany(NonConformanceGridDatas::class, 'non_conformance_id');
    }

    public function failure_mode_investigation_grid()
    {
        return $this->hasMany(NonConformanceGridModes::class, 'non_conformance_id');
    }

    public function record_initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}

