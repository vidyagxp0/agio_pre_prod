<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabIncident extends Model
{
    use HasFactory;

    public function grids() {
        return $this->hasMany(lab_incidents_grid::class, 'lab_incident_id');
    }
}
