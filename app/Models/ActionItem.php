<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
    use HasFactory;
    protected $table='action_items';
    protected $fillable = [
   
        'file_attach'       
    ];


}
