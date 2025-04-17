<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RootCauseAnalysis extends Model
{
    use HasFactory;

    protected $casts = [
        'investigation_team' => 'array',
    ];


    public function record_initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}
