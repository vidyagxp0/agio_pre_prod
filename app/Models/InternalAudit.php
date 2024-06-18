<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalAudit extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assign_to');
    }

    public function leadAuditor()
    {
        return $this->belongsTo(User::class,'lead_auditor');
    }
    public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }
    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }

}
