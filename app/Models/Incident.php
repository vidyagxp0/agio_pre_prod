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
    public function division(){
        return $this->belongsTo(QMSDivision::class,'division_id');
    }
    public function initiator(){
        return $this->belongsTo(User::class,'initiator_id');
    }
    public function Grid()
    {
        return $this->hasMany(IncidentGrid::class,'incident_grid_id','id');
    }
}
