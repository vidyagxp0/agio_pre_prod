<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentGrid extends Model
{
    use HasFactory;

    protected $table = 'document_grids';

    protected $fillable = ['document_type_id','identifier', 'data'];

    protected $casts = ['data' => 'array'];
}
