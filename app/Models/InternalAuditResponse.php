<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalAuditResponse extends Model
{
    use HasFactory;
    protected $table = 'internal_audit_signature_check';
    protected $fillable = [
        'ia_id',
        'user_id',
        'person_role',
        'status',
    ];

}
