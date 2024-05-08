<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QMSDivision extends Model
{
    use HasFactory;

    protected $table = 'q_m_s_divisions';
    
    protected $fillable = [
        'id',
        'name'
    ];
}
