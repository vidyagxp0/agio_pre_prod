<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOS_Micro_grid extends Model
{
    use HasFactory;

    protected $table = 'o_o_s__mirco_grids';
    protected $fillable = [
        'oos_micro_id',
        'identifier',
        'data'
    ];

    // public function micro()
    //     {
    //         return $this->belongsTo(OOS_micro::class, 'oos_micro_id', 'id');
    //     }

    protected $casts = [
        'data' => 'array'
    ];
}
//class OOS_micro_grid extends Model
//{
//    protected $table = 'o_o_s_micro_grids';

//    // Define a relationship with the OOS_micros table
//    public function micro()
//    {
//        return $this->belongsTo(OOS_micro::class, 'micro_id', 'id');
//    }
//}
