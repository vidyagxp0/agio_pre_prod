<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviationAuditTrail extends Model
{
    use HasFactory;
    protected $table = 'deviation_audit_trials';

    public function deviation() {
        return $this->belongsTo(Deviation::class);
    }
}
