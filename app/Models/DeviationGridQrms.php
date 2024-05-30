<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviationGridQrms extends Model
{
    use HasFactory;
    protected $table = 'deviation_grid_qrms';

    protected $casts = [
        'data' => 'array'
    ];

    
}
