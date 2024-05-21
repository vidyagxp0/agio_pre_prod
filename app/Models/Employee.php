<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function employee_grid() {
        return $this->hasMany(EmployeeGrid::class);
    }

    public function department_record()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    public function user_assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
