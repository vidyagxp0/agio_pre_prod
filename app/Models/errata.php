<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errata extends Model
{
    use HasFactory;


    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }

    public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }
    protected $fillable =[
        'department_head_to',
        'document_title',
        'qa_reviewer',
        'reference',
        'otherFieldsUser'
    ];

   }

