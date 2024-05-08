<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentContent extends Model
{
    use HasFactory;
    protected $fillable = ['document_id',
    'purpose',
    'scope',
    'responsibility',
    'abbreviation',
    'defination',
    'materials_and_equipments',
    'procedure',
    'reporting',
    'references',
    'annexuredata'
   ];
}
