<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentGrid extends Model
{
    use HasFactory;


    public function Incident()
{
    return $this->belongsTo(Incident::class, 'incident_grid_id');
}

}
