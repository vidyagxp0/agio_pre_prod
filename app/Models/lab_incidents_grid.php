<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lab_incidents_grid extends Model
{
    use HasFactory;
    protected $table = 'incident_investigation_report';
    protected $fillable = ['labincident_id','useridentifier', 'data'];
    protected $casts = ['data' => 'array'];

    public function labincident()
    {
        return $this->belongsTo(LabIncident::class,'labincident_id ');
    }

    
}
