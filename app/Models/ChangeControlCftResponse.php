<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeControlCftResponse extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'change_control_cft_responses';
}
