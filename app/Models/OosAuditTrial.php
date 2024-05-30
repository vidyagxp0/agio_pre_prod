<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OosAuditTrial extends Model
{
    use HasFactory;
    
    public function oos_chemical() {
        return $this->belongsTo(OOS::class);
    }
}
