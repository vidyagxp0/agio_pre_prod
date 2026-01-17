<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $casts = [
        'non_conformances_date' => 'datetime',
    ];


     public function Incident_details() {
    return $this->hasMany(IncidentGrid::class, 'incident_grid_id');
}


public function division()
{
    return $this->belongsTo(QMSDivision::class, 'division_id');
}



}
