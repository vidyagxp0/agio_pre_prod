<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StageManage extends Model
{
    use HasFactory, SoftDeletes;
    protected $table= 'stage_manages';
    protected $fillable = [
        'document_id', 'user_id', 'role', 'stage', 'comment',
    ];
}
