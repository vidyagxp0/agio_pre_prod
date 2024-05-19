<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketComplaintGrids extends Model
{
    protected $table='marketcomplaint_grids';
    use HasFactory;
protected $fillable = [
    'mc_id',
    'identifers',
    'data'
    ];

    protected $casts = [
        'data' => 'array'
        // 'aainfo_product_name' => 'array',
           ];

      public function MarketComplaint()
           {
               return $this->belongsTo(LabIncident::class,'labincident_id ');
           }
       
}
