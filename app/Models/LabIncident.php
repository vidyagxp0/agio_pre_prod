<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabIncident extends Model
{
    use HasFactory;

    // public function grids() {
    //     return $this->hasMany(lab_incidents_grid::class);
    // }

    public function labIncidentSeconds()
    {
        return $this->hasMany(lab_incidents_grid::class);
    }


    public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }
}
