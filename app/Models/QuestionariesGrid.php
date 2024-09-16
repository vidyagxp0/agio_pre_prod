<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionariesGrid extends Model
{
    use HasFactory;

    protected $fillable = ['induction_id', 'identifier', 'data'];

    protected $casts = [
        'data' => 'array'
    ];
}
