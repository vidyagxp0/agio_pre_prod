<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capa extends Model
{
    use HasFactory;

    public function record_number()
    {
        return $this->morphOne(QmsRecordNumber::class, 'recordable');
    }
    public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }
}
