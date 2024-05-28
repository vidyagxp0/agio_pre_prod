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

    public function department_record()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    public function division_record()
    {
        return $this->belongsTo(QMSDivision::class, 'division_id', 'id');
    }
}
