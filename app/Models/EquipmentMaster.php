<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentMaster extends Model
{
    use HasFactory;
     protected $fillable = [
        'sno',
        'department_id',
        'equipment_name',
        'equipment_id',
    ];

     public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
