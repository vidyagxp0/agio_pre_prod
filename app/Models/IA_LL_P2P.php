<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IA_LL_P2P extends Model
{
    use HasFactory;
    protected $fillable = [
        'ia_id',
        'checklist_LL_P2P_response_1',
        'checklist_LL_P2P_remark_1',
        // add other fields as necessary
    ];
}
