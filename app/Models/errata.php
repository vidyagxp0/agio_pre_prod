<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errata extends Model
{
    use HasFactory;

    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }

    public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }

    public function newChanges()
    {
        return $this->hasOne(AddColumnErrataNew::class, 'erratanew_id','id');
    }
}

