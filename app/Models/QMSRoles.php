<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QMSRoles extends Model
{
    use HasFactory;
    protected $table = 'q_m_s_roles';
    
    protected $fillable = [
        'id',
        'name'
    ];

}
