<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditProgramGrid extends Model
{
    use HasFactory;
      protected $table = 'audit_program_grids';
      protected $casts = ['data' => 'array'];
}
