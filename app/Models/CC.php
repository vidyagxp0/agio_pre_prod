<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CC extends Model
{
    use HasFactory;

    public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }
    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }
}
