<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeGrid extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'identifier', 'data'];

    protected $casts = [
        'data' => 'array'
    ];
}
