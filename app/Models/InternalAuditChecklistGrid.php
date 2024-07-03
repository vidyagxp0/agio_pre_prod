<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalAuditChecklistGrid extends Model
{
    use HasFactory;
    protected $table = 'internal_audit_checklist_grids';

    protected $casts = [
        'data' => 'array'
    ];
}
