<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OotChecklist extends Model
{
    use HasFactory;
    protected $table = 'oot_checklists';

    protected $fillable = ['data'];

    protected $casts = [
        'data' => 'array', // This will cast the 'data' attribute to an array
    ];

}
