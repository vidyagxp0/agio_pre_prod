<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOSLaunchExtension extends Model
{
    use HasFactory;
    protected $table = 'oos_launch_extensions';

    protected $fillable = [
        'id',
        'oos_id',
        'extension_identifier',
        'oos_proposed_due_date',
        'oos_extension_justification',
        'oos_extension_completed_by',
        'oos_extension_completed_on',
        'capa_proposed_due_date',
        'capa_extension_justification',
        'capa_extension_completed_by',
        'capa_extension_completed_on',
        'qrm_proposed_due_date',
        'qrm_extension_justification',
        'qrm_extension_completed_by',
        'qrm_extension_completed_on',
        'investigation_proposed_due_date',
        'investigation_extension_justification',
        'investigation_extension_completed_by',
        'investigation_extension_completed_on'
    ];
}
