<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerQualification extends Model
{
    use HasFactory;

    public function trainer_grid() {
        return $this->hasMany(TrainerGrid::class);
    }
}
