<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QMSProcess extends Model
{
    use HasFactory;
    protected $table = 'q_m_s_processes';
    
    protected $fillable = [
        'id',
        'process_name'
    ];

}
