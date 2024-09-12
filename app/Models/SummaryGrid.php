<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryGrid extends Model
{
    use HasFactory;

    protected $table = 'external_audit_summaryResponse__grids';

    protected $fillable = ['summary_id','identifier', 'data'];

    protected $casts = ['data' => 'array'];
}
