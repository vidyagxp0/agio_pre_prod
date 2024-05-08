<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionBank extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'question_banks';
    protected $fillable = [
        'title',
        'status',
        'description',
        // Add other fillable attributes here if any
    ];
}
