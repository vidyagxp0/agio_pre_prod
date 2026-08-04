<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementReview extends Model
{
    use HasFactory;

     public function division()
    {
        return $this->belongsTo(QMSDivision::class,'division_id');
    }
}
