<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hodmanagementCft extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'hodmanagement_cfts';
}
