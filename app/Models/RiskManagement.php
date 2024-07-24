<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'risk_level',
        'risk_level_2',
        'purpose',
        'scope',
        'reason_for_revision',
        'Brief_description',
        'document_used_risk',
        'risk_level3'
    ];

    protected $casts = [
        
        'purpose' => 'array',
        'scope' => 'array',
        'reason_for_revision' => 'array',
        'Brief_description' => 'array',
        'document_used_risk' => 'array',
        'risk_level3' => 'string'
    ];


    public function record_initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}
