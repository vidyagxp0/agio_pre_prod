<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ootc extends Model
{
    use HasFactory;

    public function ProductGridOot(){
        return $this->hasOne(ProductGridOot::class,'ootcs_id');
    }

}
