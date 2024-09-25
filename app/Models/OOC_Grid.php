<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOC_Grid extends Model
{
    use HasFactory;
    protected $table = 'o_o_c__grids';

    protected $fillable = ['ooc_id','identifier', 'data'];

    protected $casts = ['data' => 'array'];

    public function OutOfCalibration()
    {
        return $this->hasMany(OutOfCalibration::class);
    }

}
