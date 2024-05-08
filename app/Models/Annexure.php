<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Annexure extends Model
{
    use HasFactory;
    protected $fillable = ['document_id',
    'sno',
    'annexure_no',
    'annexure_title',
];
}
