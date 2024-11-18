<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTrainingDocumentNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_name',
        'employee_code',
        'department',
        'designation',
        'job_role',
        'joining_date',
        'document_number',
        'document_title',
        'startdate',
        'enddate',
    ];
}
