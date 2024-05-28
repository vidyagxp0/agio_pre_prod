<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTraining extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'department_location',
        'startdate',
        'enddate',
        'trainee',
        'checked_by_hr'
        // Add other fields as necessary
    ];
}
