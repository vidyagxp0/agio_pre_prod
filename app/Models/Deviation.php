<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deviation extends Model
{
    use HasFactory;

    protected $fillable = [
        'Closure_Comments'
    ];

    public function new_data_grids()
    {
        return $this->hasMany(DeviationNewGridData::class, 'deviation_id');
    }

    public function qrms_data_grids()
    {
        return $this->hasMany(DeviationGridQrms::class, 'deviation_id');
    }

    public function record_initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}
