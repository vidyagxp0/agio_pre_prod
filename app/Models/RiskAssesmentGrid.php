<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssesmentGrid extends Model
{
    use HasFactory;

    public function riskmanagement(){
        return $this->hasMany(RiskManagement::class,'type');
    }
}

