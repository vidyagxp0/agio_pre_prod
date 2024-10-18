<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_employee_id',
        'password',
        // Add other necessary fields here
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // Add any necessary casting for fields here
    ];

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
