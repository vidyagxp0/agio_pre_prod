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

    public function internal_audit_checklist_grid()
    {
        return $this->hasMany(InternalAuditChecklistGrid::class);
    }

}
