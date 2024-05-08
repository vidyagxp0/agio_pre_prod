<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QmsRecordNumber extends Model
{
    use HasFactory;

    public function recordable()
    {
        return $this->morphTo();
    }
}
