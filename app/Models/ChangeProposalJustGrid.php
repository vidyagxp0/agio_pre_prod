<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeProposalJustGrid extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpjg_id',
        'identifier',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
